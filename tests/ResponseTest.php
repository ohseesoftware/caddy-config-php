<?php

namespace Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use OhSeeSoftware\CaddyConfig\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /** @test */
    public function it_returns_true_if_the_response_is_successful()
    {
        $response = new Response(new GuzzleResponse(200, []));
        $this->assertTrue($response->isSuccessful());

        $response = new Response(new GuzzleResponse(201, []));
        $this->assertTrue($response->isSuccessful());
    }

    /** @test */
    public function it_returns_false_if_the_response_is_successful()
    {
        $response = new Response(new GuzzleResponse(401, []));
        $this->assertFalse($response->isSuccessful());

        $response = new Response(new GuzzleResponse(403, []));
        $this->assertFalse($response->isSuccessful());

        $response = new Response(new GuzzleResponse(500, []));
        $this->assertFalse($response->isSuccessful());
    }

    /** @test */
    public function it_returns_the_response_body()
    {
        $response = new Response(new GuzzleResponse(200, [], 'example body'));
        $this->assertEquals('example body', $response->getBody());

        $body = ['abc' => 123];
        $response = new Response(new GuzzleResponse(201, [], json_encode($body)));
        $this->assertEquals(json_encode($body), $response->getBody());
    }
}
