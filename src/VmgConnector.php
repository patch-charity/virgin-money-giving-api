<?php

namespace VirginMoneyGivingAPI;

use GuzzleHttp\Client;
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
    protected $apiKey;

    /**
     * @var \GuzzleHttp\ClientInterface The Guzzle client
     */
    protected $guzzleClient;

    /**
     * @var bool
     */
    private $testMode;

    public function __construct($apiKey, ClientInterface $client, $testMode = false)
    {
        $this->setApiKey($apiKey);
        $this->setGuzzleClient($client);
        $this->setTestMode($testMode);
    }

    /**
     * Setter for the API key.
     *
     * @param string $apiKey
     *
     * @return $this
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function getApiKey() : string
    {
        return $this->apiKey;
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
    public function getTestMode() : bool
    {
        return $this->testMode;
    }

    /**
     * Setter for the Guzzle client.
     *
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @return $this
     */
    public function setGuzzleClient(ClientInterface $client)
    {
        $this->guzzleClient = $client;

        return $this;
    }

    public function getGuzzleClient() : ClientInterface
    {
        return $this->guzzleClient;
    }

    /**
     * Returns the endpoint based on if we are in test mode or not.
     *
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}