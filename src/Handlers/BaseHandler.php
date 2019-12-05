<?php

namespace Muzik\EsafeSdk\Handlers;

use Muzik\EsafeSdk\Contracts\Handler;
use Psr\Http\Message\ServerRequestInterface;

abstract class BaseHandler implements Handler
{
    public function __construct(ServerRequestInterface $request, string $apiKey)
    {
    }
}