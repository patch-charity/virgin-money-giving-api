<?php

namespace VirginMoneyGivingAPI\Connectors;

use VirginMoneyGivingAPI\AbstractVmgConnector;
use function Rap2hpoutre\ConvertAccentCharacters\convert_accent_characters;
use VirginMoneyGivingAPI\Models\Fundraiser;

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

        $response = $this->request($path, $method, $options);

        var_dump('Getting here');

        var_dump($response);


        // @todo - If we get a good response then we should populate the resource ID on the fundraiser
        // and return it as part of the response object

        // @todo - What about the token? That should be in the response

        return $response;

        // @todo - Create a dummy fundraiser - See Laravels mocking thing for how this can be populated
    }


}