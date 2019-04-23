<?php

namespace IntellirentSDK\Models;

class Applicant extends AbstractModel
{
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

    /**
     * Applicant constructor
     * 
     * @param int $propertyId
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phoneNumber
     */
    public function __construct( 
        int $propertyId = null, 
        string $firstName = null, 
        string $lastName = null, 
        string $email = null,
        string $phoneNumber = null
    ) {
        $this->property_id  = $propertyId;
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->phone_number = $phoneNumber;    
    }
}