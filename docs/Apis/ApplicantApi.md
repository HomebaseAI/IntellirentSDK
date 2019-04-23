# IntellirentSDK\Apis\ApplicantApi

All URIs are relative to *{base_url}/api/v2* \
All API methods require an [ApiClient](../../README.md#creating-a-client)

Method | HTTP request | Description
------- | ------------- | ---------
[**createApplicant**](ApplicantApi.md#createApplicant) | **POST** /applicants |
[**updateApplicant**](ApplicantApi.md#updateApplicant) | **PUT** /applicants |
[**signIn**](ApplicantApi.md#signIn) | **POST** /applicants/:sso_hash |

# **createApplicant**
> \IntellirentSDK\Models\ApplicantResponse

### Usage
To create a new applicant, we can either provide an (associative) `array` with the expected values, or an `Applicant` object.
```php
use IntellirentSDK\Apis\ApplicantApi;

$applicantApi = new ApplicantApi($apiClient);

# Using associative array
$new_applicant = $applicantApi->create([
    'property_id' => 1234,
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'jdoe@myintellirent.com',
    'phone_number' => '(123) 456-7890'
]);
```
#### or
```php
use IntellirentSDK\Apis\ApplicantApi;
use IntellirentSDK\Models\Applicant;

$applicantApi = new ApplicantApi($apiClient);
$applicant = new Applicant();

$applicant->property_id = 1234;
$applicant->first_name = 'John';
$applicant->last_name = 'Doe';
$applicant->email = 'jdoe@myintellirent.com';
$applicant->phone_number = '(123) 456-7890';

# Using Applicant object
$new_applicant = $applicantApi->create($applicant);
```

### Parameters
**Name**          | **Type**                                               | **Description**    | **Notes**
----------------- | ------------------------------------------------------ | ------------------ | ---------
**data** | Associative `Array` or [\IntellirentSDK\Mdels\Applicant](../Models/Applicant.md) | New Applicant data |

### Return type
[**\IntellirentSDK\Models\ApplicantReponse**](../Models/ApplicantResponse.md)

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateApplicant**
> \IntellirentSDK\Models\ApplicantResponse

## Usage
To update existing applicant, we'll provide the `$userId` and and an `array` of `$data` with the applicant information to the method call
```php
use IntellirentSDK\Api\ApplicantApi;

$applicantApi = new ApplicantApi($apiClient);

$applicant = $applicantApi->update(1234, [
    'first_name' => 'Jane'
]);
```
### Parameters
**Name**          | **Type**                                               | **Description**    | **Notes**
----------------- | ------------------------------------------------------ | ------------------ | ---------
**user_id** | `int` | Applicant user id |
**data** | associative `Array` | Applicant data |

### Return type
[**\IntellirentSDK\Models\ApplicantReponse**](../Models/ApplicantResponse.md)

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **signIn**
> TODO
