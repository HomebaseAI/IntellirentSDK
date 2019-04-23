# Property

## Properties
Name         | Type          | Description   | Notes
------------ | ------------- | ------------- | -------------
**street_name_1** | **string** | Street address of this property (including number, street name, street suffix (e.g Drive, Blvd, etc.), apartment/unit number, etc) | 
**street_name_2** | **string** | Street address line 2 | 
**unit_number** | **string** | Unit number of the property | 
**city** | **string** | City in which this property is located |
**state** | **string** | State in which this property is located. Includes District of Columbia and Perto Rico | Accepted values: AK, AL, AR, AZ, CA, CO, CT, DC, DE, FL, GA, HI, IA,ID, IL, IN, KS, KY, LA, MA, MD, ME, MI, MN, MO, MS, MT, NC, ND, NE, NH, NJ, NM, NV, NY, OH, OK, OR, PA, PR, RI, SC, SD, TN, TX, UT, VA, VT, WA, WI, WV, WY 
**postal_code** | **string** | 5-digit zip code in which this property is located |
**agent_email** | **string** | Email of agent who manages property and has account in IR | 
**rate** | **float** | Specified rent for to be offered for this property. This value will be used in the Income-to-Rent comparison when evailuating the applicants in this application | 
**security_deposit** | **float** | Specified deposit required for this property |
**lease_terms** | **string** | Specified lease duration for this property |
**bedrooms** | **float** | No. of bedrooms of this property |
**bathrooms** | **float** | No. of bathrooms of this property |
**utilities** | **string** | Utilities those are included in this property |
**available_date** | **string** | Date on which property will be available | format: `YYYY-MM-DD`
**description** | **string** | Description of property |
**amenities** | **[string]** | All amenities that this property have |
**pictures** | **[string]** | Pictures of properties |
**parking** | **int** | No. of cars can be parked in property |
**property_type** | **string** | Type of property | Accepted values: "CONDO", "HOUSE", "TOWNHOUSE"

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-apis) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)