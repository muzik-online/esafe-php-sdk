<?php

namespace Muzik\EsafeSdk\Handlers;

class CashOnDeliveryResult extends BaseHandler
{
    protected function checkValue(): string
    {
        $data = $this->web . $this->apiKey . $this->buysafeno . $this->MN . $this->errcode;

        return strtoupper(hash('sha1', $data));
    }
}
