<?php

namespace Test;

use Muzik\EsafeSdk\Esafe;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\ServerRequest;
use Muzik\EsafeSdk\Handlers\CreditCard;
use Muzik\EsafeSdk\Services\RefundService;

class EsafeTest extends TestCase
{
    public function test_constructable()
    {
        $this->assertInstanceOf(Esafe::class, new Esafe([
            'transaction_password' => 'abcd5888'
        ]));
    }

    public function test_handle()
    {
        $sdk = new Esafe([
            'transaction_password' => 'abcd5888',
        ]);

        $request = [
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'MN' => '1000',
            'webname' => '英屬維京群島商希幔數位有限公司台灣分公司',
            'Name' => 'V****** **i',
            'ApproveCode' => 'T3NCCC',
            'Card_NO' => '1111',
            'Card_Type' => '0',
            'SendType' => '1',
            'errcode' => '00',
            'errmsg' => '成功交易',
            'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
        ];

        $arrayHandler = $sdk->handle(Esafe::HANDLER_CREDIT_CARD, $request);
        $serverRequestHandler = $sdk->handle(Esafe::HANDLER_CREDIT_CARD, (new ServerRequest('post', 'http://esafe.test'))->withParsedBody($request));

        $this->assertInstanceOf(CreditCard::class, $arrayHandler);
        $this->assertInstanceOf(CreditCard::class, $serverRequestHandler);
    }

    public function test_refund()
    {
        $sdk = new Esafe([
            'transaction_password' => 'abcd5888',
        ]);

        $this->assertInstanceOf(RefundService::class, $sdk->refund([
            'web' => 'S1103020010',
            'MN' => '1000',
            'buysafeno' => '2400009912300000019',
            'Td' => 'AC9087201',
            'RefundMemo' => 'Hello World',
        ], true));
    }
}
