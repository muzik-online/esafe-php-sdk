<?php

namespace Muzik\EsafeSdk\Handlers;

class Barcode extends BaseHandler
{
    protected function checkValue(): string
    {
        $data = $this->web . $this->apiKey . $this->buysafeno . $this->MN . $this->EntityATM;

        return strtoupper(hash('sha1', $data));
    }
}
