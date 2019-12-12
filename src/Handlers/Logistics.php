<?php

namespace Muzik\EsafeSdk\Handlers;

class Logistics extends BaseHandler
{
    protected function checkValue(): string
    {
        $data = $this->web . $this->apiKey . $this->buysafeno . $this->CargoNo;

        return strtoupper(hash('sha1', $data));
    }
}