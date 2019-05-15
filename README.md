intellirent-sdk-php
=========
Intellirent SDK is a library written in PHP that enable an application to interact with the [Intellirent (IR) API](https://intellirent.docs.apiary.io/)

## Version
_TODO_

## Requirements
- PHP 5.4.0 and later
- PHP Curl extension
- PHP MBString extension
- PHP JSON extension

## Installation
To install via [Composer](https://getcomposer.org), add the following to composer.json:
```json
{
    "require": {
        "homebaseai/intellirent-sdk-php": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:HomebaseAI/IntellirentSDK.git
        }
    ]
}
```

## Quickstart
Before attempting to use this SDK, you should secure API credentials as follow:

#### Property Synidcation
This API requires a `security_token` and a `company-name`, which a partner will get by contacting IR support.

#### Single Sign On Integgration
This API uses a `security_token`, which a partner will get by contacting IR admin.

#### Applicant Report
This API uses a `security_key`, which will be shared with any entity who wishes to use our API.

Please follow the [installation procedure](#installation)

## Get Started

#### Configuring the SDK
```php
use IntellirentSDK\Configuration;

# Other Credential as required by IR API
# This is required in the PropertyApi
Configuration::setCompanyId('your-company-id');

# This is needed for all APIs request
Configuration::setSecurityToken('your-security-token');

# For Mock Server
Configuration::setBaseUrl('https://private-anon-396a0e7408-intellirent.apiary-mock.com');

# For production
Configuration::setBaseUrl('https://syndication.irapp.co');
```

## Documentation for APIs
All URIs are relative to *{base_url}/api/v2* \
All Classes are in `IntellirentSDK\Apis` namespace

**Class** | **Method** | **HTTP request** | **Description**
---------- | ----------- | ---------------- | -------------
*ApplicantApi* | [**createApplicant**](docs/Apis/ApplicantApi.md#createApplicant) | **POST** /applicants |
*ApplicantApi* | [**updateApplicant**](docs/Apis/ApplicantApi.md#updateApplicant) | **PUT** /applicants |
*ApplicantApi* | [**signIn**](docs/Apis/ApplicantApi.md#signIn) | **POST** /applicants/:sso_hash |
*ApplicantReportApi* | [**getApplicantsCount**](docs/Apis/ApplicantReportApi.md#getApplicantsCount) | **GET** /applicants_count |
*PropertyApi* | [**listAllProperties**](docs/Apis/PropertyApi.md#listAllProperties) | **GET** /:company_id/properties |
*PropertyApi* | [**createProperty**](docs/Apis/PropertyApi.md#createProperty) | **POST** /:company_id/properties |
*PropertyApi* | [**updateProperty**](docs/Apis/PropertyApi.md#updateProperty) | **PUT** /:company_id/properties/:property_id |
*PropertyApi* | [**archiveProperty**](docs/Apis/PropertyApi.md#archiveProperty) | **DELETE** /:company_id/properties/:property_id |
*ReferralContactApi* | [**createReferralContacts**](docs/Apis/ReferralContactApi.md#createReferralContacts) | **POST** /create_referral_contacts |

## Documentation for Models
- [Agent](docs/Models/Agent.md)
- [Applicant](docs/Models/Applicant.md)
- [ApplicantCount](docs/Models/ApplicantCount.md)
- [ApplicantReport](docs/Models/ApplicantReport.md)
- [ApplicantResponse](docs/Models/ApplicantResponse.md)
- [NewPropertyResponse](docs/Models/NewPropertyResponse.md)
- [Property](docs/Models/Property.md)
- [PropertyList](docs/Models/PropertyList.md)

## Running tests
```bash
composer install
./vendor/bin/phpunit --testdox tests
```
## Changelog
_TODO_

## License
_TODO_


