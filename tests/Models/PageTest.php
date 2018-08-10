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
        $this->assertInstanceOf(Page::class, $page);

        $page->setFundraisingDate('20010101');
        $this->assertSame('20010101', $page->getFundraisingDate());
        $this->assertInstanceOf(Page::class, $page);
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
}