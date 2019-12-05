<?php

namespace Muzik\EsafeSdk\Foundation;

use Muzik\EsafeSdk\Exceptions\HandlerException;

trait Validation
{
    protected function validate()
    {
        if (!isset($this->parameters['ChkValue'])) {
            throw new HandlerException('Missing "ChkValue" parameter from response.');
        }

        if ($this->checkValue() !== $this->parameters['ChkValue']) {
            throw new HandlerException('Mismatch data and ChkValue');
        }
    }

    abstract protected function checkValue(): string;
}
