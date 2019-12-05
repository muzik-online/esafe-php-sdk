<?php

namespace Test\Handlers;

use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Handlers\BankTransfer;
use Muzik\EsafeSdk\Foundation\Testing\Faker;

class BankTransferTest extends TestCase
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
        $this->assertInstanceOf(BankTransfer::class, new BankTransfer($this->makeRequest($this->parameters), 'abcd5888'));
    }

    public function test_get_parameters()
    {
        $handler = new BankTransfer($this->makeRequest($this->parameters), 'abcd5888');

        $this->assertEquals([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'MN' => '1000',
            'webname' => '英屬維京群島商希幔數位有限公司台灣分公司',
            'Name' => 'V****** **i',
            'SendType' => '1',
            'EntityATM' => '91708888888888',
            'BankCode' => '8220163',
            'BankName' => '中國信託銀行 敦南分行',
            'ChkValue' => 'C0A61FA4830F0B171273B2DC0CCFA2A9BA719A76',
        ], $handler->getParameters());
    }
}
