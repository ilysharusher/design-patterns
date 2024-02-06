<?php

interface Worker
{
    public static function work(): string;
}

class Developer implements Worker
{
    public static function work(): string
    {
        return 'Coding';
    }
}

class Tester implements Worker
{
    public static function work(): string
    {
        return 'Testing';
    }
}

class WorkerFactory
{
    public static function create(string $worker): Worker|null
    {
        if (class_exists($worker)) {
            return new $worker();
        }

        return null;
    }
}

$developer = WorkerFactory::create('developer');
echo $developer->work();