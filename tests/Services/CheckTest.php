<?php

namespace Test\Services;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Muzik\EsafeSdk\Services\CheckService;
use GuzzleHttp\Exception\RequestException;
use Muzik\EsafeSdk\Exceptions\CheckException;

class CheckTest extends TestCase
{
    public function test_constructable()
    {
        $this->assertInstanceOf(CheckService::class, new CheckService([
            'web' => 'S1103020010',
            'MN' => '1000',
        ], 'abcd5888'));
    }

    public function test_construct_failed_missing_required_parameter()
    {
        $this->expectException(CheckException::class);
        new CheckService([], 'abcd5888');
    }

    public function test_send_connection_failed()
    {
        $mock = new MockHandler([
            new RequestException('Error Communicating with Server', new Request('post', 'http://esafe.test/'))
        ]);
        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $this->expectException(CheckException::class);
        $service = new CheckService([
            'web' => 'S1103020010',
            'MN' => '1000',
        ], 'abcd5888', true, $client);
        $service->send();
    }

    public function test_send_response_unexpected()
    {
        $mock = new MockHandler([
            new Response(200, [], '無交易，請聯絡您的商家')
        ]);
        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $this->expectException(CheckException::class);
        $service = new CheckService([
            'web' => 'S1103020010',
            'MN' => '1000',
        ], 'abcd5888', true, $client);
        $service->send();
    }

    public function test_send()
    {
        $mock = new MockHandler([
            new Response(200, [], "S1103020010##E400009912300000019##110##201112311825##00##4321##A12345##1B9AB76287215E3497C002B955E7203A9B456276\r\nS1103020010##E400009912300000019##110##201112311825##00##4321##A12345##1B9AB76287215E3497C002B955E7203A9B456276")
        ]);
        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $service = new CheckService([
            'web' => 'S1103020010',
            'MN' => '110',
        ], 'abcd5888', true, $client);
        $result = $service->send();

        $this->assertEquals([
            [
                'web' => 'S1103020010',
                'buysafeno' => 'E400009912300000019',
                'MN' => '110',
                'transaction_datetime' => '201112311825',
                'errcode' => '00',
                'Card_NO' => '4321',
                'ApproveCode' => 'A12345',
                'ChkValue' => '1B9AB76287215E3497C002B955E7203A9B456276',
            ],
            [
                'web' => 'S1103020010',
                'buysafeno' => 'E400009912300000019',
                'MN' => '110',
                'transaction_datetime' => '201112311825',
                'errcode' => '00',
                'Card_NO' => '4321',
                'ApproveCode' => 'A12345',
                'ChkValue' => '1B9AB76287215E3497C002B955E7203A9B456276',
            ]
        ], $result);
    }
}
