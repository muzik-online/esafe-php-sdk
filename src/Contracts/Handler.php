<?php

namespace Muzik\EsafeSdk\Contracts;

interface Handler
{
    public function getParameters(): array;
    public function getTransactionReference(): string;
}
