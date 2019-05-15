<?php

namespace IntellirentSDK;

use IntellirentSDK\ResponseSerializer\ResponseSerializerInterface;

class ResponseSerializer
{
    /**
     * @var ResponseSerializerInterface
     */
    private $serializer;

    /**
     * Set a serializer for the response
     * 
     * @param ResponseSerializerInterface $serializer
     * @return ResponseSerializer
     */
    public function setSerializer(ResponseSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * Get the serializer for the response
     * 
     * @return ResponseSerializerInterface
     */
    public function getSerializer()
    {
        return $this->serializer;
    }
}