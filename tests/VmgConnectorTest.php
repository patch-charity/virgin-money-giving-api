<?php

namespace Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Tests\ConcreteConnector as VmgConnector;

class VmgConnectorTest extends TestCase
{
    public function testEndpointUrl()
    {
        // @todo - Hand this off to a base test class.
        $guzzleClient = new Client();
        $connector = new VmgConnector('API_KEY', $guzzleClient, $testMode = false);

        // Check we are looking at the live endpoint.
        $this->assertSame('https://api.virginmoneygiving.com', $connector->getEndpoint());

        // And now the sandbox when in test mode.
        $connector->setTestMode(true);
        $this->assertSame('https://sandbox.api.virginmoneygiving.com', $connector->getEndpoint());
    }
}
