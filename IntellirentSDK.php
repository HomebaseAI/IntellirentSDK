<?php

$dir = [
    '/Traits', // load Traits for classes
    '/Exceptions', // load throwable Exceptions classes 
    '/', // load Base classes
    '/Apis', // load classes for accessing the Apis
    '/Models', // load Model defined for endpoints
];

foreach ($dir as $path) {
    foreach (glob(dirname(__FILE__).'/lib' . $path . '/*.php') as $filename) {
        require_once $filename;
    }
}