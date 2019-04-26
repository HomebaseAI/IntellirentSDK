<?php

namespace IntellirentSDK\Tests;

use PHPUnit\Framework\TestCase;
use IntellirentSDK\Apis\ReferralContactApi;
use IntellirentSDK\Models\ReferralContact;
use IntellirentSDK\Models\ReferralContactResponse;

class ReferralContactApiTest extends TestCase
{
    private $referralContactApi;

    public function setUp()
    {
        $this->referralContactApi = $this->createMock(ReferralContactApi::class);
    }

    public function tearDown()
    {
        $this->referralContactApi = null;
    }

    /** @test */
    public function can_create_referral_contacts()
    {
        $referralContact = new ReferralContact();

        $referralContact->message_id = 1001;
        $referralContact->referrer_first_name = 'Joe';
        $referralContact->referrer_last_name = 'Doe';
        $referralContact->referrer_email = 'joedoe@intellirent.com';
        $referralContact->recipient_email = 'carljenko@intellirent.com';
        $referralContact->referral_shared_link = 'https//:referral_contact.com';
        $referralContact->referral_message = 'Joe Doe is inviting';
        $referralContact->referral_time = '2019-03-10 22:00';

        $referralContacts = [$referralContact];

        $expected = new ReferralContactResponse(
            'IR200',
            'Recipient Contacts Created',
            $referralContacts
        );

        $this->referralContactApi->expects($this->once())
             ->method('createReferralContacts')
             ->with($referralContacts)
             ->will($this->returnValue($expected));

        $response = $this->referralContactApi->createReferralContacts($referralContacts);

        $this->assertEquals($expected, $response);
    }
}