intellirent-sdk-php
=========
Intellirent SDK is a library written in PHP that enable an application to interact with the [Intellirent (IR) API](https://intellirent.docs.apiary.io/)

## Version
_TODO_

## Installation
_TODO_

## Quickstart
Before attempting to use this SDK, you should secure API credentials as follow:

#### Property Synidcation
This API requires a `security_token` and a `company-name`, which a partner will get by contacting IR support.

#### Single Sign On Integgration
This API uses a `security_token`, which a partner will get by contacting IR admin.

#### Applicant Report
This API uses a `security_key`, which will be shared with any entity who wishes to use our API.

## Get Started

##### Creating a Client
```php
# Other Credential as required by IR API
# This is required in the PropertyApi
IntellirentSDK\Configuration::setCompanyId('your-company-id');

# This is needed for all APIs request
IntellirentSDK\Configuration::setSecurityToken('your-security-token');

# For Mock Server
IntellirentSDK\Configuration::setBaseUrl('https://private-anon-396a0e7408-intellirent.apiary-mock.com');
$apiClient = new IntellirentSDK\ApiClient();

# For production
IntellirentSDK\Configuration::setBaseUrl('https://syndication.irapp.co');
$apiClient = new InterllirentSDK\ApiClient();
```
### List All Properties
Now that we've set up our client, we can use it to make requests to the API. Let's list all properties.
```php
$propertyApi = new IntellirentSDK\Apis\PropertyApi($apiClient);
$properties = $propertyApi->listAllProperties();
```
`$properties` will contain an array of `Intellirent\Models\PropertyList` object
### Create a new property
To create a new property, we can either provide an (associative) `array` with the expected values, or a `Property` object.
```php
$propertyResponse = $propertyApi->createProperty([
    'agent_email' => 'jdoe@myintellirent.com',
    'street_name_1' => '5th avenue',
    'street_name_2' => 'governer house',
    'unit_number' => 1,
    'city' => 'Santa Clara',
    'state' => 'NY',
    'utilities' => 'All utilities included',
    'postal_code' => '23456',
    'rate' => 1500,
    'security_deposit' => 1500,
    'bedrooms' => 2,
    'bathrooms' => 2,
    'parking' => 1,
    'property_type' => 'HOUSE',
    'available_date' => '2/2/2017',
    'lease_duration' => '6 months lease',
    'description' => 'very beautiful',
    'amenities' => ["Hardwood floors","Elevator in building","Garden","On-site gym"],
    'pictures' => ["https://up-production.s3.amazonaws.com/uploads/grid_view_c8313a34-1402-4350-82cc-d0d103927c0e.jpg"]
]);
```
#### or
```php
# constructor arguments
# $propertyId - not required on create, can be 0 or NULL
# $streetName1 - street address
# $city - city address
# $state - state address
# $rate 
# $securityDeposit
# $bedrooms - no of bedrooms
# $bathrooms - no of bathrooms
# $agentEmail - angent email for this property
$property = new IntellirentSDK\Models\Property(
    0,
    '5th avenue',
    'Santa Clara',
    'NY',
    '23456',
    1500,
    1500,
    2,
    2,
    'jdoe@myintellirent.com'
);

# you may add extra attributes
$property->street_name_2 = 'governet house';
$poperty->unit_number = 1;
$property->parking = 1;
$property->property_type = 'HOUSE';
$property->available_date = '2/2/2017';
$property->lease_terms = '6 months';
$property->amenities = ["Hardwood floors","Elevator in building","Garden","On-site gym"];
$property->pictures = ["https://up-production.s3.amazonaws.com/uploads/grid_view_c8313a34-1402-4350-82cc-d0d103927c0e.jpg"];

$propertyResponse = $propertyApi->createProperty($property);
```
`$propertyResponse` will contain an instance of `IntellirentSDK\Models\NewPropertyResponse` with  `id` of the newly created property, `invite_link` url, and `status`
### Update Property
To update a property, we'll provide the `$property_id` and an `array` of `$data` with the property information to the method call
```php
$propertyApi->updateProperty(1234, [
    'unit_number' => 2,
    'parking' => 2
]);
```
On successful update will output the response status
### Archive Property
To archive a property, we'll provide the required `$propertyId` and `$agentEmail` as arguments
```php
$propertyApi->archiveProperty(1234, 'jdoe@myintellirent.com');
```
On successful archive will output the request status
### Create a new Applicant
To create a new applicant, we can either provide an (associative) `array` with the expected values, or an `Applicant` object.
```php
$applicant = $applicantApi->create([
    'property_id' => 1234,
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'jdoe@myintellirent.com',
    'phone_number' => '(123) 456-7890'
]);
```
#### or
```php
# constructor arguments
# $userId - not required on create, can be 0 or null
# $propertyId 
# $firstName
# $lastName
# $email
# $phoneNumber
$applicantData = new IntellirentSDK\Models\Applicant(
    0,
    1234
    'John',
    'Doe',
    'jdoe@myintellirent.com',
    '(123) 456-7890'
);

$applicant = $applicantApi->createApplicant($applicantData);
```
`$applicant` will contain an instance of `IntellirentSDK\Models\ApplicantResponse` with `id` of the newly created applicant and the `session_url`
### Update existing Applicant
To update existing applicant, we'll provide the `$userId` and and an `array` of `$data` with the applicant information to the method call
```php
$applicant = $applicantApi->update(1234, [
    'first_name' => 'Jane'
]);
```
`$applicant` will contain an instance of `IntellirentSDK\Models\ApplicantResponse` with `id` of the applicant and `session_url`
## Applicant Report
### Applicant Count
In order to request for Applicant Count Report, we'll be passing object of type `ApplicantReport`
```php
$applicantReport = new IntellirentSDK\Models\ApplicantReport(
    '2018-01-01', 
    '2018-12-31',
    [
        "superagent@intellirent.com",
        "email.usmanasif@gmail.com",
        "admin@myintellirent.com"
    ] 
);

$applicantCount = $applicantReportApi->getApplicantCounts($applicantReport);
```
`$applicantCount` will contain an instance of `IntellirentSDK\Models\ApplicantCount` with `matched_record_count` and `agent_details` properties
## Changelog
_TODO_

## License
_TODO_


