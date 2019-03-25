<?php

namespace IntellirentSDK\Traits;

use ReflectionClass;
use ReflectionProperty;
use ReflectionException;
use IntellirentSDK\Models\ResultFactory;
use IntellirentSDK\Models\ResultMetaFactory;

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
                    try {
                        $this->setProperty($instance, $rc->getProperty($property), $value);
                    } catch (ReflectionException $e) {
                        continue;
                    }
                }

                // pushed into array collection
                $collection[] = $instance;
            }       
        }

        return $collection;
    }

    /**
     * Returned item result. Map $data to $class instance
     * 
     * @param $data
     * @param string $className
     * @return object 
     */
    public function item($data, string $className): object
    {
        $item = null;

        $data = is_array($data) ? (object) $data : $data;

        if (!empty($data)) {
            $rc = new ReflectionClass($className);

            // create an empty model instance
            $item = $rc->newInstanceWithoutConstructor();

            // loop through object properties
            foreach ($data as $property => $value) {
                try {
                    $this->setProperty($item, $rc->getProperty($property), $value);
                } catch (ReflectionException $e) {
                    continue;
                }
            }
        }

        return $item;
    }

    /**
     * 
     * @param $data
     * @return object
     */
    public function result($data): object 
    {
        // check to see if meta is set
        if (isset($data['meta'])) {
            $data['meta'] = new ResultMetaFactory($data['meta']);
        }

        return $this->item($data, ResultFactory::class);
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