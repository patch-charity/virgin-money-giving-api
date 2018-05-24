<?php

namespace VirginMoneyGivingAPI\Connectors;

use VirginMoneyGivingAPI\AbstractVmgConnector;
use function Rap2hpoutre\ConvertAccentCharacters\convert_accent_characters;
use VirginMoneyGivingAPI\Models\Fundraiser;
use VirginMoneyGivingAPI\Responses\FundraiserCreateResponse;

class FundraiserVmgConnector extends AbstractVmgConnector
{
    /**
     * Given a first name and surname this function will search VMG for a matching
     * fundraiser.
     *
     * @param $surname
     * @param $forename
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \VirginMoneyGivingAPI\Exceptions\ConnectorException
     */
    public function search($surname, $forename)
    {
        $method = 'GET';
        $path = '/fundraisers/v1/search.json?surname=' .
            convert_accent_characters($surname) .
            '&forename=' . convert_accent_characters($forename);

        // We don't try and catch the exceptions here
        $response = $this->request($path, $method);

        // @todo - A decent response object.
        return $response;
    }

    public function create(Fundraiser $fundraiser, string $callbackUrl)
    {
        $method = 'POST';
        $path = '/fundraisers/v1/newaccount?redirect_uri=' . $callbackUrl;

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],

            // @todo - See if you can use this: https://github.com/Ocramius/GeneratedHydrator instead of mapping below

            'body' => \GuzzleHttp\json_encode([
                'title' => $fundraiser->getTitle(),
                'forename' => $fundraiser->getForename(),
                'surname' => $fundraiser->getSurname(),
                'addressLine1' => $fundraiser->getAddressLine1(),
                'addressLine2' => $fundraiser->getAddressLine2(),
                'townCity' => $fundraiser->getTownCity(),
                'countyState' => $fundraiser->getCountyState(),
                'postcode' => $fundraiser->getPostcode(),
                'countryCode' => $fundraiser->getCountryCode(),
                'preferredTelephone' => $fundraiser->getPreferredTelephone(),
                'emailAddress' => $fundraiser->getEmailAddress(),
                'personalUrl' => $fundraiser->getPersonalUrl(),
                'termsAndConditionsAccepted' => $fundraiser->getTermsAndConditionsAccepted(),
                'charityMarketingIndicator' => 'N',
                'allCharityMarketingIndicator' => 'N',
                'virginMarketingIndicator' => 'N',
                'dateOfBirth' => $fundraiser->getDateOfBirth(),
                'vmgMarketingIndicator' => 'N',
            ])
        ];

        // Don't try and catch any errors, let them bubble up.
        $response = $this->request($path, $method, $options);

        return new FundraiserCreateResponse($response, $fundraiser);
    }


}