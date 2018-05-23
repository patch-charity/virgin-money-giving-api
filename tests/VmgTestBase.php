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

    // @todo - Set Sandbox stuff for API keys that you know work

    public function setUp()
    {
        $this->guzzleClient = new Client();
    }
}
