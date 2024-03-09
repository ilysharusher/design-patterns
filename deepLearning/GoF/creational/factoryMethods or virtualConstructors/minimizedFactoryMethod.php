<?php

// This minimized version of the Factory Method pattern has the cyclical dependency problem

abstract class Worker
{
    abstract public function work(): string;

    public static function createDeveloper(): Worker
    {
        return new Developer();
    }

    public static function createTester(): Worker
    {
        return new Tester();
    }
}

class Developer extends Worker
{
    public function work(): string
    {
        return 'I am a developer' . PHP_EOL;
    }
}

class Tester extends Worker
{
    public function work(): string
    {
        return 'I am a tester' . PHP_EOL;
    }
}

$developer = Worker::createDeveloper();
echo $developer->work();

$tester = Worker::createTester();
echo $tester->work();