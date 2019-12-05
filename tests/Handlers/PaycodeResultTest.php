<?php

namespace Test\Handlers;

use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\PaycodeResult;
use Muzik\EsafeSdk\Foundation\Testing\Faker;

/*
 * Notice: This test case is not mocked by esafe.com.tw responses.
 */
class PaycodeResultTest extends TestCase
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
        'UserNo' => '',
        'PayDate' => '20200101',
        'PayType' => '5',
        'PayAgency' => '',
        'PayAgencyName' => '',
        'PayAgencyTel' => '',
        'PayAgencyAddress' => '',
        'errcode' => '00',
        'CargoNo' => '',
        'StoreID' => '',
        'StoreName' => '',
        'InvoiceNo' => '',
        'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(PaycodeResult::class, new PaycodeResult($this->makeRequest($this->parameters), 'abcd5888'));
    }
}
