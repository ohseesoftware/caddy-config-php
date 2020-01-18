<?php

namespace OhSeeSoftware\CaddyConfig;

class Client
{
    /** @var string */
    public $caddyHost;

    /** @var array */
    public $headers;

    public function __construct(string $caddyHost = 'localhost:2019', array $headers = [])
    {
        $this->setCaddyHost($caddyHost);
        $this->setHeaders($headers);
    }

    /**
     * Sets the Caddy host (base url).
     *
     * @param string $caddyHost
     * @return Client
     */
    public function setCaddyHost(string $caddyHost)
    {
        $this->caddyHost = $caddyHost;
        return $this;
    }

    /**
     * Sets the headers.
     *
     * @param string $headers
     * @return Client
     */
    public function setHeaders(array $headers = [])
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Creates a new Request instance.
     *
     * @return Request
     */
    public function request(): Request
    {
        return new Request($this->caddyHost, $this->headers);
    }
}
