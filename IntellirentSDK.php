<?php

$dir = [
     // load Traits for classes
    '/Traits',
    // load throwable Exceptions classes
    '/Exceptions',
    // load Base classes  
    '/', 
    // load classes for accessing the Apis
    '/Apis', 
    // load Model defined for endpoints
    '/Models', 
];

foreach ($dir as $path) {
    foreach (glob(dirname(__FILE__).'/lib' . $path . '/*.php') as $filename) {
        require_once $filename;
    }
}