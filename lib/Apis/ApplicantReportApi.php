<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\Models\ApplicantReport;
use IntellirentSDK\ResponseSerializer\ApplicantReportSerializer;

class ApplicantReportApi extends AbstractApi
{
    /**
     * ApplicantReportApi constructor
     * 
     * @param ApplicantReportSerializer $applicantReportSerializer
     */
    public function __construct(ApplicantReportSerializer $applicantReportSerializer = null)
    {
        // Call mom!
        parent::__construct();

        $this->responseSerializer->setSerializer($this->resolve($applicantReportSerializer, ApplicantReportSerializer::class));
    }

    /**
     * Get applicants count based from ApplicantReport data
     * 
     * @param ApplicantReport $applicantReport
     * @return ApplicantCount
     */
    public function getApplicantsCount(ApplicantReport $applicantReport)
    {
        $data = (array) $applicantReport;

        $resourcePath = '/applicants_count';
        
        $response = $this->apiClient->call('POST', $resourcePath, [], $data);

        return $this->responseSerializer->getSerializer()->parseApplicantsCount($response);
    }
}