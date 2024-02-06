<?php

interface Worker
{
    public static function work(): string;
}

class Developer implements Worker
{
    public static function work(): string
    {
        return 'coding';
    }
}

class Tester implements Worker
{
    public static function work(): string
    {
        return 'testing';
    }
}

interface WorkerFactory
{
    public static function create(): Worker;
}

class DeveloperFactory implements WorkerFactory
{
    public static function create(): Worker
    {
        return new Developer();
    }
}

class TesterFactory implements WorkerFactory
{
    public static function create(): Worker
    {
        return new Tester();
    }
}

$developer = DeveloperFactory::create();
$tester = TesterFactory::create();

echo $developer::work() . PHP_EOL;
echo $tester::work() . PHP_EOL;