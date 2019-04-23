<?php

namespace IntellirentSDK\Models;

class Property extends AbstractModel
{
    /**
     * Street address of this property (including number, street name, street suffix (e.g Drive, Blvd, etc.), apartment/unit number, etc)
     * 
     * Data Type: string
     * @var $street_name_1
     */
    public $street_name_1;

    /**
     * Street address of this property
     * 
     * Data Type: string
     * @var @street_name_2
     */
    public $street_name_2;

    /**
     * Unit number of the property
     * 
     * Data Type: string
     * @var $unit_number
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
     * Data Type: float
     * @var $rate
     */
    public $rate;

    /**
     * Specified deposit required for this property
     * 
     * Data Type: float
     * @var $security_deposit
     */
    public $security_deposit;

    /**
     * Specified lease duration for this property
     * 
     * Data Type: string
     * @var $lease_terms
     */
    public $lease_terms;

    /**
     * No. of bedrooms of this property
     * 
     * Data Type: float
     * @var $bedrooms
     */
    public $bedrooms;

    /**
     * No. of bathrooms of this property
     * 
     * Data Type: float
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
     * @var $available_date
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
     * @var $property_type
     */
    public $property_type;

    /**
     * Property constructor
     * 
     * @param string $streetName1
     * @param string $city
     * @param string $state
     * @param string $postalCode
     * @param string $rate
     * @param float $rate
     * @param float $securityDeposit
     * @param float $bedrooms
     * @param float $bathrooms
     * @param string $agentEmail
     */
    public function __construct(
        string $streetName1 = null, 
        string $city = null, 
        string $state = null, 
        string $postalCode = null,
        float $rate = null, 
        float $securityDeposit = null,
        float $bedrooms = null,
        float $bathrooms = null,
        string $agentEmail = null
    ) {
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