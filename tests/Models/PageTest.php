<?php

namespace Tests\Models;

use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Models\Fundraiser;
use VirginMoneyGivingAPI\Models\Page;

class PageTest extends VmgTestBase {

    public function testFundraisingDate()
    {
        $page = new Page();
        $this->expectException(\Exception::class);
        $page->setFundraisingDate('THIS IS A STRING');

        $page->setFundraisingDate('20010101');
        $this->assertSame('20010101', $page->getFundraisingDate());
    }

    public function testTeamPageIndicator()
    {
        $page = new Page();
        $this->expectException(\Exception::class);
        $page->setTeamPageIndicator('THIS IS A STRING');

        $page->setTeamPageIndicator('Y');
        $this->assertSame('Y', $page->getTeamPageIndicator());
    }

    public function testCharityContributionIndicator()
    {
        $page = new Page();
        $this->expectException(\Exception::class);
        $page->setCharityContributionIndicator('THIS IS A STRING');

        $page->setCharityContributionIndicator('Y');
        $this->assertSame('Y', $page->getCharityContributionIndicator());
    }

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

    public function testSetCharityResourceId()
    {
        $page = new Page();
        $resourceId = 'resource-id-here';
        $page->setCharityResourceId($resourceId);
        $this->assertSame($page->getCharityResourceId(), $resourceId);
    }

    public function testSetPostEventFundraisingInterval()
    {
        $page = new Page();
        $interval = 2;
        $page->setPostEventFundraisingInterval($interval);
        $this->assertSame($page->getPostEventFundraisingInterval(), $interval);
    }
}