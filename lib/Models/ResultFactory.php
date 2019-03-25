<?php

namespace IntellirentSDK\Models;

class ResultFactory extends AbstractModel
{
    /**
     * @var $meta
     */
    public $meta;

    /**
     * @var $data
     */
    public $data;

    public function __construct(ResultFactoryMeta $meta, $data)
    {
        $this->meta = $meta;
        $this->data = $data;
    }
}