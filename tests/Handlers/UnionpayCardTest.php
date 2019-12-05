<?php

namespace Test\Handlers;

use Muzik\EsafeSdk\Foundation\Testing\Faker;
use Muzik\EsafeSdk\Handlers\UnionpayCard;
use PHPUnit\Framework\TestCase;

class UnionpayCardTest extends TestCase
{
    use Faker;

    protected $parameters = [
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
        'Card_Type' => '1',
        'UserNo' => '',
        'PayDate' => '',
        'PayTime' => '',
        'SendType' => '1',
        'errcode' => '00',
        'errmsg' => '',
        'PayType' => '',
        'PayAgency' => '',
        'PayAgencyMemo' => '',
        'PayAgencyName' => '',
        'PayAgencyTel' => '',
        'PayAgencyAddress' => '',
        'CargoNo' => '',
        'StoreName' => '',
        'StoreID' => '',
        'InvoiceNo' => '',
        'tokenData' => '',
        'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
    ];

    public function test_constructable()
    {
        $this->assertInstanceOf(UnionpayCard::class, new UnionpayCard($this->makeRequest($this->parameters), 'abcd5888'));
    }
}