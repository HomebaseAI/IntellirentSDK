<?php

namespace IntellirentSDK\Models\Collections;

use IntellirentSDK\Models\ModelInterface;

interface CollectionInterface
{
    /**
     * @return [ModelInterface]
     */
    public function getItems();
}