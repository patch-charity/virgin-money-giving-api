<?php

namespace Tests\Models;

use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Models\Fundraiser;
use VirginMoneyGivingAPI\Models\Page;

/**
 * Class PageTest
 *
 * @package Tests\Models
 */
class PageTest extends VmgTestBase
{

    /**
     * Tests:
     *  - Fundraising date can be set in Ymd format - Done
     *  - Team page indicator can be set - Done
     *  - Charity contribution indicatro can be set - Done
     *  - Team name can be set - Done
     *  - Activity description can be set - Done
     *  - Charity resource ID can be set - Done
     *  - Post event fundraising interval can be set - Done
     *  - Page title cannot be set to more than 45 characters - @todo
     */
    /**
     * @test
     */
    public function testFundraisingDate()
    {
        $page = new Page();
        $this->expectException(\Exception::class);
        $page->setFundraisingDate('THIS IS A STRING');

        $page->setFundraisingDate('20010101');
        $this->assertSame('20010101', $page->getFundraisingDate());
    }

    /**
     * @test
     */
    public function testTeamPageIndicator()
    {
        $page = new Page();
        $this->expectException(\Exception::class);
        $page->setTeamPageIndicator('THIS IS A STRING');

        $page->setTeamPageIndicator('Y');
        $this->assertSame('Y', $page->getTeamPageIndicator());
    }

    /**
     * @test
     */
    public function testCharityContributionIndicator()
    {
        $page = new Page();
        $this->expectException(\Exception::class);
        $page->setCharityContributionIndicator('THIS IS A STRING');

        $page->setCharityContributionIndicator('Y');
        $this->assertSame('Y', $page->getCharityContributionIndicator());
    }

    /**
     * @test
     */
    public function testSetTeamName()
    {
        $page = new Page();
        $teamName = 'Normal team name';
        $page->setTeamName($teamName);
        $this->assertSame($page->getTeamName(), $teamName);

        // Now test with accented characters
        $page->setTeamName('Normal team namé');
        $this->assertSame($page->getTeamName(), 'Normal team name');
    }

    /**
     * @test
     */
    public function testSetActivityDescription()
    {
        $page = new Page();
        $teamName = 'Activity Description here';
        $page->setActivityDescription($teamName);
        $this->assertSame($page->getActivityDescription(), $teamName);

        // Now test with accented characters
        $page->setActivityDescription('Activity Description heré');
        $this->assertSame($page->getActivityDescription(), 'Activity Description here');
    }

    /**
     * @test
     */
    public function testSetCharityResourceId()
    {
        $page = new Page();
        $resourceId = 'resource-id-here';
        $page->setCharityResourceId($resourceId);
        $this->assertSame($page->getCharityResourceId(), $resourceId);
    }

    /**
     * @test
     */
    public function testSetPostEventFundraisingInterval()
    {
        $page = new Page();
        $interval = 2;
        $page->setPostEventFundraisingInterval($interval);
        $this->assertSame($page->getPostEventFundraisingInterval(), $interval);
    }

    /**
     * @test
     */
    public function testPagetitleCannotBeLongerThan45Characters()
    {
        $page = new Page();
        $this->expectException(\Exception::class);
        $page->setPageTitle('Lorem ipsum dolor sit amet, consectetur adipis');

        $page->setPageTitle('This is the page title');
        $this->assertSame('This is the page title', $page->getPageTitle());
    }
}