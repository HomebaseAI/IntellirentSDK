<?php

namespace IntellirentSDK\Models\Collections;

use IntellirentSDK\Models\Agent;

final class AgentCollection extends AbstractCollection
{
    /**
     * AgentCollection constructor
     * 
     * @param Agent ...$agents
     */
    public function __construct(Agent ...$agents)
    {
        $this->items = $agents;
    }
}