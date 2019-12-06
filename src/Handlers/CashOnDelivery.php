<?php

namespace Muzik\EsafeSdk\Handlers;

use Muzik\EsafeSdk\Exceptions\HandlerException;

class CashOnDelivery extends BaseHandler
{
    protected function checkValue(): string
    {
        if (!isset($this->parameters['CargoNo'])) {
            throw new HandlerException('Missing "CargoNo" parameter.');
        }

        $data = $this->web . $this->apiKey . $this->buysafeno . $this->MN . $this->CargoNo;

        return strtoupper(hash('sha1', $data));
    }
}
