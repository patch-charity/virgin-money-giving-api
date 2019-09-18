<?php

namespace VirginMoneyGivingAPI\Models;

/**
 * Class Fundraiser.
 *
 * The Fundraiser account as deinfied here: https://developer.virginmoneygiving.com/docs/read/Create_Fundraiser_Account
 *
 * @package VirginMoneyGivingAPI\Models
 */
class Fundraiser extends AbstractModel
{
    const UK_POSTCODE_REGEX = '';
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $forename;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $addressLine1;

    /**
     * @var string
     */
    protected $addressLine2;

    /**
     * @var string
     */
    protected $townCity;

    /**
     * @var string
     */
    protected $countyState;

    /**
     * @var string
     */
    protected $postcode;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $preferredTelephone;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var string
     */
    protected $personalUrl;

    /**
     * @var string
     */
    protected $termsAndConditionsAccepted;

    /**
     * @var string YYYYMMDD.
     */
    protected $dateOfBirth;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return \VirginMoneyGivingAPI\Models\Fundraiser
     * @throws \Exception
     */
    public function setTitle(string $title): Fundraiser
    {
        $allowed_values = [
            'Mr', 'Mrs', 'Ms', 'Miss', 'Dr', 'Prof',
        ];
        if (!in_array($title, $allowed_values)) {
            throw new \Exception('The title must be one of Mr, Mrs, Ms, Miss, Dr, Prof.');
        }
        $this->title = $this->convertAccentedCharacters($title);
        return $this;
    }

    /**
     * @return string
     */
    public function getForename(): string
    {
        return $this->forename;
    }

    /**
     * @param string $forename
     *
     * @return Fundraiser
     */
    public function setForename(string $forename): Fundraiser
    {
        $this->forename = $this->convertAccentedCharacters($forename);
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     *
     * @return Fundraiser
     */
    public function setSurname(string $surname): Fundraiser
    {
        $this->surname = $this->convertAccentedCharacters($surname);
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->addressLine1;
    }

    /**
     * @param string $addressLine1
     *
     * @return Fundraiser
     */
    public function setAddressLine1(string $addressLine1): Fundraiser
    {
        $this->addressLine1 = $this->convertAccentedCharacters($addressLine1);
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->addressLine2;
    }

    /**
     * @param string $addressLine2
     *
     * @return Fundraiser
     */
    public function setAddressLine2(string $addressLine2): Fundraiser
    {
        $this->addressLine2 = $this->convertAccentedCharacters($addressLine2);
        return $this;
    }

    /**
     * @return string
     */
    public function getTownCity(): string
    {
        return $this->townCity;
    }

    /**
     * @param string $townCity
     *
     * @return Fundraiser
     */
    public function setTownCity(string $townCity): Fundraiser
    {
        $this->townCity = $this->convertAccentedCharacters($townCity);
        return $this;
    }

    /**
     * @return string
     */
    public function getCountyState(): string
    {
        return $this->countyState;
    }

    /**
     * @param string $countyState
     *
     * @return Fundraiser
     */
    public function setCountyState(string $countyState): Fundraiser
    {
        $this->countyState = $this->convertAccentedCharacters($countyState);
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     *
     * @return \VirginMoneyGivingAPI\Models\Fundraiser
     * @throws \Exception
     */
    public function setPostcode(string $postcode): Fundraiser
    {
        // Guard against invalid postcodes.
        if (!preg_match('/([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))\s?[0-9][A-Za-z]{2})/', $postcode)) {
            throw new \Exception('The postcode does not match the required UK Government postcode standard.');
        }

        $this->postcode = $this->convertAccentedCharacters($postcode);

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     *
     * @return Fundraiser
     */
    public function setCountryCode(string $countryCode): Fundraiser
    {
        $this->countryCode = $this->convertAccentedCharacters($countryCode);
        return $this;
    }

    /**
     * @return string
     */
    public function getPreferredTelephone(): string
    {
        return $this->preferredTelephone;
    }

    /**
     * @param string $preferredTelephone
     *
     * @return \VirginMoneyGivingAPI\Models\Fundraiser
     * @throws \Exception
     */
    public function setPreferredTelephone(string $preferredTelephone): Fundraiser
    {
        if (!preg_match('/^\d+$/', $preferredTelephone)) {
            throw new \Exception('The phone number must only contain numbers.');
        }
        if (strlen($preferredTelephone) > 16) {
            throw new \Exception('The phone number must be 16 characters or less.');
        }
        $this->preferredTelephone = $this->convertAccentedCharacters($preferredTelephone);
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     *
     * @return \VirginMoneyGivingAPI\Models\Fundraiser
     * @throws \Exception
     */
    public function setEmailAddress(string $emailAddress): Fundraiser
    {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('The email address must be in a valid format according to FILTER_VALIDATE_EMAIL.');
        }
        $this->emailAddress = $this->convertAccentedCharacters($emailAddress);
        return $this;
    }

    /**
     * @return string
     */
    public function getPersonalUrl(): string
    {
        return $this->personalUrl;
    }

    /**
     * @param string $personalUrl
     *
     * @return Fundraiser
     */
    public function setPersonalUrl(string $personalUrl): Fundraiser
    {
        $this->personalUrl = $this->convertAccentedCharacters($personalUrl);
        return $this;
    }

    /**
     * @return string
     */
    public function getTermsAndConditionsAccepted(): string
    {
        return $this->termsAndConditionsAccepted;
    }

    /**
     * @param string $termsAndConditionsAccepted
     *
     * @return \VirginMoneyGivingAPI\Models\Fundraiser
     * @throws \Exception
     */
    public function setTermsAndConditionsAccepted(string $termsAndConditionsAccepted): Fundraiser
    {
        if ($termsAndConditionsAccepted != 'N' && $termsAndConditionsAccepted != 'Y') {
            throw new \Exception('Terms and conditions must be Y/N.');
        }
        $this->termsAndConditionsAccepted = $termsAndConditionsAccepted;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $dateOfBirth in YYYYMMDD format
     *
     * @return \VirginMoneyGivingAPI\Models\Fundraiser
     * @throws \Exception
     */
    public function setDateOfBirth(string $dateOfBirth): Fundraiser
    {
        if (!preg_match("/^[0-9]{4}(0[1-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateOfBirth)) {
            throw new \Exception('Date of birth must be in YYYYMMDD format.');
        }
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param $accessToken
     *
     * @return Fundraiser
     */
    public function setAccessToken($accessToken): Fundraiser
    {
        $this->accessToken = ($accessToken) ? $accessToken : null;
        return $this;
    }
}