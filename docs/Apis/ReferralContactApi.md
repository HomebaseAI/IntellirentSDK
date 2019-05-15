# IntellirentSDK\Apis\ReferralContactApi

All URIs are relative to *{base_url}/api/v2* 

Method | HTTP request | Description
------- | ------------- | ---------
[**createReferralContacts**](#createReferralContacts) | **POST** /create_referral_contacts | Create te referrer's information of each of the recipient on the hubspot, provided in te request

# createReferralContacts
> \Inte;;irentSDK\Models\ReferralContactResponse

### Usage
```php
use IntellirentSDK\Apis\ReferralContactApi;
use IntellirentSDK\Models\ReferralContact;


$referralContactApi = new ReferralContactApi();
$contact1 = new ReferralContact();

$contact1->message_id = 1001;
$contact1->referrer_first_name = 'Joe';
$contact1->referrer_last_name = 'Doe';
$contact1->referrer_email = 'joedoe@intellirent.com';
$contact1->recipient_email = 'carljenko@intellirent.com';
$contact1->referral_shared_link = 'https//:referral_contact.com';
$contact1->referral_message = 'Joe Doe is inviting';
$contact1->referral_time = '2019-03-10 22:00';

$contact2 = new ReferralContact();

$contact2->message_id = 1002;
$contact2->referrer_first_name = 'Bernd';
$contact2->referrer_last_name = 'Leno';
$contact2->referrer_email = 'berndleno@intellirent.com';
$contact2->recipient_email = 'xhaka@intellirent.com';
$contact2->referral_shared_link = 'https//:referral_contact.com';
$contact2->referral_message = 'Bernd Leno is inviting';
$contact2->referral_time = '2019-03-20 07:00';

$referrals = [
    $contact1,
    $contact2
];

$referralContactResponse = $referralContactApi->createReferralContacts($referrals);
```

### Parameters
**Name**          | **Type**                                               | **Description**    | **Notes**
----------------- | ------------------------------------------------------ | ------------------ | ---------
**referral** | [[\Intellirent\Models\ReferralContact]](../Models/ReferralContact.md) | Referral array contining all referral's with details |

### Return type
[**\IntellirentSDK\Models\ReferralContactReponse**](../Models/ReferralContactResponse.md)

### Authorization
[Security Token](../../README.md#Quickstart)

### HTTP request headers
- **Content-Type**: application/json
- **SECURITY-TOKEN**: {security_token}

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)