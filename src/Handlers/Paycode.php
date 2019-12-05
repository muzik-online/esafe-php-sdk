<?php

namespace Muzik\EsafeSdk\Handlers;

class Paycode extends BaseHandler
{
    protected function checkValue(): string
    {
        $data = $this->web . $this->apiKey . $this->buysafeno . $this->MN . $this->paycode;

        return strtoupper(hash('sha1', $data));
    }
}
