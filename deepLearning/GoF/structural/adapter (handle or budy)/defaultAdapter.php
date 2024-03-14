<?php

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

class LibAdapter implements IAdapter
{
    public function __construct(
        private GreetingLib $greetingLib
    ) {
    }

    public function sayHello(): string
    {
        return $this->greetingLib->hi();
    }

    public function sayGoodbye(): string
    {
        return $this->greetingLib->goodbye();
    }
}

$greetingLib = new GreetingLib();
$adapter = new LibAdapter($greetingLib);

echo $adapter->sayHello() . PHP_EOL;
echo $adapter->sayGoodbye();