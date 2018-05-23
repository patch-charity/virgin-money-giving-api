<?php

namespace VirginMoneyGivingAPI\Models;


interface ModelInterface
{
    public function setResourceId(string $resourceID);

    public function getResourceId(string $resourceID);

    public function convertAccentedCharacters(string $string);
}