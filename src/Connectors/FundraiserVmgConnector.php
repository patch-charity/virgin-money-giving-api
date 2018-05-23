<?php

namespace VirginMoneyGivingAPI\Connectors;

use VirginMoneyGivingAPI\VmgConnector;
use function Rap2hpoutre\ConvertAccentCharacters\convert_accent_characters;

class FundraiserVmgConnector extends VmgConnector
{

    public function search($surname, $forename)
    {
        $method = 'GET';
        $path = '/fundraisers/v1/search.json?surname=' .
            convert_accent_characters($surname) .
            '&forename=' . convert_accent_characters($forename);

        // We don't try and catch the exceptions here
        $response = $this->request($path, $method);

        return $response;
    }
}