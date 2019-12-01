<?php

namespace OhSeeSoftware\CaddyConfig;

class Client
{
    /** @var string */
    public $caddyHost;

    public function __construct(string $caddyHost = 'localhost:2019')
    {
        $this->setCaddyHost($caddyHost);
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
     * Creates a new Request instance.
     *
     * @return Request
     */
    public function request(): Request
    {
        return new Request($this->caddyHost);
    }
}
