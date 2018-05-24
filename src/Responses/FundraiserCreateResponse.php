<?php

namespace VirginMoneyGivingAPI\Responses;


use Psr\Http\Message\ResponseInterface;
use VirginMoneyGivingAPI\Models\Fundraiser;

class FundraiserCreateResponse
{
    //\VirginMoneyGivingAPI\Models\ModelInterface?
    protected $fundraiser;

    /**
     * @var bool
     */
    protected $creationSuccessful;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var bool
     */
    protected $customerExists;

    /**
     * @var string
     */
    protected $message;

    public function __construct(ResponseInterface $response, Fundraiser $fundraiser)
    {
        $body = \GuzzleHttp\json_decode($response->getBody());

        $fundraiser->setResourceId($body->resourceId);
        $this->setFundraiser($fundraiser);
        $this->setCreationSuccessful($body->creationSuccessful);
        $this->setAccessToken($body->accessToken);
        $this->setCustomerExists($body->customerExists);
        $this->setMessage($body->message);
    }

    /**
     * @return \VirginMoneyGivingAPI\Models\Fundraiser
     */
    public function getFundraiser(): Fundraiser
    {
        return $this->fundraiser;
    }

    /**
     * @param \VirginMoneyGivingAPI\Models\Fundraiser $fundraiser
     *
     * @return FundraiserCreateResponse
     */
    public function setFundraiser(Fundraiser $fundraiser): FundraiserCreateResponse
    {
        $this->fundraiser = $fundraiser;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCreationSuccessful(): bool
    {
        return $this->creationSuccessful;
    }

    /**
     * @param bool $creationSuccessful
     *
     * @return FundraiserCreateResponse
     */
    public function setCreationSuccessful(bool $creationSuccessful): FundraiserCreateResponse
    {
        $this->creationSuccessful = $creationSuccessful;
        return $this;
    }



    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     *
     * @return FundraiserCreateResponse
     */
    public function setAccessToken($accessToken): FundraiserCreateResponse
    {
        $this->accessToken = ($accessToken) ? $accessToken : null;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCustomerExists(): bool
    {
        return $this->customerExists;
    }

    /**
     * @param bool $customerExists
     *
     * @return FundraiserCreateResponse
     */
    public function setCustomerExists(bool $customerExists): FundraiserCreateResponse
    {
        $this->customerExists = $customerExists;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return FundraiserCreateResponse
     */
    public function setMessage(string $message): FundraiserCreateResponse
    {
        $this->message = $message;
        return $this;
    }
}