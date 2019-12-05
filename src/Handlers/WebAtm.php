<?php

namespace Muzik\EsafeSdk\Handlers;

class WebAtm extends BaseHandler
{
    protected function checkValue(): string
    {
        $data = $this->web . $this->apiKey . $this->buysafeno . $this->errcode . $this->CargoNo;

        return strtoupper(hash('sha1', $data));
    }
}
