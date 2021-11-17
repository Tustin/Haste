<?php

namespace Tustin\Haste\Http\Middleware;

use GuzzleHttp\Psr7\Request;

final class AuthenticationMiddleware
{
    /**
     * @var array
     */
    private array $authenticationItems = [];

    /**
     * Creates the authentication middleware.
     *
     * @param array $authenticationItems
     */
    public function __construct(array $authenticationItems)
    {
        $this->authenticationItems = $authenticationItems;
    }

    /**
     * Intercepts all requests to inject any authentication headers.
     *
     * @param Request $request
     * @param array $options
     * @return Request
     */
    public function __invoke(Request $request, array $options = []): Request
    {
        foreach ($this->authenticationItems as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        return $request;
    }
}
