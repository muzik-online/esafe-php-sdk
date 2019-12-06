<?php

namespace Test\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Muzik\EsafeSdk\Exceptions\HandlerException;
use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Services\RefundService;
use Muzik\EsafeSdk\Exceptions\RefundException;

class RefundTest extends TestCase
{
    public function test_constructable()
    {
        $this->assertInstanceOf(RefundService::class, new RefundService([
            'web' => 'S1103020010',
            'MN' => '1000',
            'buysafeno' => '2400009912300000019',
            'Td' => 'AC9087201',
            'RefundMemo' => 'Hello World',
        ], 'abcd5888'));
    }

    public function test_construct_failed_missing_required_parameter()
    {
        $this->expectException(RefundException::class);
        new RefundService([], 'abcd5888');
    }

    public function test_construct_failed_empty_required_parameter()
    {
        $this->expectException(RefundException::class);
        new RefundService([
            'web' => 'S1103020010',
            'MN' => '1000',
            'buysafeno' => '2400009912300000019',
            'Td' => '',
            'RefundMemo' => 'Hello World',
        ], 'abcd5888');
    }

    public function test_send_connection_failed()
    {
        $mock = new MockHandler([
            new RequestException('Error Communicating with Server', new Request('post', 'http://esafe.test/'))
        ]);
        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $this->expectException(RefundException::class);
        $service = new RefundService([
            'web' => 'S1103020010',
            'MN' => '1000',
            'buysafeno' => '2400009912300000019',
            'Td' => 'AC9087201',
            'RefundMemo' => 'Hello World',
        ], 'abcd5888', true, $client);
        $service->send();
    }

    public function test_send_response_unexpected()
    {
        $mock = new MockHandler([
            new Response(200, [], '非授權使用位置.請與紅陽端提出申請')
        ]);
        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $this->expectException(RefundException::class);
        $service = new RefundService([
            'web' => 'S1103020010',
            'MN' => '1000',
            'buysafeno' => '2400009912300000019',
            'Td' => 'AC9087201',
            'RefundMemo' => 'Hello World',
        ], 'abcd5888', true, $client);
        $service->send();
    }
}
