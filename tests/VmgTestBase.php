<?php

namespace Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class VmgTestBase extends TestCase
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

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
}
