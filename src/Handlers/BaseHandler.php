<?php

namespace Muzik\EsafeSdk\Handlers;

use Muzik\EsafeSdk\Contracts\Handler;
use Muzik\EsafeSdk\Foundation\Validation;
use Psr\Http\Message\ServerRequestInterface;
use Muzik\EsafeSdk\Exceptions\HandlerException;

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

    /**
     * BaseHandler constructor.
     * @param ServerRequestInterface|array $request
     * @param string $apiKey
     */
    public function __construct($request, string $apiKey)
    {
        $this->parameters = array_filter($this->parseRequest($request), fn ($item) => $item !== '');
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

    public function getTransactionReference(): string
    {
        if (isset($this->parameters['buysafeno'])) {
            return $this->parameters['buysafeno'];
        }

        throw new HandlerException('Missing "buysafeno" from response');
    }

    protected function parseRequest($request): array
    {
        if ($request instanceof ServerRequestInterface) {
            return (array) $request->getParsedBody();
        } elseif (is_array($request)) {
            return $request;
        }

        throw new HandlerException('Request must be "Psr\Http\Message\ServerRequestInterface" or array.');
    }
}
