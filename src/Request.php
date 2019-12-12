<?php

namespace OhSeeSoftware\CaddyConfig;

use GuzzleHttp\Client;

class Request
{
    /** @var Client */
    public $http;

    /** @var string */
    public $uri = '/config';

    public function __construct(string $caddyHost)
    {
        $this->http = new Client([
            'base_uri' => $caddyHost
        ]);
    }

    /**
     * Sends a GET request.
     *
     * @return void
     */
    public function get(): Response
    {
        return $this->sendRequest('GET');
    }

    /**
     * Adds a new host.
     *
     * @param string $host
     * @return Response
     */
    public function addHost(string $host): Response
    {
        $this->uri .= '/host';
        return $this->sendRequest('POST', $host);
    }

    /**
     * Adds the http route to the uri.
     *
     * @return Request
     */
    public function http()
    {
        $this->uri .= '/apps/http';
        return $this;
    }

    /**
     * Sets the server for the request.
     *
     * @param string $server
     * @return Request
     */
    public function server(string $server)
    {
        $this->uri .= "/servers/{$server}";
        return $this;
    }

    /**
     * Sets the route index for the request.
     *
     * @param int $routeIndex
     * @return Request
     */
    public function route(int $routeIndex)
    {
        $this->uri .= "/routes/{$routeIndex}";
        return $this;
    }

    /**
     * Sets the match index for the request.
     *
     * @param int $match
     * @return Request
     */
    public function match(int $matchIndex)
    {
        $this->uri .= "/match/{$matchIndex}";
        return $this;
    }

    /**
     * Sends the configured request.
     *
     * @param string $method
     * @param mixed $body
     * @return Response
     */
    public function sendRequest(string $method, $body = null): Response
    {
        $options = [
            'http_errors' => false
        ];

        if ($body) {
            $options['json'] = $body;
        }

        $response = $this->http->request($method, $this->uri, $options);
        
        return new Response($response);
    }
}
