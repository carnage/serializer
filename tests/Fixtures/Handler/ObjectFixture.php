<?php

namespace JMS\Serializer\Tests\Fixtures\Handler;

use JMS\Serializer\Annotation as JMS;

class ObjectFixture
{
    /**
     * @JMS\Type("integer")
     */
    private $id = 3;

    /**
     * @JMS\Type("Object")
     */
    private $object;

    public function __construct()
    {
        $this->object = new DynamicObject();
    }
}
