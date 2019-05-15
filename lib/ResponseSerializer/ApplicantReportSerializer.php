<?php

namespace IntellirentSDK\ResponseSerializer;

use IntellirentSDK\Models\ApplicantCount;

class ApplicantReportSerializer extends AbstractResponseSerializer
{
    private $agentSerializer;

    /**
     * ApplicantReportSerializer constructor
     * 
     * @param AgentSerializer $agentSerializer
     */
    public function __construct(AgentSerializer $agentSerializer = null)
    {
        // Call mom!
        parent::__construct();

        $this->agentSerializer = $this->resolve($agentSerializer, AgentSerializer::class);
    }

    /**
     * Parse applicant count report
     * 
     * @param object $applicant_count_response
     * @param ApplicantCount
     */
    public function parseApplicantsCount($applicant_count_response)
    {
        $this->responseValidator->validate($applicant_count_response, ['matched_record_count', 'agent_details']);

        $agents = $this->agentSerializer->parseAgents($applicant_count_response->agent_details);

        return $this->item(
            ApplicantCount::class,
            [
                $applicant_count_response->matched_record_count,
                $agents
            ]
        );
    }
}