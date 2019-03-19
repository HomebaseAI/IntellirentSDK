<?php

namespace IntellirentSDK\Traits;

Trait Helper
{
    /**
     * Fix invalid JSON string
     * 
     * @param string $json
     * @return string
     */
    public function fixJSON(string $json): string
    {
        $regex = '/(?<!")([a-zA-Z0-9_]+)(?!")(?=:)/i';
        $str = preg_replace($regex, '"$1"', $json);
        
        return $str;
    }
}