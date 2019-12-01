<?php

namespace Tests;

use OhSeeSoftware\CaddyConfig\Client;
use OhSeeSoftware\CaddyConfig\Request;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function it_can_be_initialized_with_default_caddy_host()
    {
        $client = new Client();
        $this->assertEquals('localhost:2019', $client->caddyHost);
    }

    /** @test */
    public function it_can_be_initialized_with_custom_caddy_host()
    {
        $client = new Client('1.2.3.4:2019');
        $this->assertEquals('1.2.3.4:2019', $client->caddyHost);
    }

    /** @test */
    public function it_creates_new_request_instance()
    {
        $client = new Client();
        $this->assertInstanceOf(Request::class, $client->request());
    }
}
