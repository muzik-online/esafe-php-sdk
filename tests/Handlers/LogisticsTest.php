<?php

namespace Test\Handlers;

use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\Logistics;
use Muzik\EsafeSdk\Foundation\Testing\Faker;
use Muzik\EsafeSdk\Exceptions\HandlerException;

/*
 * Notice: This test case is not mocked by esafe.com.tw responses.
 */
class LogisticsTest extends TestCase
{
    use Faker;

    protected array $parameters = [
        'buysafeno' => '2400009912300000019',
        'web' => 'S1103020010',
        'Td' => '',
        'note1' => '',
        'note2' => '',
        'SendType' => '1',
        'StoreType' => '1010',
        'StoreMsg' => '',
        'ChkValue' => '30C8841E48631373DEA2C8FBA751F5BAF6EF7501',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(Logistics::class, new Logistics($this->makeRequest($this->parameters), 'abcd5888'));
    }

    public function test_construct_by_array_request()
    {
        $this->assertInstanceOf(Logistics::class, new Logistics($this->parameters, 'abcd5888'));
    }

    public function test_construct_failed()
    {
        $this->expectException(HandlerException::class);
        new Logistics('not array', 'abcd5888');
    }

    public function test_get_parameters()
    {
        $handler = new Logistics($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertEquals([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'SendType' => '1',
            'StoreType' => '1010',
            'ChkValue' => '30C8841E48631373DEA2C8FBA751F5BAF6EF7501',
        ], $handler->getParameters());
    }

    public function test_get_transaction_references()
    {
        $handler = new Logistics($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertSame('2400009912300000019', $handler->getTransactionReference());
    }
}
