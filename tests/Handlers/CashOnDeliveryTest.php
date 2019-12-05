<?php

namespace Test\Handlers;

use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\CashOnDelivery;
use Muzik\EsafeSdk\Foundation\Testing\Faker;

class CashOnDeliveryTest extends TestCase
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
        'BarcodeA' => '',
        'BarcodeB' => '',
        'BarcodeC' => '',
        'PostBarcodeA' => '',
        'PostBarcodeB' => '',
        'PostBarcodeC' => '',
        'EntityATM' => '',
        'BankCode' => '',
        'BankName' => '',
        'CargoNo' => 'F23501480823',
        'StoreName' => '統一取貨用',
        'StoreID' => '167606',
        'InvoiceNo' => '',
        'tokenData' => '',
        'ChkValue' => '7EBA96AA5FAEBC72E48A284C74840E81D5B4B5FA',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(CashOnDelivery::class, new CashOnDelivery($this->makeRequest($this->parameters), 'abcd5888'));
    }

    public function test_get_parameters()
    {
        $handler = new CashOnDelivery($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertEquals([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'MN' => '1000',
            'webname' => '英屬維京群島商希幔數位有限公司台灣分公司',
            'Name' => 'V****** **i',
            'SendType' => '1',
            'CargoNo' => 'F23501480823',
            'StoreName' => '統一取貨用',
            'StoreID' => '167606',
            'ChkValue' => '7EBA96AA5FAEBC72E48A284C74840E81D5B4B5FA',
        ], $handler->getParameters());
    }
}
