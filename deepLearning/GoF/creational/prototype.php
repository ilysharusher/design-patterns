<?php

final class ConcretePrototype
{
    public $property;
}

class Client
{
    public static function run(): string
    {
        $prototype = new ConcretePrototype();
        $prototype->property = 'example';

        $clone = clone $prototype;

        return $clone->property;
    }
}

echo Client::run();