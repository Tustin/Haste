<?php

namespace Tustin\Haste\Http;

use GuzzleHttp\Psr7\Response;

abstract class HttpClient
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var Response
     */
    private $lastResponse;

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
     * @return mixed
     */
    public function get($path = '', $body = [], $headers = [])
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
    public function post($path, $body, $headers = [])
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
    public function postJson($path, $body, $headers = [])
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
    public function postMultiPart($path, $body, $headers = [])
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
    public function delete($path, $headers = [])
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
    public function deleteJson($path, $body, $headers = [])
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
    public function patch($path, $headers = [])
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
    public function put($path, $body = null, $headers = [])
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
    public function putJson($path, $body = null, $headers = [])
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
    public function putFile($path, $body = null, $headers = [])
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
    public function putMultiPart($path, $body = null, $headers = [])
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
    public function getLastResponse()
    {
        return $this->lastResponse;
    }
}
