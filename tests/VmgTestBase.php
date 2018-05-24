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
        // @todo - Make this a mock client
        $this->guzzleClient = new Client();
    }
}
