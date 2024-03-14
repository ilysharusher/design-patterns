<?php

// This is not recommended because it is not a good practice to extend a class just to use its methods.

class GreetingLib
{
    public function hi(): string
    {
        return 'Hello';
    }

    public function goodbye(): string
    {
        return 'Goodbye';
    }
}

interface IAdapter
{
    public function sayHello(): string;

    public function sayGoodbye(): string;
}

class LibAdapter extends GreetingLib implements IAdapter
{
    public function sayHello(): string
    {
        return $this->hi();
    }

    public function sayGoodbye(): string
    {
        return $this->goodbye();
    }
}

$adapter = new LibAdapter();

echo $adapter->sayHello() . PHP_EOL;
echo $adapter->sayGoodbye();