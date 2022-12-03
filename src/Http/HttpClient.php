<?php

namespace Tustin\Haste\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

abstract class HttpClient
{
    protected Client $httpClient;

    private Response $lastResponse;

    /**
     * Gets the Guzzle HTTP client.
     *
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * Sends a GET request.
     *
     * @param string $path
     * @param array $body
     * @param array $headers
     * @return mixed
     */
    public function get(string $path = '', array $body = [], array $headers = []): mixed
    {
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
     * @return mixed
     */
    public function post(string $path, array $body, array $headers = []): mixed
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
     * @return mixed
     */
    public function postJson(string $path, array $body, array $headers = []): mixed
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
     * @return mixed
     */
    public function postMultiPart(string $path, array $body, array $headers = []): mixed
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
     * @return mixed
     */
    public function delete(string $path, array $headers = []): mixed
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
     * @return mixed
     */
    public function deleteJson(string $path, array $body, array $headers = []): mixed
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
     * @return mixed
     */
    public function patch(string $path, array $headers = []): mixed
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
     * @return mixed
     */
    public function put(string $path, $body = null, $headers = []): mixed
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
     * @return mixed
     */
    public function putJson(string $path, $body = null, $headers = []): mixed
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
     * @return mixed
     */
    public function putFile(string $path, $body = null, $headers = []): mixed
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
     * @return mixed
     */
    public function putMultiPart(string $path, $body = null, array $headers = []): mixed
    {
        return ($this->lastResponse = $this->httpClient->put($path, [
            'multipart' => $body,
            'headers' => $headers
        ]))->getBody()->jsonSerialize();
    }

    /**
     * Streams a file.
     *
     * @param string $path
     * @param array $headers
     * @return string
     */
    public function stream(string $path, array $headers = []): string
    {
        return ($this->lastResponse = $this->httpClient->get($path, [
            'headers' => $headers,
            'stream' => true
        ]))->getBody();
    }

    /**
     * Returns the last response that was received.
     *
     * @return Response|null
     */
    public function getLastResponse(): ?Response
    {
        return $this->lastResponse;
    }
}
