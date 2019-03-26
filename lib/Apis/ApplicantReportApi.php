<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\Models\ApplicantReport;
use IntellirentSDK\Models\Agent;
use IntellirentSDK\Models\applicantCount;

final class ApplicantReportApi extends AbstractApi
{
    /**
     * Get applicants count based from ApplicantReport data
     * 
     * @param ApplicantReport $applicantReport
     * @return ApplicantCount
     */
    public function applicantCounts(ApplicantReport $applicantReport)
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

        return $this->item($applicantReport, ApplicantCount::class);
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
        foreach ($data as $key => $value) {
            $agent = $this->item(
                (object) ['id' => $value, 'email' => $key],
                Agent::class
            );

            array_push($details, $agent);
        }

        return $details;
    }
}