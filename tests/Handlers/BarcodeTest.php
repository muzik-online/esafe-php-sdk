<?php

namespace Test\Handlers;

use Muzik\EsafeSdk\Exceptions\HandlerException;
use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\Barcode;
use Muzik\EsafeSdk\Foundation\Testing\Faker;

class BarcodeTest extends TestCase
{
    use Faker;

    protected array $parameters = [
        'buysafeno' => '2400009912300000019',
        'web' => 'S1103020010',
        'MN' => '1000',
        'Td' => '',
        'webname' => '英屬維京群島商希幔數位有限公司台灣分公司',
        'Name' => 'V****** **i',
        'note1' => '',
        'note2' => '',
        'ApproveCode' => '',
        'Card_NO' => '',
        'Card_Type' => '',
        'UserNo' => '',
        'PayDate' => '',
        'PayTime' => '',
        'SendType' => '1',
        'errcode' => '',
        'errmsg' => '',
        'paycode' => '',
        'PayType' => '',
        'PayAgency' => '',
        'PayAgencyMemo' => '',
        'PayAgencyName' => '',
        'PayAgencyTel' => '',
        'PayAgencyAddress' => '',
        'BarcodeA' => '*000000000*',
        'BarcodeB' => '*TES000000000000*',
        'BarcodeC' => '*000000000000000*',
        'PostBarcodeA' => '*00000000*',
        'PostBarcodeB' => '*TES000000000000*',
        'PostBarcodeC' => '*000000000000000*',
        'EntityATM' => '91708888888888',
        'BankCode' => '8220163',
        'BankName' => '中國信託銀行 敦南分行',
        'CargoNo' => '',
        'StoreName' => '',
        'StoreID' => '',
        'InvoiceNo' => '',
        'tokenData' => '',
        'ChkValue' => 'C0A61FA4830F0B171273B2DC0CCFA2A9BA719A76',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(Barcode::class, new Barcode($this->makeRequest($this->parameters), 'abcd5888'));
    }

    public function test_construct_by_array_request()
    {
        $this->assertInstanceOf(Barcode::class, new Barcode($this->parameters, 'abcd5888'));
    }

    public function test_construct_failed()
    {
        $this->expectException(HandlerException::class);
        new Barcode('not array', 'abcd5888');
    }

    public function test_get_parameters()
    {
        $handler = new Barcode($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertEquals([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'MN' => '1000',
            'webname' => '英屬維京群島商希幔數位有限公司台灣分公司',
            'Name' => 'V****** **i',
            'SendType' => '1',
            'BarcodeA' => '*000000000*',
            'BarcodeB' => '*TES000000000000*',
            'BarcodeC' => '*000000000000000*',
            'PostBarcodeA' => '*00000000*',
            'PostBarcodeB' => '*TES000000000000*',
            'PostBarcodeC' => '*000000000000000*',
            'EntityATM' => '91708888888888',
            'BankCode' => '8220163',
            'BankName' => '中國信託銀行 敦南分行',
            'ChkValue' => 'C0A61FA4830F0B171273B2DC0CCFA2A9BA719A76',
        ], $handler->getParameters());
    }
}
