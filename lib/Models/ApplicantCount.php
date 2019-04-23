<?php

namespace IntellirentSDK\Models;

class ApplicantCount extends AbstractModel
{
    /**
     * @var $matched_record_count
     */
    private $matched_record_count;

    /**
     * @var $agent_details
     */
    private $agent_details;

    /**
     * ApplicantCount constructor
     * 
     * @param int $matchedRecordCount
     * @param mixed $agentDetails
     */
    public function __construct(int $matchedRecordCount = 0, $agentDetails = null)
    {
        $this->matched_record_count = $matchedRecordCount;
        $this->agent_details = $agentDetails;
    }

    /**
     * get $matched_record_count
     * 
     * @return int
     */
    public function getMatchedRecordCount()
    {
        return $this->matched_record_count;
    }

    /**
     * get $agent_details
     * 
     * @return array
     */
    public function getAgentDetails()
    {
        return $this->agent_details;
    }
}