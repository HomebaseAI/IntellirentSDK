<?php

namespace IntellirentSDK\ResponseSerializer;

interface ResponseSerializerInterface
{
    /**
     * Build out Model object
     * 
     * @param string $model
     * @param array $args
     */
    public function item(string $model, array $args);

    /**
     * Build out collection of model object
     * 
     * @param string $collection
     * @param array $items
     */
    public function collection(string $collection, array $items);
}