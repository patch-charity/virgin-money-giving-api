<?php

namespace Tests\Connectors;

use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Connectors\FundraiserVmgConnector;
use VirginMoneyGivingAPI\Exceptions\ConnectorException;
use VirginMoneyGivingAPI\Models\Fundraiser;
use VirginMoneyGivingAPI\Responses\FundraiserCreateResponse;
use VirginMoneyGivingAPI\Responses\FundraiserSearchResponse;

class FundraserVmgConnectorTest extends VmgTestBase {
    public function testSearchNotFound()
    {
        $fundraiserConnector = new FundraiserVmgConnector('878bbz7ubxzn55af48675rdz', $this->getGuzzleClient(), true);

        // @todo - We need to mock the response once we have a proper one - See Omnipay

        $this->expectException(ConnectorException::class);
        $response = $fundraiserConnector->search('Test', 'User');

        try {
            $response = $fundraiserConnector->search('Test', 'User');
        } catch (ConnectorException $exception) {
            $this->assertNull($exception->getResponseCode());
            $this->assertSame('001.02.011', $exception->getErrorCode());
            $this->assertSame('No fundraiser found for  forename=User surname=Test', $exception->getErrorMessage());
            $this->assertEmpty($exception->getMessageDetails());
            $this->assertSame('Request params: \n  forename=User\n  surname=Test\n\n', $exception->getInputDetails());
        }
    }

    public function testSearchFound()
    {
        $fundraiserConnector = new FundraiserVmgConnector('878bbz7ubxzn55af48675rdz', $this->getGuzzleClient(), true);

        // @todo - We need to mock the response once we have a proper one - See Omnipay

        // @todo - When the sandbox gets reset this will fail. We defo need mocks
        $response = $fundraiserConnector->search('Russel', 'Bruce');
        $this->assertInstanceOf(FundraiserSearchResponse::class, $response);
        $this->assertTrue($response->hasMatches());

    }

    public function testFundraiserCreate()
    {
        $faker = \Faker\Factory::create('en_GB');

        $fundraiser = new Fundraiser();
        $fundraiser->setTitle('Mr');
        $fundraiser->setForename($faker->firstName);
        $fundraiser->setSurname($faker->lastName);
        $fundraiser->setAddressLine1($faker->streetName);
        $fundraiser->setAddressLine2($faker->streetAddress);
        $fundraiser->setTownCity($faker->city);
        $fundraiser->setCountyState($faker->county);
        $fundraiser->setPostcode($faker->postcode);
        $fundraiser->setCountryCode($faker->countryCode);
        $fundraiser->setPreferredTelephone('12345678912');
        $fundraiser->setEmailAddress($faker->safeEmail);
        $fundraiser->setPersonalUrl(uniqid(str_replace(' ', '-', trim($fundraiser->getSurname())), false));
        $fundraiser->setTermsAndConditionsAccepted('Y');
        $fundraiser->setDateOfBirth('20010101');

        $fundraiserConnector = new FundraiserVmgConnector('8gvrs9z4vud26psfgekqeuqt', $this->getGuzzleClient(), true);
        $response = $fundraiserConnector->create($fundraiser, 'https://www.dementiarevolution.org');

        $this->assertInstanceOf(FundraiserCreateResponse::class, $response);
        $this->assertNotEmpty($response->getFundraiser()->getResourceId());
        $this->assertTrue($response->isCreationSuccessful());
        $this->assertFalse($response->isCustomerExists());
        $this->assertNotEmpty($response->getAccessToken());
        $this->assertNotEmpty($response->getAccessToken());
        $this->assertSame('Token expires in 1500 seconds', $response->getMessage());
    }

    // @todo - Add test for attempting to re-create a user

    // @todo - This is for the failure.
    //$this->assertSame('OAuth access token not created. Error Code: <-2001>  Message: <Invalid redirect_uri> Description: <N/A>', $response->getMessage());
    //$this->assertEmpty($response->getAccessToken());
}