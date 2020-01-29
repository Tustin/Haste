<?php

namespace Tustin\Haste\Http;

use GuzzleHttp\Psr7\Request;

final class AuthenticationMiddleware
{
    private $authenticationItems = [];

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
     * @return void
     */
    public function __invoke(Request $request, array $options = [])
    {
        foreach ($this->authenticationItems as $key => $value)
        {
            $request = $request->withHeader($key, $value);
        }

        return $request;
    }
}