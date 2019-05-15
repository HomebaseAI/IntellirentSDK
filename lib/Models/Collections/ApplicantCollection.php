<?php

namespace IntellirentSDK\Models\Collections;

use IntellirentSDK\Models\Applicant;

final class ApplicantCollection extends AbstractCollection
{
    /**
     * ApplicantCollection constructor
     * 
     * @param Applicant ...$applicants
     */
    public function __construct(Applicant ...$applicants)
    {
        $this->items = $applicants;
    }
}