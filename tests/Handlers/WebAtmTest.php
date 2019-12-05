<?php

namespace Test\Handlers;

use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\WebAtm;
use Muzik\EsafeSdk\Foundation\Testing\Faker;

class WebAtmTest extends TestCase
{
    use Faker;

    protected array $parameters = [
        'buysafeno' => 	'2400009912300000019',
        'web' => 	'S1103020010',
        'MN' => 	'1000',
        'Td' => 	'',
        'webname' => 	'英屬維京群島商希幔數位有限公司台灣分公司',
        'Name' => 	'V****** **i',
        'note1' => 	'',
        'note2' => 	'',
        'ApproveCode' => 	'',
        'Card_NO' => 	'',
        'Card_Type' => 	'',
        'UserNo' => 	'',
        'PayDate' => 	'',
        'PayTime' => 	'',
        'SendType' => 	'1',
        'errcode' => 	'00',
        'errmsg' => 	'交易成功',
        'paycode' => 	'',
        'PayType' => 	'',
        'PayAgency' => 	'',
        'PayAgencyMemo' => 	'',
        'PayAgencyName' => 	'',
        'PayAgencyTel' => 	'',
        'PayAgencyAddress' => 	'',
        'BarcodeA' => 	'',
        'BarcodeB' => 	'',
        'BarcodeC' => 	'',
        'PostBarcodeA' => 	'',
        'PostBarcodeB' => 	'',
        'PostBarcodeC' => 	'',
        'EntityATM' => 	'',
        'BankCode' => 	'',
        'BankName' => 	'',
        'CargoNo' => 	'',
        'StoreName' => 	'',
        'StoreID' => 	'',
        'InvoiceNo' => 	'',
        'tokenData' => 	'',
        'ChkValue' => 	'6E0ED343525CDCBE678BB1103054CBA25E634282',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(WebAtm::class, new WebAtm($this->makeRequest($this->parameters), 'abcd5888'));
    }
}
