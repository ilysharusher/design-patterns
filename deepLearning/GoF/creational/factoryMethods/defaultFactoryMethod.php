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

interface WorkerFactory
{
    public function createWorker(): Worker;
}

class DeveloperFactory implements WorkerFactory
{
    public function createWorker(): Worker
    {
        return new Developer();
    }
}

class TesterFactory implements WorkerFactory
{
    public function createWorker(): Worker
    {
        return new Tester();
    }
}

class MakeFactory
{
    public function make(WorkerFactory $workerFactory): Worker
    {
        return $workerFactory->createWorker();
    }
}

$makeFactory = new MakeFactory();

$developer = $makeFactory->make(new DeveloperFactory());
echo $developer->work();

$tester = $makeFactory->make(new TesterFactory());
echo $tester->work();