<?php

namespace Muzik\EsafeSdk\Handlers;

use Muzik\EsafeSdk\Contracts\Handler;
use Psr\Http\Message\ServerRequestInterface;

abstract class BaseHandler implements Handler
{
    /**
     * The parameters requested from esafe.com.tw.
     *
     * @var array
     */
    protected array $parameters;

    /**
     * The transaction password initialized by entrypoint.
     *
     * @var string
     */
    protected string $apiKey;

    public function __construct(ServerRequestInterface $request, string $apiKey)
    {
        $this->parameters = array_filter((array) $request->getParsedBody(), fn ($item) => $item !== '');
        $this->apiKey = $apiKey;
    }
}
