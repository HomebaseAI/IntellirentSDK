<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\Models\ApplicantReport;
use IntellirentSDK\Models\Agent;
use IntellirentSDK\Models\ApplicantCount;

class ApplicantReportApi extends AbstractApi
{
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

        $this->validateResponse($response, ['matched_record_count', 'agent_details']);

        // applicant report data
        $applicantReport = [
            'matched_record_count' => $response->matched_record_count,
            'agent_details' => $this->getAgentDetailsData((array) $response->agent_details)
        ];

        $agentDetails = $this->getAgentDetailsData((array) $response->agent_details);

        return new ApplicantCount($response->matched_record_count, $agentDetails);
    }

    /**
     * Extract Agent Detail
     * 
     * @param array $data
     * @return array
     */
    private function getAgentDetailsData(array $data): array
    {
        $details = [];

        foreach ($data as $email => $id) {
            $agent = new Agent((int) $id, $email);
            $details[] = $agent;
        }

        return $details;
    }
}