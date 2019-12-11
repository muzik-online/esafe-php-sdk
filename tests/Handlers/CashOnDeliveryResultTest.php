<?php

namespace Test\Handlers;

use Muzik\EsafeSdk\Exceptions\HandlerException;
use Muzik\EsafeSdk\Handlers\BankTransferResult;
use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Foundation\Testing\Faker;
use Muzik\EsafeSdk\Handlers\CashOnDeliveryResult;

/*
 * Notice: This test case is not mocked by esafe.com.tw responses.
 */
class CashOnDeliveryResultTest extends TestCase
{
    use Faker;

    protected array $parameters = [
        'buysafeno' => '2400009912300000019',
        'web' => 'S1103020010',
        'Td' => '',
        'MN' => '1000',
        'Name' => 'V****** **i',
        'note1' => '',
        'note2' => '',
        'SendType' => '1',
        'errcode' => '00',
        'CargoNo' => 'F23501480823',
        'InvoiceNo' => '',
        'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(CashOnDeliveryResult::class, new CashOnDeliveryResult($this->makeRequest($this->parameters), 'abcd5888'));
    }

    public function test_construct_by_array_request()
    {
        $this->assertInstanceOf(CashOnDeliveryResult::class, new CashOnDeliveryResult($this->parameters, 'abcd5888'));
    }

    public function test_construct_failed()
    {
        $this->expectException(HandlerException::class);
        new CashOnDeliveryResult('not array', 'abcd5888');
    }

    public function test_get_parameters()
    {
        $handler = new CashOnDeliveryResult($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertEquals([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'MN' => '1000',
            'Name' => 'V****** **i',
            'SendType' => '1',
            'errcode' => '00',
            'CargoNo' => 'F23501480823',
            'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
        ], $handler->getParameters());
    }

    public function test_get_transaction_reference()
    {
        $handler = new CashOnDeliveryResult($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertSame('2400009912300000019', $handler->getTransactionReference());
    }
}
