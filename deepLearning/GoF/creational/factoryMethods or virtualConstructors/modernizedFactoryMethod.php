<?php

interface Worker
{
    public function work(): string;
}

class Developer implements Worker
{
    public function work(): string
    {
        return 'I am a developer' . PHP_EOL;
    }
}

class Tester implements Worker
{
    public function work(): string
    {
        return 'I am a tester' . PHP_EOL;
    }
}

class createWorker
{
    public function create($class): Worker
    {
        if (!class_exists($class)) {
            throw new \InvalidArgumentException('Class ' . $class . ' not found');
        }

        return new $class();
    }
}

$createWorker = new createWorker();
$developer = $createWorker->create(Developer::class);

echo $developer->work();