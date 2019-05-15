<?php

namespace IntellirentSDK\ResponseSerializer;

use IntellirentSDK\Traits\ObjectResolver;
use IntellirentSDK\Traits\StringHelper;
use IntellirentSDK\ResponseValidator;

abstract class AbstractResponseSerializer implements ResponseSerializerInterface
{
    use ObjectResolver, StringHelper;

    /**
     * @var ResponseValidator tool used to validate response
     */
    protected $responseValidator;

    /**
     * Default constructor for the response serializer
     * 
     * @param ResponseValidator $responseValidator
     */
    public function __construct(ResponseValidator $responseValidator = null)
    {
        $this->responseValidator = $this->resolve($responseValidator, ResponseValidator::class);
    }

    /**
     * {@inheritdoc}
     */
    public function item(string $model, array $args)
    {
        return new $model(...$args);
    }

    /**
     * {@inheritdoc}
     */
    public function collection(string $collection, array $items)
    {
        return new $collection(...$items);
    }
}