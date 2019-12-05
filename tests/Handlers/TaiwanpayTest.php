<?php

namespace Test\Handlers;

use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\Taiwanpay;
use Muzik\EsafeSdk\Foundation\Testing\Faker;

/*
 * Notice: This test case is not mocked by esafe.com.tw responses.
 */
class TaiwanpayTest extends TestCase
{
    use Faker;

    protected array $parameters = [
        'buysafeno' => '2400009912300000019',
        'web' => 'S1103020010',
        'Td' => '',
        'MN' => '1000',
        'webname' => '',
        'Name' => 'V****** **i',
        'note1' => '',
        'note2' => '',
        'SendType' => '1',
        'errcode' => '00',
        'errmsg' => '',
        'CargoNo' => '',
        'StoreID' => '',
        'StoreName' => '',
        'InvoiceNo' => '',
        'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(Taiwanpay::class, new Taiwanpay($this->makeRequest($this->parameters), 'abcd5888'));
    }

    public function test_get_parameters()
    {
        $handler = new Taiwanpay($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertEquals([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'MN' => '1000',
            'Name' => 'V****** **i',
            'SendType' => '1',
            'errcode' => '00',
            'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
        ], $handler->getParameters());
    }
}