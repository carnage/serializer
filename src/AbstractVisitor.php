<?php

/*
 * Copyright 2016 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace JMS\Serializer;

use JMS\Serializer\Accessor\AccessorStrategyInterface;
use JMS\Serializer\Accessor\DefaultAccessorStrategy;
use JMS\Serializer\Naming\PropertyNamingStrategyInterface;

abstract class AbstractVisitor implements VisitorInterface
{
    /**
     * @var PropertyNamingStrategyInterface
     */
    protected $namingStrategy;

    /**
     * @var AccessorStrategyInterface
     */
    protected $accessor;

    public function __construct(PropertyNamingStrategyInterface $namingStrategy, AccessorStrategyInterface $accessorStrategy = null)
    {
        $this->namingStrategy = $namingStrategy;
        $this->accessor = $accessorStrategy ?: new DefaultAccessorStrategy();
    }

    /**
     * @param TypeDefinition $type
     * @return TypeDefinition
     */
    protected function findElementType(TypeDefinition $type)
    {
        if (!$type->hasParam(0)) {
            return TypeDefinition::getUnknown();
        }

        if ($type->hasParam(1) && $type->getParam(0) instanceof TypeDefinition) {
            return $type->getParam(1);
        } else {
            return $type->getParam(0);
        }
    }

}