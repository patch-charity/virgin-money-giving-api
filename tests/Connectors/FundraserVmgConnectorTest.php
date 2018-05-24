<?php

namespace Tests\Connectors;

use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Connectors\FundraiserVmgConnector;
use VirginMoneyGivingAPI\Exceptions\ConnectorException;
use VirginMoneyGivingAPI\Models\Fundraiser;
use VirginMoneyGivingAPI\Models\Page;
use VirginMoneyGivingAPI\Responses\FundraiserCreateResponse;
use VirginMoneyGivingAPI\Responses\FundraiserSearchResponse;
use VirginMoneyGivingAPI\Responses\PageCreateResponse;

class FundraserVmgConnectorTest extends VmgTestBase {

    /**
     * @throws \VirginMoneyGivingAPI\Exceptions\ConnectorException
     */
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

    /**
     * @throws \VirginMoneyGivingAPI\Exceptions\ConnectorException
     */
    public function testSearchFound()
    {
        $fundraiserConnector = new FundraiserVmgConnector('878bbz7ubxzn55af48675rdz', $this->getGuzzleClient(), true);

        // @todo - We need to mock the response once we have a proper one - See Omnipay

        // @todo - When the sandbox gets reset this will fail. We defo need mocks
        $response = $fundraiserConnector->search('Russel', 'Bruce');
        $this->assertInstanceOf(FundraiserSearchResponse::class, $response);
        $this->assertTrue($response->hasMatches());
    }

    /**
     * @throws \Exception
     * @throws \VirginMoneyGivingAPI\Exceptions\ConnectorException
     */
    public function testFundraiserCreate()
    {
        $faker = \Faker\Factory::create('en_GB');

        $fundraiser = new Fundraiser();
        $fundraiser->setTitle('Mr')
            ->setForename($faker->firstName)
            ->setSurname($faker->lastName)
            ->setAddressLine1($faker->streetName)
            ->setAddressLine2($faker->streetAddress)
            ->setTownCity($faker->city)
            ->setCountyState($faker->county)
            ->setPostcode($faker->postcode)
            ->setCountryCode($faker->countryCode)
            ->setPreferredTelephone('12345678912')
            ->setEmailAddress($faker->safeEmail)
            ->setPersonalUrl(uniqid(str_replace(' ', '-', trim($fundraiser->getSurname())), false))
            ->setTermsAndConditionsAccepted('Y')
            ->setDateOfBirth('20010101');

        $fundraiserConnector = new FundraiserVmgConnector('8gvrs9z4vud26psfgekqeuqt', $this->getGuzzleClient(), true);
        $response = $fundraiserConnector->createFundraiserAccount($fundraiser, 'https://www.dementiarevolution.org');

        $this->assertInstanceOf(FundraiserCreateResponse::class, $response);
        $this->assertNotEmpty($response->getModel()->getResourceId());
        $this->assertTrue($response->isCreationSuccessful());
        $this->assertFalse($response->isCustomerExists());
        $this->assertNotEmpty($response->getAccessToken());
        $this->assertSame('Token expires in 1500 seconds', $response->getMessage());
    }

    /**
     * @throws \Exception
     * @throws \VirginMoneyGivingAPI\Exceptions\ConnectorException
     */
    public function testPageCreate()
    {
        $faker = \Faker\Factory::create('en_GB');

        $fundraiser = new Fundraiser();
        $fundraiser->setTitle('Mr')
            ->setForename($faker->firstName)
            ->setSurname($faker->lastName)
            ->setAddressLine1($faker->streetName)
            ->setAddressLine2($faker->streetAddress)
            ->setTownCity($faker->city)
            ->setCountyState($faker->county)
            ->setPostcode($faker->postcode)
            ->setCountryCode($faker->countryCode)
            ->setPreferredTelephone('12345678912')
            ->setEmailAddress($faker->safeEmail)
            ->setPersonalUrl(uniqid(str_replace(' ', '-', trim($fundraiser->getSurname())), false))
            ->setTermsAndConditionsAccepted('Y')
            ->setDateOfBirth('20010101');

        $fundraiserConnector = new FundraiserVmgConnector('8gvrs9z4vud26psfgekqeuqt', $this->getGuzzleClient(), true);
        $response = $fundraiserConnector->createFundraiserAccount($fundraiser, 'https://www.dementiarevolution.org');

        $this->assertInstanceOf(FundraiserCreateResponse::class, $response);
        $this->assertNotEmpty($response->getModel()->getResourceId());
        $this->assertNotEmpty($response->getAccessToken());

        $page = new Page();
        $page->setPageTitle($fundraiser->getForename() . ' ' . $fundraiser->getSurname() . ' London 2019 Marathon.')
            ->setEventResourceId('8b74655f-bbb8-4cba-8733-1181e79527f7')
            ->setFundraisingTarget(2000.00)
            ->setCharityResourceId('8da32779-1c1b-4d20-8714-df3219836618')
            ->setCharitySplits([
                [
                    'charityResourceId' => '6a5880c9-13e4-4cf4-987e-931f3899b9d5',
                    'charitySplitPercent' => 50
                ],
                [
                    'charityResourceId' => '8da32779-1c1b-4d20-8714-df3219836618',
                    'charitySplitPercent' => 50
                ]
            ]);

        // Now create the page
        $response = $fundraiserConnector->createFundraiserPage($page, $fundraiser, $response->getAccessToken());

        $this->assertInstanceOf(PageCreateResponse::class, $response);
        $this->assertTrue($response->isCreationSuccessful());
        $this->assertNotEmpty($response->getPageURI());
        $this->assertSame('Page created successfully', $response->getMessage());
    }

    // @todo - Add test for attempting to re-create a user

    // @todo - This is for the failure.
    //$this->assertSame('OAuth access token not created. Error Code: <-2001>  Message: <Invalid redirect_uri> Description: <N/A>', $response->getMessage());
    //$this->assertEmpty($response->getAccessToken());
}