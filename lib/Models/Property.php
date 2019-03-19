<?php

namespace IntellirentSDK\Models;

class Property extends AbstractModel
{
    /**
     * Property Id which IR returns in response to create property
     * 
     * Data Type: int
     * @var $id
     */
    public $property_id;

    /**
     * Street address of this property (including number, street name, street suffix (e.g Drive, Blvd, etc.), apartment/unit number, etc)
     * 
     * Data Type: string
     * @var $streetName1
     */
    public $street_name_1;

    /**
     * Unit number of the property
     * 
     * Data Type: int
     * @var $unitNumber
     */
    public $unit_number;

    /**
     * City in which this property is located
     * 
     * Data Type: string
     * @var $city
     */
    public $city;

    /**
     * State in which this property is located. Includes District of Columbia and Perto Rico
     * 
     * Data Type: string
     * Accepted value: 
     * "AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DC", "DE", "FL", "GA",
     * "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", "MD", "ME", "MI",
     * "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY",
     * "OH", "OK", "OR", "PA", "PR", "RI", "SC", "SD", "TN", "TX", "UT", "VA",
     * "VT", "WA", "WI", "WV", "WY"
     * @var $state
     */
    public $state;

    /**
     * 5-digit zip code in which this property is located
     * 
     * Data Type: string
     * @var $postalCode
     */
    public $postal_code;

    /**
     * Email of agent who manages property and has account in IR
     * 
     * Data Type: string
     * @var $agentEmail
     */
    public $agent_email;

    /**
     * Specified rent for to be offered for this property. This value will be used in the Income-to-Rent comparison when evailuating
     * the applicants in this application
     * 
     * Data Type: double
     * @var $rate
     */
    public $rate;

    /**
     * Specified deposit required for this property
     * 
     * Data Type: double
     * @var $securityDeposit
     */
    public $security_deposit;

    /**
     * Specified lease duration for this property
     * 
     * Data Type: string
     * @var $leaseTerms
     */
    public $lease_terms;

    /**
     * No. of bedrooms of this property
     * 
     * Data Type: double
     * @var $bedrooms
     */
    public $bedrooms;

    /**
     * No. of bathrooms of this property
     * 
     * Data Type: double
     * @var $bathrooms
     */
    public $bathrooms;

    /**
     * Utilities those are included in this property
     * 
     * Data Type: string
     * @var $utilities
     */
    public $utilities;

    /**
     * Date on which property will be available
     * 
     * Data Type: string|YYYY-MM-DD
     * @var $availableDate
     */
    public $available_date;

    /**
     * Description of property
     * 
     * Data Type: string
     * @var $description
     */
    public $description;

    /**
     * All amenities that this property have
     * 
     * Data Type: array[string]
     * @var $amentites
     */
    public $amenities;

    /**
     * Pictures of properties
     * 
     * Data Type: array[string]
     * @var $pictures
     */
    public $pictures;

    /**
     * No. of cars can be parked in property
     * 
     * Data Type: int
     * @var $parking
     */
    public $parking;

    /**
     * Type of property
     * 
     * Data Type: string
     * Accepted values
     * "CONDO", "HOUSE", "TOWNHOUSE"
     * @var $propertyType
     */
    public $property_type;

    public function __construct(
        $propertyId,
        string $streetName1, 
        string $city, 
        string $state, 
        string $postalCode,
        float $rate, 
        float $securityDeposit,
        float $bedrooms,
        float $bathrooms,
        string $agentEmail
    ) {
        $this->property_id = $propertyId;
        $this->street_name_1 = $streetName1;       
        $this->city = $city;
        $this->state = $state;
        $this->postal_code = $postalCode;
        $this->rate = $rate;
        $this->security_deposit = $securityDeposit;
        $this->bedrooms = $bedrooms;
        $this->bathrooms = $bathrooms;
        $this->agent_email   = $agentEmail;
    }
}