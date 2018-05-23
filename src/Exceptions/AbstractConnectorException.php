<?php

namespace VirginMoneyGivingAPI\Exceptions;

abstract class AbstractConnectorException extends \Exception implements ExceptionInterface
{
    protected $responseCode;

    protected $errorCode;

    protected $errorMessage;

    protected $messageDetails;

    protected $inputDetails;

    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null, $vmgErrors = null)
    {
        parent::__construct($message, $code, $previous);

        if ($vmgErrors) {
            $this->setResponseCode($vmgErrors->responseCode);
            $this->setErrorCode($vmgErrors->errorCode);
            $this->setErrorMessage($vmgErrors->errorMessage);
            $this->setMessageDetails($vmgErrors->messageDetails);
            $this->setInputDetails($vmgErrors->inputDetails);
        }
    }

    public function setResponseCode($responseCode)
    {
        $this->responseCode = ($responseCode) ? $responseCode : null;
    }

    public function getResponseCode()
    {
        return $this->responseCode;
    }

    public function setErrorCode(string $errorCode)
    {
        $this->errorCode = $errorCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function setErrorMessage(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setMessageDetails(array $messageDetails)
    {
        $this->messageDetails = $messageDetails;
    }

    public function getMessageDetails()
    {
        return $this->messageDetails;
    }

    public function setInputDetails(string $inputDetails)
    {
        $this->inputDetails = $inputDetails;
    }

    public function getInputDetails()
    {
        return $this->inputDetails;
    }
}