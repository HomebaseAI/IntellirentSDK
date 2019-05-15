<?php

namespace IntellirentSDK\Models\Collections;

use IntellirentSDK\Models\ModelInterface;

abstract class AbstractCollection implements CollectionInterface
{
    /**
     * @var $items
     */
    protected $items = [];

    /**
     * @param ModelInterface $item
     * @return CollectionInterface
     */
    public function addItem(ModelInterface $item)
    {
        $this->item[] = $item;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
}