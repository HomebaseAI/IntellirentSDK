<?php

namespace IntellirentSDK\Traits;

trait StringHelper
{
    /**
     * Translates a camel case string into a string with
     * unserscores (e.g firstName -> first_name)
     * 
     * @param string $str String in camel case format
     * @return string $str Translated into underscore format
     */
    public function fromCamelCase($str)
    {
        $str[0] = strtolower($str[0]);
        
        return preg_replace_callback('/([A-Z1-9])/', function($c) {
            return '_' . strtolower($c[1]);
        }, $str);
    }

    /**
     * Translates a string with underscores
     * into camel case (e.g first_name -> firstName)
     * 
     * @param string $str String in underscore format
     * @param bool $capitalizeFirstChar if true, capitalize the first_char in $str
     * @return string $str translated into camel caps
     */
    public function toCamelCase($str, $capitalizeFirstChar = false)
    {
        if ($capitalizeFirstChar) {
            $str[0] = strtoupper($str[0]);
        }

        return preg_replace_callback('/_([a-z1-9])/', function($c) {
            return strtoupper($c[1]);
        }, $str);
    }

    /**
     * Replaces hypen character found in the string with underscore
     * 
     * @param string $str String with hypen
     * @return string 
     */
    public function fromHyphen($str)
    {
        return str_replace('-', '_', $str);
    }

    /**
     * Replace underscore character found in the string with hyphen
     * 
     * @param string $str String with underscore
     * @return string
     */
    public function toHyphen($str)
    {
        return str_replace('_', '-', $str);
    }
}