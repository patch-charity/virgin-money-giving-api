<?php

namespace Tests;

use Tests\ConcreteConnector as VmgConnector;

class VmgConnectorTest extends VmgTestBase
{
    public function testEndpointUrl()
    {
        $connector = new VmgConnector('API_KEY', $this->guzzleClient, $testMode = false);

        // Check we are looking at the live endpoint.
        $this->assertSame('https://api.virginmoneygiving.com', $connector->getEndpoint());

        // And now the sandbox when in test mode.
        $connector->setTestMode(true);
        $this->assertSame('https://sandbox.api.virginmoneygiving.com', $connector->getEndpoint());
    }
}
