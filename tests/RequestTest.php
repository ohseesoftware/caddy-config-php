<?php

namespace Tests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use OhSeeSoftware\CaddyConfig\Request;
use OhSeeSoftware\CaddyConfig\Response;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function setUp(): void
    {
        $mockBuilder = $this->getMockBuilder(GuzzleHttpClient::class);
        $this->mock = $mockBuilder->setMethods(['request'])->getMock();

        $this->request = new Request('localhost:2019');
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
    public function it_sets_base_uri_when_creating_http_client()
    {
        // Given
        $this->request = new Request('example.com:443');

        // When
        $config = $this->request->http->getConfig('base_uri');

        // Then
        $this->assertEquals('example.com', $config->getHost());
        $this->assertEquals(443, $config->getPort());
    }

    /** @test */
    public function it_sends_request_to_add_a_host()
    {
        // Given
        $this->mock->expects($this->once())
            ->method('request')
            ->with('POST', '/config/apps/http/servers/srv0/routes/0/match/0/host', [
                'json' => ['example.com']
            ])
            ->willReturn(new GuzzleHttpResponse(200));
        
        // When
        $response = $this->request->http()
            ->server('srv0')
            ->route(0)
            ->match(0)
            ->addHost('example.com');

        // Then
        $this->assertInstanceOf(Response::class, $response);
    }

    /** @test */
    public function it_returns_a_response_instance()
    {
        // Given
        $this->mock->expects($this->once())
            ->method('request')
            ->with('POST', '/config', [])
            ->willReturn(new GuzzleHttpResponse(200));
        
        // When
        $this->request->uri = '/config';
        $response = $this->request->sendRequest('POST', []);

        // Then
        $this->assertInstanceOf(Response::class, $response);
    }
}
