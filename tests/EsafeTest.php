<?php

namespace Test;

use Muzik\EsafeSdk\Esafe;
use PHPUnit\Framework\TestCase;

class EsafeTest extends TestCase
{
    public function test_constructable()
    {
        $this->assertInstanceOf(Esafe::class, new Esafe([
            'transaction_password' => 'abcd5888'
        ]));
    }
}
