<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

require_once __DIR__ . '/../vendor/autoload.php';

class ApiTest extends TestCase
{
    public function testRealHttpRequest()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8080'
        ]);

        $response = $client->get('/index.php');

        $this->assertEquals(200, $response->getStatusCode());
    }

    // Тест с Mock HTTP
    public function testMockHttpRequest()
    {
        $mock = new MockHandler([
            new Response(200, [], '<html>OK</html>')
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $response = $client->get('/test');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('OK', (string)$response->getBody());
    }
}
