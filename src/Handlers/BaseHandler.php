<?php

namespace Muzik\EsafeSdk\Handlers;

use Muzik\EsafeSdk\Contracts\Handler;
use Muzik\EsafeSdk\Foundation\Validation;
use Psr\Http\Message\ServerRequestInterface;

abstract class BaseHandler implements Handler
{
    use Validation;

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

        $this->validate();
    }

    public function __get(string $name): ?string
    {
        return $this->parameters[$name] ?? null;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
