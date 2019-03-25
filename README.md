intellirent-sdk-php
=========
Intellirent SDK is a library that enable an application to interact with the [Intellirent (IR) API](https://intellirent.docs.apiary.io/)

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
# For Sandbox
$apiClient = new IntellirentSDK\ApiClient('https://private-anon-396a0e7408-intellirent.apiary-mock.com');

# For production
$apiClient = new InterllirentSDK\ApiClient('https://syndication.irapp.co');
```
### List All Properties
Now that we've set up our client, we can use it to make requests to the API. Let's list all properties.
```php
$apiClient = new IntellirentSDK\ApiClient('https://private-anon-396a0e7408-intellirent.apiary-mock.com');

$propertyApi = new IntellirentSDK\Apis\PropertyApi($apiClient);

# set security_token and company_id/company-name as this is required for this API
$propertyApi->setSecurityToken('your-security-token')
            ->setCompanyId('your-company-name');

$properties = $propertyApi->list();
```
##### Sample Result
```php
IntellirentSDK\Models\ResultFactory Object
(
    [meta] =>
    [data] => Array
        (
            [0] => IntellirentSDK\Models\PropertyList Object
                (
                    [id] => 1019
                    [address] => 870 Massachusetts Avenue 3, Boston, MA, 02318
                )
            [1]
                (
                    [id] => 1097
                    [address] => 17 Main St, Floor 4 #11, Kansas City, MO, 648
                )
        )
)
```
### Create a new property
To create a new property, we can either provide an (associative) `array` with the expected values, or a `Property` object.
```php
$propertyResponse = $propertyApi->create([
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

$propertyResponse = $propertyApi->create($property);
```
##### Sample Result
```php
IntellirentSDK\Models\ResultFactory Object
(
    [meta] => IntellirentSDK\Models\ResultMetaFactory Object
        (
            [invite_link] => https://intellirent.irapp.co/?afp=4F912044
            [status] => published
        )
    [data] => IntellirentSDK\Models\Property Object
        (
            [property_id] => 1129
            [street_name_1] => 5th Avenue
            [street_name_2] =>
            [unit_number] =>
            [city] => Santa Clara
            [state] => NY
            [postal_code] => 12345
            [agent_email] => jdoe@myintellirent.com
            [rate] => 1
            [security_deposit] => 1
            [lease_terms] =>
            [bedrooms] => 1
            [utilities] =>
            [available_date] =>
            [description] =>
            [amenities] =>
            [pictures] =>
            [parking] =>
            [property_type] =>
        )
)
```
### Update Property
To update a property, we'll provide the `$property_id` and an `array` of `$data` with the property information to the method call
```php
$propertyResponse = $propertyApi->update(1234, [
    'unit_number' => 2,
    'parking' => 2
]);
```
##### Sample Result
```php
IntellirentSDK\Models\ResultFactory Object
(
    [meta] => IntellirentSDK\Models\ResultMetaFactory Object
        (
            [status] => updated
        )
    [data]
        (
            [property_id] => 1234
            [street_name_1] => 5th Avenue
            [street_name_2] =>
            [unit_number] => 2,
            [city] => Santa Clara
            [state] => NY
            [postal_code] => 12345
            [agent_email] => jdoe@myintellirent.com
            [rate] => 1
            [security_deposit] => 1
            [lease_terms] =>
            [bedrooms] => 1
            [bathrooms] => 1
            [utilities] =>
            [available_date] =>
            [description] =>
            [amenities] =>
            [pictures] =>
            [parking] => 2
            [property_type] =>
        )
)
```
### Archive Property
To archive a property, we'll provide the required `$propertyId` and `$agentEmail` as arguments
```php
$propertyApi->delete(1234, 'jdoe@myintellirent.com');
```
##### Sample Result
```php
Archived Successfully
```
### Create a new Applicant
To create a new applicant, we can either provide an (associative) `array` with the expected values, or an `Applicant` object.
```php
$applicantResponse = $applicantApi->create([
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
$applicant = new IntellirentSDK\Models\Applicant(
    0,
    1234
    'John',
    'Doe',
    'jdoe@myintellirent.com',
    '(123) 456-7890'
);

$applicantResponse = $applicantApi->create($applicant);
```
##### Sample Result
```php
IntellirentSDK\Models\ResultFactory
(
    [meta] => IntellirentSDK\Models\ResultMetaFactory Object
        (
            [session_url] = https://syndication.irapp.co/api/v2/applicants/qwertyuiopasdfghjklzxcvbnm1234567890  
        )
    [data] => IntellirentSDK\Models\Applicant Object
        (
            [user_id] => 10212
            [property_id] => 1234
            [first_name] => John
            [last_name] => Doe
            [email] => jdoe@myintellirent.com
            [phone_number] => (123) 456-7890
        )
)
```
### Update existing Applicant
To update existing applicant, we'll provide the `$userId` and and an `array` of `$data` with the applicant information to the method call
```php
$applicantResponse = $applicantApi->update(1234, [
    'first_name' => 'Jane'
]);
```
##### Sample Result
```php
IntellirentSDK\Models\ResultFactory
(
    [meta] => IntellirentSDK\Models\ResultMetaFactory Object
        (
            [session_url] = https://syndication.irapp.co/api/v2/applicants/qwertyuiopasdfghjklzxcvbnm1234567890
        )
    [data]
        (
            [user_id] => 1234
            [property_id] => 1234
            [first_name] => John
            [last_name] => Doe
            [email] => jdoe@myintellirent.com
            [phone_number] => (123) 456-7890
        )
)
```
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

$applicantCount = $applicantReportApi->applicantCounts($applicantReport);
```
##### Sample Result
```php
IntellirentSDK\Models\ResultFactory Object
(
    [meta] =>
    [data] => IntellirentSDK\Models\ApplicantCount Object
        (
            [matched_record_count] => 1
            [agent_details] => Array
                (
                    [0] => IntellirentSDK\Models\Agent Object
                        (
                            [id] => 387
                            [email] => admin@myintellirent.com
                        )
                )
        )
)
```
## Changelog
_TODO_

## License
_TODO_


