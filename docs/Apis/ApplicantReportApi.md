# \IntellirentSDK\Apis\ApplicantReportApi

All URIs are relative to *{base_url}/api/v2* \
All API methods require an [ApiClient](../../README.md#creating-a-client)

Method | HTTP request | Description
------- | ------------- | ---------
[**getApplicantsCount**](ApplicantReportApi.md#getApplicantsCount) | **GET** /applicants_count |

# **getApplicantsCount**
> \IntellirentSDK\Models\ApplicantCount

### Usage
In order to request for Applicant Count Report, we'll be passing an object of type `ApplicantReport`
```php
use IntellirentSDK\Apis\ApplicantReprtApi;
use IntellirentSDK\Models\ApplicantReport;

$applicantReportApi = new ApplicantReportApi($apiClient);
$applicantReport = new ApplicantReport(
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

### Parameters
**Name**          | **Type**                                               | **Description**    | **Notes**
----------------- | ------------------------------------------------------ | ------------------ | ---------
**applicantReport** | [\IntellirentSDK\Mdels\ApplicantReport](../Models/ApplicantReport.md) | Applicant Report data |

### Return type
[**\IntellirentSDK\Models\ApplicantCount**](../Models/ApplicantCount.md)

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)