<?php

namespace Tustin\Haste\Http;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\Request;
use Tustin\Haste\Http\JsonStream;

use GuzzleHttp\Client as GuzzleClient;

abstract class HttpClient
{
    protected $httpClient;

    private Response $lastResponse;

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Sends a GET request.
     *
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return object|null
     */
    public function get(string $path = '', array $body = [], array $headers = []) : ?object
    {
        // $path .= (strpos($path, '?') === false) ? '?' : '&';
        // $path .= http_build_query($body);

        return ($this->lastResponse = $this->httpClient->get($path, [
            'query' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a POST request as form data.
     *
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return object|null
     */
    public function post(string $path, array $body, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->post($path, [
            'form_params' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a POST request as JSON data.
     *
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return object|null
     */
    public function postJson(string $path, array $body, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->post($path, [
            'json' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a multi-part POST request.
     *
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return object|null
     */
    public function postMultiPart(string $path, array $body, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->post($path, [
            'multipart' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a DELETE request.
     *
     * @param string $path
     * @param array $headers
     * @return object|null
     */
    public function delete(string $path, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->delete($path, [
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a DELETE request with JSON data.
     *
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return object|null
     */
    public function deleteJson(string $path, array $body, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->delete($path, [
            'json' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a PATCH request.
     *
     * @param string $path
     * @param array $headers
     * @return object|null
     */
    public function patch(string $path, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->patch($path, [
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a PUT request with form data.
     *
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return object|null
     */
    public function put(string $path, array $body = null, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->put($path, [
            'form_params' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a PUT request with JSON data.
     *
     * @param string $path
     * @param [type] $body
     * @param array $headers
     * @return object|null
     */
    public function putJson(string $path, $body = null, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->put($path, [
            'json' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a PUT request that allows a string body, typically for raw file bytes.
     *
     * @param string $path
     * @param string $body
     * @param array $headers
     * @return object|null
     */
    public function putFile(string $path, string $body = null, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->put($path, [
            'body' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Sends a multi-part PUT request.
     *
     * @param string $path
     * @param [type] $body
     * @param array $headers
     * @return object|null
     */
    public function putMultiPart(string $path, array $body = null, array $headers = []) : ?object
    {
        return ($this->lastResponse = $this->httpClient->put($path, [
            'multipart' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Returns the last response that was received.
     *
     * @return Response|null
     */
    public function getLastResponse() : ?Response
    {
        return $this->lastResponse;
    }
}