<?php

namespace VirginMoneyGivingAPI\Models;

/**
 * Class Page.
 *
 * The Fundraiser page as defined here: https://developer.virginmoneygiving.com/docs/read/Create_Fundraiser_page
 *
 * @package VirginMoneyGivingAPI\Models
 */
class Page extends AbstractModel
{
    /**
     * @var string
     */
    protected $pageTitle;

    /**
     * @var string
     */
    protected $eventResourceId;

    /**
     * @var string YYYYMMDD
     */
    protected $fundraisingDate;

    /**
     * @var string
     */
    protected $teamPageIndicator;

    /**
     * @var string
     */
    protected $teamName;

    /**
     * @var string
     */
    protected $teamUrl = '';

    /**
     * @var string
     */
    protected $activityCode = '';

    /**
     * @var string
     */
    protected $activityDescription = '';

    /**
     * @var bool
     */
    protected $charityContributionIndicator;

    /**
     * @var int
     */
    protected $postEventFundraisingInterval = 3;

    /**
     * @var float
     */
    protected $fundraisingTarget;

    /**
     * @var string
     */
    protected $charityResourceId;

    /**
     * @var array
     */
    protected $charitySplits;

    /**
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    /**
     * @param string $pageTitle
     *
     * @return Page
     */
    public function setPageTitle(string $pageTitle): Page
    {
        $this->pageTitle = $this->convertAccentedCharacters($pageTitle);
        return $this;
    }

    /**
     * @return string
     */
    public function getEventResourceId(): string
    {
        return $this->eventResourceId;
    }

    /**
     * @param string $eventResourceId
     *
     * @return Page
     */
    public function setEventResourceId(string $eventResourceId): Page
    {
        $this->eventResourceId = $eventResourceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getFundraisingDate(): string
    {
        return $this->fundraisingDate;
    }

    /**
     * @param $fundraisingDate
     *
     * @return \VirginMoneyGivingAPI\Models\Page
     * @throws \Exception
     */
    public function setFundraisingDate($fundraisingDate): Page
    {
        if (!empty($fundraisingDate) &&
            !preg_match("/^[0-9]{4}(0[1-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])$/", $fundraisingDate)) {
            throw new \Exception('Fundraising date must be in YYYYMMDD format.');
        }
        $this->fundraisingDate = $fundraisingDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getTeamPageIndicator(): string
    {
        return $this->teamPageIndicator;
    }

    /**
     * @param string $teamPageIndicator
     *
     * @return \VirginMoneyGivingAPI\Models\Page
     * @throws \Exception
     */
    public function setTeamPageIndicator(string $teamPageIndicator): Page
    {
        if ($teamPageIndicator != 'N' && $teamPageIndicator != 'Y') {
            throw new \Exception('Team page indicator must be Y/N.');
        }
        $this->teamPageIndicator = $teamPageIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getTeamName(): string
    {
        return $this->teamName;
    }

    /**
     * @param $teamName
     *
     * @return Page
     */
    public function setTeamName($teamName): Page
    {
        $this->teamName = ($teamName) ? $this->convertAccentedCharacters($teamName) : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getTeamUrl(): string
    {
        return $this->teamUrl;
    }

    /**
     * @param $teamUrl
     *
     * @return Page
     */
    public function setTeamUrl($teamUrl): Page
    {
        $this->teamUrl = ($teamUrl) ? $teamUrl : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivityCode(): string
    {
        return $this->activityCode;
    }

    /**
     * @param $activityCode
     *
     * @return Page
     */
    public function setActivityCode($activityCode): Page
    {
        $this->activityCode = ($activityCode) ? $activityCode : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivityDescription(): string
    {
        return $this->activityDescription;
    }

    /**
     * @param $activityDescription
     *
     * @return Page
     */
    public function setActivityDescription($activityDescription): Page
    {
        $this->activityDescription = ($activityDescription) ? $this->convertAccentedCharacters($activityDescription) : null;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharityContributionIndicator(): string
    {
        return $this->charityContributionIndicator;
    }

    /**
     * @param $charityContributionIndicator
     *
     * @return \VirginMoneyGivingAPI\Models\Page
     * @throws \Exception
     */
    public function setCharityContributionIndicator($charityContributionIndicator): Page
    {
        if ($charityContributionIndicator != 'N' && $charityContributionIndicator != 'Y') {
            throw new \Exception('Charity contribution indicator must be Y/N.');
        }
        $this->charityContributionIndicator = $charityContributionIndicator;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostEventFundraisingInterval(): int
    {
        return $this->postEventFundraisingInterval;
    }

    /**
     * @param int $postEventFundraisingInterval
     *
     * @return Page
     */
    public function setPostEventFundraisingInterval(int $postEventFundraisingInterval): Page
    {
        $this->postEventFundraisingInterval = $postEventFundraisingInterval;
        return $this;
    }

    /**
     * @return float
     */
    public function getFundraisingTarget(): float
    {
        return $this->fundraisingTarget;
    }

    /**
     * @param float $fundraisingTarget
     *
     * @return Page
     */
    public function setFundraisingTarget(float $fundraisingTarget): Page
    {
        $this->fundraisingTarget = $fundraisingTarget;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharityResourceId(): string
    {
        return $this->charityResourceId;
    }

    /**
     * @param string $charityResourceId
     *
     * @return Page
     */
    public function setCharityResourceId(string $charityResourceId): Page
    {
        $this->charityResourceId = $charityResourceId;
        return $this;
    }

    /**
     * @return array
     */
    public function getCharitySplits(): array
    {
        return $this->charitySplitPercent;
    }

    /**
     * @param array $charitySplits
     *
     * @return Page
     */
    public function setCharitySplits(array $charitySplits): Page
    {
        $this->charitySplits = $charitySplits;
        return $this;
    }
}