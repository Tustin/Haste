<?php

namespace Tustin\Haste\Http\Middleware;

use GuzzleHttp\Psr7\Response;

use Tustin\Haste\Http\JsonStream;
use Psr\Http\Message\StreamInterface;
use Tustin\Haste\Exception\ApiException;
use Tustin\Haste\Exception\NotFoundHttpException;
use Tustin\Haste\Exception\AccessDeniedHttpException;
use Tustin\Haste\Exception\UnauthorizedHttpException;
use Tustin\Haste\Exception\UnsupportedMediaTypeHttpException;

final class ResponseHandlerMiddleware
{
    /**
     * Handles all responses.
     *
     * @param Response $response
     * @param array $options
     * @return void
     */
    public function __invoke($response, $options = [])
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
    public function isSuccessful(Response $response): bool
    {
        return $response->getStatusCode() < 400;
    }

    /**
     * Handles unsuccessful error codes by throwing the proper exception.
     *
     * @param Response $response
     * @param StreamInterface $stream
     * 
     * @return void
     */
    public function handleErrorResponse(Response $response, StreamInterface $stream): void
    {
        switch ($response->getStatusCode()) {
            case 400:
                throw new ApiException($stream);
            case 401:
                throw new UnauthorizedHttpException;
            case 403:
                throw new AccessDeniedHttpException;
            case 404:
                throw new NotFoundHttpException;
            case 415:
                throw new UnsupportedMediaTypeHttpException;
        }
    }
}
