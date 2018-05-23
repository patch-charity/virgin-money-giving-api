<?php

namespace Tests\Connectors;

use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Connectors\FundraiserVmgConnector;
use VirginMoneyGivingAPI\Exceptions\ConnectorException;
use VirginMoneyGivingAPI\Models\Fundraiser;

class FundraserVmgConnectorTest extends VmgTestBase {
    public function testSearchNotFound()
    {
        $fundraiserConnector = new FundraiserVmgConnector('878bbz7ubxzn55af48675rdz', $this->guzzleClient, true);

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

        // @todo - A sucessful search returns a search response with the fundraiser in.
    }

    //9ruwzujrdpmy44jzq7s2tkun - Charity key

    /**
     * These are from TCT
     *
     * Charity key: 9ruwzujrdpmy44jzq7s2tkun
    Fundraiser key: rsa2qqv6e9p8rkd7y4vtfjhy
    Charity ID: 5cacf47a-3cf7-11e3-80f9-00237d37086c
    Event ID: dabe761c-ae3d-4e66-80ed-3dbf46297bf0
     *
     */

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


        $fundraiserConnector = new FundraiserVmgConnector('9ruwzujrdpmy44jzq7s2tkun', $this->guzzleClient, true);

        // Do we need to try/catch this? Or just return the exception
        $response = $fundraiserConnector->create($fundraiser, 'www.google.co.uk');


        var_dump($response);


    }
}