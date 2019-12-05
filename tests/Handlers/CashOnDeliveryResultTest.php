<?php

namespace Test\Handlers;

use Muzik\EsafeSdk\Foundation\Testing\Faker;
use Muzik\EsafeSdk\Handlers\CashOnDeliveryResult;
use PHPUnit\Framework\TestCase;

/*
 * Notice: This test case is not mocked by esafe.com.tw responses.
 */
class CashOnDeliveryResultTest extends TestCase
{
    use Faker;

    protected $parameters = [
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
}