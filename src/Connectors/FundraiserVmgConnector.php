<?php

namespace VirginMoneyGivingAPI\Connectors;

use VirginMoneyGivingAPI\AbstractVmgConnector;
use function Rap2hpoutre\ConvertAccentCharacters\convert_accent_characters;
use VirginMoneyGivingAPI\Models\Fundraiser;
use VirginMoneyGivingAPI\Models\Page;
use VirginMoneyGivingAPI\Responses\FundraiserCreateResponse;
use VirginMoneyGivingAPI\Responses\FundraiserSearchResponse;

class FundraiserVmgConnector extends AbstractVmgConnector
{

    /**
     * Given a first name and surname this function will search VMG for a matching
     * fundraisers.
     *
     * https://developer.virginmoneygiving.com/docs/read/Fundraiser_Search
     *
     * @param $surname
     * @param $forename
     *
     * @return \VirginMoneyGivingAPI\Responses\FundraiserSearchResponse
     * @throws \VirginMoneyGivingAPI\Exceptions\ConnectorException
     */
    public function search($surname, $forename)
    {
        $method = 'GET';
        $path = '/fundraisers/v1/search.json?surname=' .
            convert_accent_characters($surname) .
            '&forename=' . convert_accent_characters($forename) . '&';

        // We don't try and catch the exceptions here
        $response = $this->request($path, $method);

        return new FundraiserSearchResponse($response);
    }

    /**
     * Create a fundraiser account.
     *
     * https://developer.virginmoneygiving.com/docs/read/Create_Fundraiser_Account
     *
     * @param \VirginMoneyGivingAPI\Models\Fundraiser $fundraiser
     * @param string $callbackUrl
     *
     * @return \VirginMoneyGivingAPI\Responses\FundraiserCreateResponse
     * @throws \VirginMoneyGivingAPI\Exceptions\ConnectorException
     */
    public function createFundraiserAccount(Fundraiser $fundraiser, string $callbackUrl)
    {
        $method = 'POST';
        $path = '/fundraisers/v1/newaccount?redirect_uri=' . $callbackUrl . '&';

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

        // Don't try and catch any errors, let them bubble up.
        $response = $this->request($path, $method, $options);

        return new FundraiserCreateResponse($response, $fundraiser);
    }

    //https://developer.virginmoneygiving.com/docs/read/Create_Fundraiser_page
    public function createFundraiserPage(Page $fundriaserPage, Fundraiser $fundraiser, string $charityResourceId)
    {
        // @todo - Response

        // @todo -

        ///fundraisers/v1/account/secure/{fundraiserResourceId}/newpage?api_key={your API key}

        $method = 'POST';
        $path = '/fundraisers/v1/account/secure/' . $fundraiser->getResourceId() . '/newpage?';

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $fundraiser->getAccessToken(),
            ],
            'body' => \GuzzleHttp\json_encode([

            ])
        ];

        // @todo - Populate the data

        /*$data = [
            'pageTitle' => $submissionData['forename'] . ' ' . $submissionData['surname'] . ' London Marathon 2018',
            'eventResourceId' => $this->event_id,
            'fundraisingDate' => '',
            'teamPageIndicator' => 'N',
            'teamName' => '',
            'teamUrl' => '',
            'activityCode' => '',
            'activityDescription' => '',
            'charityContributionIndicator' => 'N',
            'postEventFundraisingInterval' => '3',
            'fundraisingTarget' => $fundraising_target,
            'charitySplits' => [[
                'charityResourceId' => $this->charity_id,
                'charitySplitPercent' => 100]]
        ];

        $options = [
            'method' => 'POST',
            'data' => drupal_json_encode($data),
            'timeout' => 15,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken
            ],
        ];

        return drupal_http_request(
            $this->api_url . '/fundraisers/v1/account/secure/' . $resourceId . '/newpage?api_key=' . $this->charity_api_key,
            $options
        );*/
    }


}