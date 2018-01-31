<?php

namespace CapsuleCRM\Core;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CapsulecrmManager
{

    /**
     * Personal Access Token
     *
     * @var string
     */
    protected $token;

    /**
     * Application Name
     *
     * @var name
     */
    protected $appName;

    /**
     * base url of api
     *
     * @var string
     */
    protected $baseUri;

    /**
     * api url
     *
     * @var string
     */
    protected $url;

    /**
     * Set $token, $appName and $baseUri value
     *
     * @return void
     */
    public function __construct()
    {
        $this->token = config('capsulecrm.token');
        $this->appName = config('capsulecrm.app_name');
        $this->baseUri = config('capsulecrm.base_uri');
    }

    /**
     * prepare the url with base url
     *
     * @param string $url
     * @return string
     */
    protected function prepareUrl($url = null)
    {
        return ($this->baseUri . (($url != null) ? $url : $this->url));
    }

    /**
     * Send a GET request
     *
     * @return \GuzzleHttp\json_decode() content
     */
    protected function get($code = true, $body=null)
    {
        try {
            $request = new Request("GET", $this->prepareUrl($body), $this->getHeaders());
            $content = $this->client()->send($request)->getBody()->getContents();

            return \GuzzleHttp\json_decode($content);
        } catch (ClientException $ex) {
            return $code ? $ex->getCode() : $ex;
        }
    }

    /**
     * Send a request
     *
     * @param string $method Method of Request
     * @param string $body
     * @param boolean $code return code or object
     * @return int|ClientException|Response
     */
    private function proccessRequest($method, $body, $param = null, $code = true)
    {
        try {
            $request = new Request($method, $this->prepareUrl($param), $this->getHeaders(), $body);
            $response = $this->client()->send($request);
            return ($code ? $response->getStatusCode() : $response);
        } catch (ClientException $ex) {
            return ($code ? $ex->getCode() : $ex);
        }
    }

    /**
     * Send a POST request
     *
     * @param string $body
     * @param boolean $code return code or object
     * @return int|ClientException|Response
     */
    protected function post($body, $code = true)
    {
        return $this->proccessRequest("POST", json_encode($body), null, $code);
    }

    /**
     * Send a PUT request
     *
     * @param string $body
     * @param boolean $code return code or object
     * @return int|ClientException|Response
     */
    protected function put($body, $param=null, $code = true)
    {
        return $this->proccessRequest("PUT", json_encode($body), $param, $code);
    }

    /**
     * Send a Delete request
     *
     * @param string $body
     * @param boolean $code return code or object
     * @return int|ClientException|Response
     */
    protected function delete($body, $code = true)
    {
        return $this->proccessRequest("DELETE", $body, $code);
    }

    /**
     * Return an HTTP client instance
     *
     * @return GuzzleHttp\Client
     */
    protected function client()
    {
        return new Client([
            'base_url' => $this->baseUri,
            'defaults' => [
                'headers' => $this->getHeaders()
            ]
        ]);
    }

    /**
     * Return Header
     *
     * @return array
     */
    protected function getHeaders()
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $this->token"
        ];
    }
}
