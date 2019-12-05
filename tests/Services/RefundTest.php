<?php

namespace Test\Services;

use Muzik\EsafeSdk\Exceptions\RefundException;
use Muzik\EsafeSdk\Services\RefundService;
use PHPUnit\Framework\TestCase;

class RefundTest extends TestCase
{
    public function test_constructable()
    {
        $this->assertInstanceOf(RefundService::class, new RefundService([
            'web' => 'S1103020010',
            'MN' => '1000',
            'buysafeno' => '2400009912300000019',
            'Td' => 'AC9087201',
            'RefundMemo' => 'Hello World',
        ], 'abcd5888'));
    }

    public function test_construct_failed_missing_required_parameter()
    {
        $this->expectException(RefundException::class);
        new RefundService([], 'abcd5888');
    }

    public function test_construct_failed_empty_required_parameter()
    {
        $this->expectException(RefundException::class);
        new RefundService([
            'web' => 'S1103020010',
            'MN' => '1000',
            'buysafeno' => '2400009912300000019',
            'Td' => '',
            'RefundMemo' => 'Hello World',
        ], 'abcd5888');
    }
}