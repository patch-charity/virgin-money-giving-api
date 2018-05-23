<?php

namespace Tests\Models;

use Tests\VmgTestBase;
use VirginMoneyGivingAPI\Models\Fundraiser;

class FundraiserTest extends VmgTestBase {
    public function testEmail()
    {
        $fundraiser = new Fundraiser();
        $this->expectException(\Exception::class);
        $fundraiser->setEmailAddress('NOT_AN_EMAIL_FORMAT');

        $fundraiser->setEmailAddress('test@example.com');
        $this->assertSame('test@example.com', $fundraiser->getEmailAddress());
    }

    public function testPostcode()
    {
        $fundraiser = new Fundraiser();
        $this->expectException(\Exception::class);
        $fundraiser->setPostcode('123456789');

        $fundraiser->setPostcode('12345678');
        $this->assertSame('123456789', $fundraiser->getPostcode());
    }

    public function tesTelephoneNumber()
    {
        $fundraiser = new Fundraiser();
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The phone number must only contain numbers.');
        $fundraiser->setPreferredTelephone('THIS IS A STRING');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The phone number must only contain numbers.');
        $fundraiser->setPreferredTelephone('The phone number must be 16 characters or less.');

        $fundraiser->setPreferredTelephone('12345678');
        $this->assertSame('123456789', $fundraiser->getPreferredTelephone());
    }

    public function testTermsAndConditionsAccepted()
    {
        $fundraiser = new Fundraiser();
        $this->expectException(\Exception::class);
        $fundraiser->setTermsAndConditionsAccepted('THIS IS A STRING');

        $fundraiser->setTermsAndConditionsAccepted('Y');
        $this->assertSame('Y', $fundraiser->getTermsAndConditionsAccepted());
    }

    public function testDateOfBorth()
    {
        $fundraiser = new Fundraiser();
        $this->expectException(\Exception::class);
        $fundraiser->setDateOfBirth('THIS IS A STRING');

        $fundraiser->setDateOfBirth('20010101');
        $this->assertSame('20010101', $fundraiser->getDateOfBirth());
    }
}