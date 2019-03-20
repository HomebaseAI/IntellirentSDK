<?php

namespace IntellirentSDK\Traits;

use ReflectionClass;
use ReflectionProperty;

Trait Result
{
    /**
     * Returned a collection. Map $result data to $class instance
     * 
     * @param array $result
     * @param string $className
     * return array
     */
    public function collection(array $result, string $className): array
    {
        $collection = [];

        if (!empty($result)) {
            $rc = new ReflectionClass($className);

            foreach ($result as $data) {
                // create an empty model instance
                $instance = $rc->newInstanceWithoutConstructor();
                
                // loop through object properties
                foreach ($data as $property => $value) {
                    $this->setProperty($instance, $rc->getProperty($property), $value);
                }

                // pushed into array collection
                array_push($collection, $instance);
            }       
        }

        return $collection;
    }

    /**
     * Returned item result. Map $data to $class instance
     * 
     * @param $object $data
     * @param string $className
     * @return object 
     */
    public function item(object $data, string $className): object
    {
        $item = null;

        if (!empty($data)) {
            $rc = new ReflectionClass($className);

            // create an empty model instance
            $item = $rc->newInstanceWithoutConstructor();

            // loop through object properties
            foreach ($data as $property => $value) {
                $this->setProperty($item, $rc->getProperty($property), $value);
            }
        }

        return $item;
    }

    /**
     * set the property of the $object
     * 
     * @param object $object
     * @param ReflectionProperty $accessor
     * @param mixed $value
     * @return void
     */
    private function setProperty(object $object, ReflectionProperty $accessor, $value): void
    {
        if ($accessor->isPublic()) {
            $accessor->setAccessible(true);
        }
        
        $accessor->setValue($object, $value);
    }
}