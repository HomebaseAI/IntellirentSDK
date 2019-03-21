<?php

namespace IntellirentSDK\Apis;

use IntellirentSDK\Models\ApplicantReport;
use IntellirentSDK\Models\Agent;
use IntellirentSDK\Models\applicantCount;

class ApplicantReportApi extends AbstractApi
{
    /**
     * @var $resourcePath
     */
    protected $resourcePath = '/applicants_count';

    /**
     * Get applicants count based from ApplicantReport data
     * 
     * @param ApplicantReport $applicantReport
     */
    public function applicantCounts(ApplicantReport $applicantReport)
    {
        $data = (array) $applicantReport;
        
        $response = $this->call('POST', $data);

        // applicant report data
        $applicantReport = (object) [
            'matched_record_count' => $response->matched_record_count,
            'agent_details' => $this->getAgentDetailsData((array) $response->agent_details)
        ];

        return (object) [
            'data' => $this->item($applicantReport, ApplicantCount::class)
        ];
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