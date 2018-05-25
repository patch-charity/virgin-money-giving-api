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
// Initalise the connector
$fundraiserConnector = new FundraiserVmgConnector('API_KEY', $guzzleClient, $testMode = false);

try {
    $response = $fundraiserConnector->search('Test', 'User');
} catch (ConnectorException $exception) {
    // VMG error message No fundraiser found for  forename=User surname=Test
    $exception->getErrorMessage();
    // VMG erorr code 001.02.011
    $exception->getErrorCode();
}

// Response is then an instance of the Responses/FundraiserSearchResponse.php class.

```

@todo - Highligt as many gotchas as you can. 403s for any wrong bit
@todo - Callback URL must match (access denied otherwise)

## Running tests
- `composer install-dev` - @todo - Try this from a fresh install to see if this will install everything right.
- `phpunit` 

## Roadmap
- Use a hydrator for mapping the fundraiser and page details to the API call?
- Get hooked up to TravisCI
- Get Sensio static analyis hooked up
- More tests
