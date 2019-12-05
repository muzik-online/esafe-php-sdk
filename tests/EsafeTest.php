<?php

namespace Test;

use Muzik\EsafeSdk\Esafe;
use PHPUnit\Framework\TestCase;
use Muzik\EsafeSdk\Services\RefundService;

class EsafeTest extends TestCase
{
    public function test_constructable()
    {
        $this->assertInstanceOf(Esafe::class, new Esafe([
            'transaction_password' => 'abcd5888'
        ]));
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
