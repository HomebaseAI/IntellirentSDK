<?php

namespace IntellirentSDK\ResponseSerializer;

use IntellirentSDK\Models\Agent;
use IntellirentSDK\Models\Collections\AgentCollection;

class AgentSerializer extends AbstractResponseSerializer
{
    /**
     * Parse agent
     * 
     * @param object $agent
     * @return Agent
     */
    public function parseAgent($agent)
    {
        $this->responseValidator->validate($agent, ['id', 'email']);
       
        return $this->item(
            Agent::class,
            [
                (int) $agent->id,
                $agent->email
            ]
        );
    }

    /**
     * Parse agents
     * 
     * @param object $agents_response
     * @return AgentCollection
     */
    public function parseAgents($agents_response)
    {
        $agents = [];

        foreach ($agents_response as $email => $id) {
            $agents[] = $this->parseAgent((object)['id' => $id, 'email' => $email]);
        }

        return $this->collection(AgentCollection::class, $agents);
    }
}