<?php

namespace Tests\Connectors;

use Tests\Connectors\ConcreteConnector as VmgConnector;
use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Exceptions\ConnectorException;

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

    public function testRequestMethod()
    {
        $connector = new VmgConnector('API_KEY', $this->guzzleClient, $testMode = true);

        $this->expectExceptionMessage('Only POST and GET requests are supported.');
        $this->expectException(ConnectorException::class);
        $response = $connector->request('http://example.com', 'NOT VALID');
    }

    // @todo - Tests for 404 and 403 repsonses.
    // @todo - Test that it blows up when accented characters are passed
}
