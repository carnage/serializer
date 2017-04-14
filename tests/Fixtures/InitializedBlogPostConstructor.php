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

namespace JMS\Serializer\Tests\Fixtures;

use JMS\Serializer\Construction\LegacyObjectConstructorTrait;
use JMS\Serializer\Construction\ObjectInstantiatorInterface;
use JMS\Serializer\Construction\UnserializeObjectConstructor;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\DeserializationVisitorInterface;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\TypeDefinition;

class InitializedBlogPostConstructor implements ObjectInstantiatorInterface
{
    use LegacyObjectConstructorTrait;

    public function instantiate(DeserializationVisitorInterface $visitor, ClassMetadata $metadata, $data, TypeDefinition $type, DeserializationContext $context)
    {
        if ($type->getName() !== 'JMS\Serializer\Tests\Fixtures\BlogPost') {
            $constructor = new UnserializeObjectConstructor();
            return $constructor->instantiate($visitor, $metadata, $data, $type);
        }

        return new BlogPost('This is a nice title.', new Author('Foo Bar'), new \DateTime('2011-07-30 00:00', new \DateTimeZone('UTC')), new Publisher('Bar Foo'));
    }
}