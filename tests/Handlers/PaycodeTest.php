<?php

namespace Test\Handlers;

use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\Paycode;
use Muzik\EsafeSdk\Foundation\Testing\Faker;

class PaycodeTest extends TestCase
{
    use Faker;

    protected array $parameters = [
        'buysafeno' =>	'2400009912300000019',
        'web' =>	'S1103020010',
        'MN' =>	'1000',
        'Td' =>	'',
        'webname' =>	'香港商帕格數碼媒體股份有限公司',
        'Name' =>	'V****** **i',
        'note1' =>	'',
        'note2' =>	'',
        'ApproveCode' =>	'',
        'Card_NO' =>	'',
        'Card_Type' =>	'',
        'UserNo' =>	'',
        'PayDate' =>	'',
        'PayTime' =>	'',
        'SendType' =>	'1',
        'errcode' =>	'',
        'errmsg' =>	'',
        'paycode' =>	'LAC90824000098',
        'PayType' =>	'4,5,6,7',
        'PayAgency' =>	'',
        'PayAgencyMemo' =>	'',
        'PayAgencyName' =>	'',
        'PayAgencyTel' =>	'',
        'PayAgencyAddress' =>	'',
        'BarcodeA' =>	'',
        'BarcodeB' =>	'',
        'BarcodeC' =>	'',
        'PostBarcodeA' =>	'',
        'PostBarcodeB' =>	'',
        'PostBarcodeC' =>	'',
        'EntityATM' =>	'',
        'BankCode' =>	'',
        'BankName' =>	'',
        'CargoNo' =>	'',
        'StoreName' =>	'',
        'StoreID' =>	'',
        'InvoiceNo' =>	'',
        'tokenData' =>	'',
        'ChkValue' =>	'9C53A993836A12DD477CF39FBB10E0C4E67323E0',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(Paycode::class, new Paycode($this->makeRequest($this->parameters), 'abcd5888'));
    }

    public function test_get_parameters()
    {
        $handler = new Paycode($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertEquals([
            'buysafeno' =>	'2400009912300000019',
            'web' =>	'S1103020010',
            'MN' =>	'1000',
            'webname' =>	'香港商帕格數碼媒體股份有限公司',
            'Name' =>	'V****** **i',
            'SendType' =>	'1',
            'paycode' =>	'LAC90824000098',
            'PayType' =>	'4,5,6,7',
            'ChkValue' =>	'9C53A993836A12DD477CF39FBB10E0C4E67323E0',
        ], $handler->getParameters());
    }
}
