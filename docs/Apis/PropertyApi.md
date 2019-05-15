# \IntellirentSDK\Apis\PropertyApi

All URIs are relative to *{base_url}/api/v2* 

Method | HTTP request | Description
------- | ------------- | ---------
[**listAllProperties**](#listAllProperties) | **GET** /:company_id/properties |
[**createProperty**](#createProperty) | **POST** /:company_id/properties |
[**updateProperty**](#updateProperty) | **PUT** /:company_id/properties/:property_id |
[**archiveProperty**](#archiveProperty) | **DELETE** /:company_id/properties/:property_id |

# **listAllProperties**
> \IntellirentSDK\Models\Collections\PropertyCollection

### Usage
```php
use IntellirentSDK\Apis\PropertyApi;

$propertyApi = new PropertyApi();
$properties = $propertyApi->listAllProperties();
```
### Parameters
*None*

### Return type
[**\IntellirentSDK\Models\Collections\PropertyCollection**](../Models/Collections\PropertyCollection.md)

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createProperty**
> \Intellirent\Models\NewPropertyResponse

### Usage
To create a new property, we can either provide an (associative) `array` with the expected values, or a `Property` object.
```php
use IntellirentSDK\Apis\PropertyApi;

$propertyApi = new PropertyApi();

# Using associative array
$newPropertyResponse = $propertyApi->createProperty([
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
use IntellirentSDK\Apis\PropertyApi;
use IntellirentSDK\Models\Property;

$propertyApi = new PropertyApi();

# Using Property object
$property = new IntellirentSDK\Models\Property();

$property->street_name_1 = '5th avenue';
$property->city = 'Santa Clara';
$property->state = 'NY';
$property->postal_code = '23456';
$property->rate = 1500;
$property->security_deposit = 1500;
$property->bedrooms = 2;
$property->bathrooms = 2;
$property->agent_email = 'jdoe@myintellirent.com';
$property->street_name_2 = 'governet house';
$property->unit_number = 1;
$property->parking = 1;
$property->property_type = 'HOUSE';
$property->available_date = '2/2/2017';
$property->lease_terms = '6 months';
$property->amenities = ["Hardwood floors","Elevator in building","Garden","On-site gym"];
$property->pictures = ["https://up-production.s3.amazonaws.com/uploads/grid_view_c8313a34-1402-4350-82cc-d0d103927c0e.jpg"];

$newPropertyResponse = $propertyApi->createProperty($property);
```

### Parameters
**Name**          | **Type**                                               | **Description**    | **Notes**
----------------- | ------------------------------------------------------ | ------------------ | ---------
**data** | Associative `Array` or [\IntellirentSDK\Mdels\Property](../Models/Property.md) | Property data |

### Return type
[**\IntellirentSDK\Models\NewPropertyResponse**](../Models/NewPropertyResponse.md)

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateProperty**
> string

### Usage
To update a property, we'll provide the `$property` which is an instance of [PropertyList](../Models/PropertyList.md) and an `array` of `$data` with the property information to the method call
```php
use IntellirentSDK\Apis\PropertyApi;

$propertyApi = new PropertyApi($apiClient);
$properties = $propertyApi->listAllProperties();

$propertyApi->updateProperty($properties->getItems()[0], [
    'unit_number' => 2,
    'parking' => 2
]);
```

### Parameters
**Name**          | **Type**                                               | **Description**    | **Notes**
----------------- | ------------------------------------------------------ | ------------------ | ---------
**property** | [\IntellirentSDK\Mdels\PropertyList](../Models/PropertyList.md) | PropertyList Object |
**data** | Associative `Array` | Property data |

### Return type
`string`

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **archiveProperty**
> string

### Usage
To archive a property, we'll provide the `$property` which is an instance of the [PropertyList](../Models/PropertyList.md) and `$agentEmail` to the method call
```php
use IntellirentSDK\Apis\PropertyApi;

$propertyApi = new PropertyApi($apiClient);

$properties = $propertyApi->listAllProperties();
$propertyApi->archiveProperty($properties->getItems()[0], 'jdoe@myintellirent.com');
```

### Parameters
**Name**          | **Type**                                               | **Description**    | **Notes**
----------------- | ------------------------------------------------------ | ------------------ | ---------
**property** | [\IntellirentSDK\Mdels\PropertyList](../Models/PropertyList.md) | PropertyList Object |
**agentEmail** | string |  |

### Return type
`string`

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)