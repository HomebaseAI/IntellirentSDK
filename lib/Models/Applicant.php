<?php

namespace IntellirentSDK\Models;

class Applicant extends AbstractModel
{
    /**
     * Applicant/User ID that exists on Intellirent. This is optional parameter in create request.
     * While it is required on existing user single-sign-on request/ update request for email/property
     * 
     * @var $userId
     */
    public $user_id;

    /**
     * Property ID that exists on Intellirent and syndicated by the requesting partner.
     * The property should be published on Intellirent. It'll be associated to the applicant being specified.
     * 
     * @var $propertyId
     */
    public $property_id;

    /**
     * First Name of the Applicant
     * 
     * @var $firstName
     */
    public $first_name;

    /**
     * Last Name of the Applicant
     * 
     * @var $lastName
     */
    public $last_name;

    /**
     * Email of the Applicant
     * 
     * @var $email
     */
    public $email;

    /**
     * Phone number of the Applicant
     * 
     * @var $phoneNumber
     */
    public $phone_number;

    public function __construct(
        int $user_id         = null, 
        int $property_id     = null, 
        string $first_name   = null, 
        string $last_name    = null, 
        string $email        = null,
        string $phone_number = null
    ) {
        $this->user_id      = $user_id;
        $this->property_id  = $property_id;
        $this->first_name   = $first_name;
        $this->last_name    = $last_name;
        $this->email        = $email;
        $this->phone_number = $phone_number;    
    }
}