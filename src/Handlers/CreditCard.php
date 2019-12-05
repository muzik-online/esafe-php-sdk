<?php

namespace Muzik\EsafeSdk\Handlers;

class CreditCard extends BaseHandler
{
    protected function checkValue(): string
    {
        $data = $this->web . $this->apiKey . $this->buysafeno . $this->MN . $this->errcode . $this->CargoNo;

        return strtoupper(hash('sha1', $data));
    }
}
