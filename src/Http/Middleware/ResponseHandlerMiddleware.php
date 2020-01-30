<?php

namespace Tustin\Haste\Http\Middleware;

use GuzzleHttp\Psr7\Response;

use Tustin\Haste\Http\JsonStream;
use Psr\Http\Message\StreamInterface;
use Tustin\Haste\Http\ResponseParser;
use Tustin\Haste\Exception\ApiException;
use Tustin\Haste\Exception\NotFoundException;
use Tustin\Haste\Exception\AccessDeniedException;
use Tustin\Haste\Exception\UnauthorizedException;
use Tustin\Haste\Exception\UnsupportedMediaTypeException;

final class ResponseHandlerMiddleware
{
    /**
     * Handles all responses.
     *
     * @param Response $response
     * @param array $options
     * @return void
     */
    public function __invoke(Response $response, array $options = [])
    {
        $jsonStream = new JsonStream($response->getBody());

        if ($this->isSuccessful($response)) {
            return $response->withBody($jsonStream);
        }

        $this->handleErrorResponse($response, $jsonStream);
    }

    /**
     * Checks if the HTTP status code is successful.
     *
     * @param Response $response
     * @return bool
     */
    public function isSuccessful(Response $response) : bool
    {
        return $response->getStatusCode() < 400;
    }

    /**
     * Handles unsuccessful error codes by throwing the proper exception.
     *
     * @param Response $response
     * @return void
     */
    public function handleErrorResponse(Response $response, StreamInterface $stream) : void
    {
        switch ($response->getStatusCode())
        {
            case 400:
                throw new ApiException($stream);
            case 401:
                throw new UnauthorizedException;
            case 403:
                throw new AccessDeniedException;
            case 404:
                throw new NotFoundException;
            case 415:
                throw new UnsupportedMediaTypeException;
        }
    }
}