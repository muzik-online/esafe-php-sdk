<?php

namespace Muzik\EsafeSdk\Foundation\Testing;

use GuzzleHttp\Psr7\ServerRequest;

trait Faker
{
    private function makeRequest(array $parameters = [], string $method = 'post'): ServerRequest
    {
        return (new ServerRequest($method, 'http://esafe.test'))->withParsedBody($parameters);
    }
}