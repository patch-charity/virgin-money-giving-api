<?php

namespace Tests\Connectors;

use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Connectors\FundraiserVmgConnector;
use VirginMoneyGivingAPI\Exceptions\ConnectorException;

class FundraserVmgConnectorTest extends VmgTestBase {
    public function testSearchNotFound()
    {
        $connector = new FundraiserVmgConnector('878bbz7ubxzn55af48675rdz', $this->guzzleClient, true);

        // @todo - We need to mock the response once we have a proper one - See Omnipay

        $this->expectException(ConnectorException::class);
        $response = $connector->search('Test', 'User');

        try {
            $response = $connector->search('Test', 'User');
        } catch (ConnectorException $exception) {
            $this->assertNull($exception->getResponseCode());
            $this->assertSame('001.02.011', $exception->getErrorCode());
            $this->assertSame('No fundraiser found for  forename=User surname=Test', $exception->getErrorMessage());
            $this->assertEmpty($exception->getMessageDetails());
            $this->assertSame('Request params: \n  forename=User\n  surname=Test\n\n', $exception->getInputDetails());
        }
    }
}