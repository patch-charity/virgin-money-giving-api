[![Build Status](https://travis-ci.org/reason-digital/virgin-money-giving-api.svg?branch=master)](https://travis-ci.org/reason-digital/virgin-money-giving-api)

# README #

Provides a PHP library for interacting with the Virgin Money Giving API.

This library will help with pushing and pulling data from the API. Unfortunately the API has quite a few undocumented quirks that this library hopes to stop developers falling into.

## Prerequisites 

### API Keys
To interact with the VGM API you will need to get API keys. To do this you'll need to register on the site (https://developer.virginmoneygiving.com/member/register).

You will need to create an application here on the Apps overview page: /apps/myapps.

Then on your keys overview page you can grab your API key: /apps/mykeys.

For some reason you will need different API keys for different API calls. The list can be found here:

https://developer.virginmoneygiving.com/our_apis

### Test data
When testing against the Sandbox there are a few bits of test data already setup:

#### Charities

| Name        | Resource ID           | 
| ------------- |:-------------:| 
| Charity2     | 6a5880c9-13e4-4cf4-987e-931f3899b9d5 | 
| Cancer Charity | 8da32779-1c1b-4d20-8714-df3219836618 |

#### Fundraisers
@todo - If there are any

#### Events
@todo - Grab some default ones


## Installation

Install the latest version with:

```bash
$ composer require reason-digital/virgin-money-giving-api
```

## Usage
### Fundraiser search
To use the fundraiser search you'll need to use your fundraiser developer API key. Any other key will return a 403 response.

```php
<?php
// Initialise the connector
$fundraiserConnector = new FundraiserVmgConnector('API_KEY', $guzzleClient, $testMode = false);

try {
    $response = $fundraiserConnector->search('Test', 'User');
} catch (ConnectorException $exception) {
    // VMG error message No fundraiser found for  forename=User surname=Test
    $exception->getErrorMessage();
    // VMG erorr code 001.02.011
    $exception->getErrorCode();
}
```

`$response` is then an instance of the Responses/FundraiserSearchResponse.php class. This has a `hasMatches(): bool` method.

### Fundraiser account create
To create fundraiser accounts you'll need to use your fundraiser developer API key. Any other key will return a 403 response.

There are a few gotchas with this API call. First is that the `callback url` you pass to `createFundraiserAccount` needs to match what you have setup in your VMG account or you wont get an access code back with the response. Instead you'll get the following response:

`OAuth access token not created. Error Code: <-2001>  Message: <Invalid redirect_uri> Description: <N/A>`

If the `callback url` matches then you'll get the following response:

`Token expires in 1500 seconds`

This access code is valid for 1500 seconds and allows to to create a fundraising page on the fundraisers behalf.

There are some fields that have validation. They can be found here: Models/FundraiserTest.php

```php
<?php
// Initialise the connector
$fundraiserConnector = new FundraiserVmgConnector('API_KEY', $guzzleClient, $testMode = false);

try {
    
    $fundraiser = new Fundraiser();
    $fundraiser->setTitle('Mr')
        ->setForename('firstName')
        ->setSurname('lastName')
        ->setAddressLine1('streetName')
        ->setAddressLine2('streetAddress')
        ->setTownCity('city')
        ->setCountyState('county')
        ->setPostcode('postcode')
        ->setCountryCode('countryCode')
        ->setPreferredTelephone('12345678912')
        ->setEmailAddress('Email')
        ->setPersonalUrl('url')
        ->setTermsAndConditionsAccepted('Y')
        ->setDateOfBirth('20010101');
    
    $response = $fundraiserConnector->createFundraiserAccount($fundraiser, 'CALLBACK_URL');
} catch (ConnectorException $exception) {
    $exception->getErrorMessage();
    $exception->getErrorCode();
}
```

`$response` is then an instance of the Responses/FundraiserCreateResponse.php class.

This has the `Fundraiser` and also the access code returned.

### Fundraiser page create
@todo

## Running tests
Travis CI is setup to run tests on PRs and master. To run tests locally you will need to pull down the repo with the dev dependencies by running:

`composer self-update`
`composer install --prefer-source --no-interaction --dev`

Once installed running `phpunit` will run tests.

## Roadmap
- Usage examples for Fundraiser and Page
- @todos round the place
- Get Sensio static analysis hooked up
- More tests
