<?php

namespace VirginMoneyGivingAPI;

use GuzzleHttp\ClientInterface;

abstract class VmgConnector
{
    /**
     * Sandbox Endpoint URL
     *
     * The VMG API has a sandbox environment in which to test. Contact your
     * account manager to get test credentials or use the ones in @todo.
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://sandbox.api.virginmoneygiving.com';

    /**
     * @var string URL
     */
    protected $liveEndpoint = 'https://api.virginmoneygiving.com';

    /**
     * @var string The VMG API key
     */
    private $apiKey;

    /**
     * @var \GuzzleHttp\ClientInterface The Guzzle client
     */
    private $guzzleClient;

    /**
     * @var bool
     */
    private $testMode;

    public function __construct($apiKey, ClientInterface $client, $testMode = false)
    {
        $this->apiKey = $apiKey;
        $this->guzzleClient = $client;
        $this->testMode = $testMode;
    }

    /**
     * Sets the test mode.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setTestMode($value)
    {
        $this->testMode = $value;

        return $this;
    }

    /**
     * Gets the test mode.
     *
     * @return boolean
     */
    public function getTestMode()
    {
        return $this->testMode;
    }

    /**
     * Returns the endpoint based on if we are in test mode or not.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    // @todo - request and response tings

    // @todo - error logging goes here
}