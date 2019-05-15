<?php

namespace IntellirentSDK\Traits;

trait ObjectResolver
{
    /**
     * Resolve null object var to object specified by type
     * 
     * @param mixed $var
     * @param string $type
     */
    public function resolve($var, $type)
    {
        return null === $var ? new $type() : $var;
    }
}