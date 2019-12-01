<?php

namespace Tests;

use GuzzleHttp\Client as GuzzleHttpClient;
use OhSeeSoftware\CaddyConfig\Client;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /** @var Client */
    private $client;

    public function setUp(): void
    {
        $mockBuilder = $this->getMockBuilder(GuzzleHttpClient::class);
        $this->mock = $mockBuilder->setMethods(['request'])->getMock();
        
        $this->client = new Client;

        $this->request = $this->client->request();
        $this->request->http = $this->mock;
    }

    /** @test */
    public function it_sets_http_uri()
    {
        $this->request->http();
        $this->assertEquals('/config/apps/http', $this->request->uri);
    }

    /** @test */
    public function it_sets_server_uri()
    {
        $this->request->server('example');
        $this->assertEquals('/config/servers/example', $this->request->uri);
    }

    /** @test */
    public function it_sets_route_uri()
    {
        $this->request->route(0);
        $this->assertEquals('/config/routes/0', $this->request->uri);
    }

    /** @test */
    public function it_sets_match_uri()
    {
        $this->request->match(0);
        $this->assertEquals('/config/match/0', $this->request->uri);
    }

    /** @test */
    public function it_sends_request_to_add_a_host()
    {
        // Given
        $this->mock->expects($this->once())
            ->method('request')
            ->with('POST', '/config/apps/http/servers/srv0/routes/0/match/0/host', [
                'json' => ['example.com']
            ]);
        
        // When
        $this->request->http()
            ->server('srv0')
            ->route(0)
            ->match(0)
            ->addHost('example.com');
    }
}
