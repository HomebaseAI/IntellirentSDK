<?php

namespace IntellirentSDK\Models;

class ApplicantReport extends AbstractModel
{
    /**
     * Start date from which applicants count is to be calculated
     * 
     * @var $start_date
     */
    public $start_date;

    /**
     * End date until which applicants count is to be calculated
     * 
     * @var $end_date
     */
    public $end_date;

    /**
     * List of emails of agents
     * 
     * @var $agent_emails
     */
    public $agent_emails;

    /**
     * ApplicantReport constructor
     * 
     * @param string $startDate
     * @param string $endDate
     * @param array $agentEmails
     */
    public function __construct(string $startDate = null, string $endDate = null, array $agentEmails = null)
    {
        $this->start_date = $startDate;
        $this->end_date = $endDate;
        $this->agent_emails = $agentEmails;
    }
}