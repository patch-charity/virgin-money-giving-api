<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class VmgTestBase extends TestCase
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

    /**
     * @var string
     */
    public $mockFilePath = 'tests/Mocks/';

    public function setUp()
    {
        $this->setGuzzleClient(new Client());
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient(): \GuzzleHttp\Client
    {
        return $this->guzzleClient;
    }

    /**
     * @param \GuzzleHttp\Client $guzzleClient
     */
    public function setGuzzleClient(\GuzzleHttp\Client $guzzleClient): void
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * Given a mocked response, set the Guzzle client to use it.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     *
     * @return $this
     */
    public function setMockClient(Response $response)
    {
        $mock = new MockHandler([$response]);

        $handler = HandlerStack::create($mock);

        $this->setGuzzleClient(new Client(['handler' => $handler]));

        return $this;
    }
}
