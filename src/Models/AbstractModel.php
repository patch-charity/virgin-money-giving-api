<?php

namespace VirginMoneyGivingAPI\Models;

use function Rap2hpoutre\ConvertAccentCharacters\convert_accent_characters;

abstract class AbstractModel implements ModelInterface
{
    /**
     * @var string
     */
    protected $resourceID;

    public function setResourceId(string $resourceID): AbstractModel
    {
        $this->resourceID = $resourceID;
        return $this;
    }

    public function getResourceId()
    {
        return $this->resourceID;
    }

    public function convertAccentedCharacters(string $string)
    {
        return convert_accent_characters($string);
    }
}