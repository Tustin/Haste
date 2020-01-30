<?php

namespace Tustin\Haste;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;

use GuzzleHttp\HandlerStack;
use Tustin\Haste\Http\HttpClient;
use Tustin\Haste\Http\Middleware\AuthenticationMiddleware;
use Tustin\Haste\Http\Middleware\ResponseHandlerMiddleware;

abstract class AbstractClient extends HttpClient
{
    protected array $guzzleOptions;

    public function __construct(array $guzzleOptions = [])
    {
        if (!isset($guzzleOptions['handler']))
        {
            $guzzleOptions['handler'] = HandlerStack::create();
        }

        $this->guzzleOptions = $guzzleOptions;

        $this->httpClient = new Client($this->guzzleOptions);

        $handler = $this->getHandler();

        $handler->push(
            Middleware::mapResponse(
                new ResponseHandlerMiddleware
            )
        );
    }

    /**
     * Creates a new instance of the AbstractClient.
     *
     * @param array $guzzleOptions
     * @return AbstractClient
     */
    public static final function create(array $guzzleOptions = []) : AbstractClient
    {
        return new static($guzzleOptions);
    }

    /**
     * Gets the HandlerStack for the Guzzle client.
     * 
     * Will create one if it does not exist.
     *
     * @return HandlerStack
     */
    protected final function getHandler() : HandlerStack
    {
        $config  = $this->httpClient->getConfig();
        return $config['handler'] ??= HandlerStack::create();
    }

    /**
     * Pushes an AuthenticationMiddleware onto the Guzzle client HandlerStack for authenticated requests.
     *
     * @param AuthenticationMiddleware $middleware
     * @return void
     */
    protected final function pushAuthenticationMiddleware(AuthenticationMiddleware $middleware) : void
    {
        $handler = $this->getHandler();
        $handler->push(
            Middleware::mapRequest(
                $middleware
            )
        );
    }
}