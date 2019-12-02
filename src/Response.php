<?php

namespace OhSeeSoftware\CaddyConfig;

use Psr\Http\Message\ResponseInterface;

class Response
{
    /** @var ResponseInterface */
    public $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Returns the response body as a string.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->response->getBody()->getContents();
    }

    /**
     * Returns a boolean indicating if the request was successful.
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return in_array($this->response->getStatusCode(), [200, 201]);
    }
}
