<?php

namespace Muzik\EsafeSdk\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use Muzik\EsafeSdk\Exceptions\RefundException;

class RefundService
{
    /**
     * Parameters will be requested to esafe.com.tw
     *
     * @var array
     */
    protected array $parameters;

    /**
     * The transaction password initialized by entrypoint.
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * Guzzle HTTP Client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * Determine if the environment is testing.
     *
     * @var bool
     */
    protected bool $testing;

    protected string $liveEndpoint = 'https://www.esafe.com.tw/Service/Hx_CardRefund.ashx';
    protected string $testEndpoint = 'https://test.esafe.com.tw/Service/Hx_CardRefund.ashx';

    public function __construct(array $parameters, string $apiKey, bool $testing = false, Client $client = null)
    {
        $this->apiKey = $apiKey;
        $this->testing = $testing;
        $this->parameters = $this->buildParameters($parameters);
        $this->client = $client ?: new Client();
    }

    public function send(): void
    {
        try {
            $response = $this->client->request('post', $this->getEndpoint(), [
                'form_params' => $this->parameters,
            ]);

            if (($error = $response->getBody()->getContents()) !== 'E0') {
                throw new RefundException($error);
            }
        } catch (TransferException $exception) {
            throw new RefundException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    protected function getEndpoint(): string
    {
        return $this->testing
            ? $this->testEndpoint
            : $this->liveEndpoint;
    }

    protected function buildParameters(array $original): array
    {
        $requires = [
            'web', 'MN', 'buysafeno', 'Td', 'RefundMemo',
        ];

        $original = array_filter($original, fn ($item) => $item !== '');
        $this->validate($original, $requires);
        $original['ChkValue'] = $this->checkValue($original);

        return $original;
    }

    protected function validate(array $data, array $requires): void
    {
        foreach ($requires as $require) {
            if (!isset($data[$require])) {
                throw new RefundException("Missing parameter \"$require\".");
            }
        }
    }

    protected function checkValue(array $data): string
    {
        return hash('sha256', $data['web'] . $this->apiKey . $data['buysafeno'] . $data['MN'] . $data['Td']);
    }
}