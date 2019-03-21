<?php

namespace IntellirentSDK\Models;

class ApplicantCount extends AbstractModel
{
    /**
     * @var $matched_record_count
     */
    public $matched_record_count;

    /**
     * @var $agent_details
     */
    public $agent_details;

    public function __construct(int $matchedRecordCount, AgentDetail $agentDefails)
    {
        $this->matched_record_count = $matchedRecordCount;
        $this->agent_details = $agentDetails;
    }
}