<?php

namespace OhSeeSoftware\CaddyConfig;

class Client
{
    /** @var string */
    public $caddyHost;

    /** @var array */
    public $headers;

    /** @var array */
    public $certs;

    /** @var array */
    public $curlOptions;

    public function __construct(string $caddyHost = 'localhost:2019', array $headers = [])
    {
        $this->setCaddyHost($caddyHost);
        $this->setHeaders($headers);
        $this->setCerts($certs);
        $this->setCurlOptions($curlOptions);
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
     * Sets the headers.
     *
     * @param string $headers
     * @return Client
     */
    public function setCerts(array $certs = [])
    {
        $this->certs = $certs;
        return $this;
    }

    /**
     * Sets the headers.
     *
     * @param string $headers
     * @return Client
     */
    public function setCurlOptions(array $curlOptions = [])
    {
        $this->curlOptions = $curlOptions;
        return $this;
    }

    /**
     * Creates a new Request instance.
     *
     * @return Request
     */
    public function request(): Request
    {
        return new Request($this->caddyHost, $this->headers, $this->certs, $this->curlOptions);
    }
}
