<?php

namespace IntellirentSDK\Models;

class ReferralContact extends AbstractModel
{
    /**
     * Message id of the referral
     * 
     * @var $message_id
     */
    public $message_id;

    /**
     * First name of referrer
     * 
     * @var $referrer_first_name
     */
    public $referrer_first_name;

    /**
     * Last name of referrer
     * 
     * @var $referrer_last_name
     */
    public $referrer_last_name;

    /**
     * Email of referrer
     * 
     * @var $referrer_email
     */
    public $referrer_email;

    /**
     * Email of recipient
     * 
     * @var $recipient_email
     */
    public $recipient_email;

    /**
     * A shared referral link between the referrer and recipient
     * 
     * @var $referral_shared_link
     */
    public $referral_shared_link;

    /**
     * Referral message sent to recipient by the referrer
     * 
     * @var $referral_message
     */
    public $referral_message;

    /**
     * Data and Time at which the referral was made
     */
    public $referral_time;

    /**
     * ReferralContact constructor
     * 
     * @param int $message_id
     * @param string $referrerFirstName
     * @param string $referrerLastName
     * @param string $referrerEmail
     * @param string $recipientEmail
     * @param string $referralSharedLink
     * @param string $referralMssage
     * @param string $referralTime
     */
    public function __construct(
        int $messageId = null,
        string $referrerFirstName = null,
        string $referrerLastName = null,
        string $referrerEmail = null,
        string $recipientEmail = null,
        string $referralSharedLink = null,
        string $referralMessage = null,
        string $referralTime = null
    ) {
        $this->message_id = $messageId;
        $this->referrer_first_name = $referrerFirstName;
        $this->referrer_last_name = $referrerLastName;
        $this->referrer_email = $referrerEmail;
        $this->recipient_email = $recipientEmail;
        $this->referral_shared_link = $referralSharedLink;
        $this->referral_message = $referralMessage;
        $this->referral_time = $referralTime;
    }
}