<?php

namespace Muzik\EsafeSdk\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Muzik\EsafeSdk\Exceptions\CheckException;

class CheckService
{
    protected array $parameters;

    protected string $apiKey;

    protected Client $client;

    protected bool $testing;

    protected string $liveEndpoint = 'https://www.esafe.com.tw/Service/PaymentCheck.aspx';
    protected string $testEndpoint = 'https://test.esafe.com.tw/Service/PaymentCheck.aspx';

    public function __construct(array $parameters, string $apiKey, bool $testing = false, Client $client = null)
    {
        $this->apiKey = $apiKey;
        $this->testing = $testing;
        $this->parameters = $this->bindParameters($parameters);
        $this->client = $client ?: new Client();
    }

    public function send(): array
    {
        try {
            $response = $this->client->request('post', $this->getEndpoint(), [
                'form_params' => $this->parameters,
            ]);
            $contents = $response->getBody()->getContents();

            if (strpos($contents, '##') === false) {
                throw new CheckException($contents);
            }

            return $this->parseResponse($contents);
        } catch (TransferException $exception) {
            throw new CheckException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    protected function parseResponse(string $response): array
    {
        $ret = [];
        $records = explode("\r\n", $response);

        foreach ($records as $record) {
            $record = explode('##', $record);

            $ret[] = [
                'web' => $record[0],
                'buysafeno' => $record[1],
                'MN' => $record[2],
                'transaction_datetime' => $record[3],
                'errcode' => $record[4],
                'Card_NO' => $record[5],
                'ApproveCode' => $record[6],
                'ChkValue' => $record[7],
            ];
        }

        return $ret;
    }

    protected function getEndpoint(): string
    {
        return $this->testing
            ? $this->testEndpoint
            : $this->liveEndpoint;
    }

    protected function bindParameters(array $original): array
    {
        $original = array_filter($original, fn ($item) => $item !== '');
        if (!isset($original['web'])) {
            throw new CheckException('Missing required parameter "web".');
        }
        $original['ChkValue'] = $this->checkValue($original);

        return $original;
    }

    protected function checkValue(array $data): string
    {
        $data = $data['web'] .
            $this->apiKey .
            ($data['MN'] ?? '') .
            ($data['buysafeno'] ?? '') .
            ($data['Td'] ?? '') .
            ($data['note1'] ?? '') .
            ($data['note2'] ?? '');

        return strtoupper(hash('sha1', $data));
    }
}
