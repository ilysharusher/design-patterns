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

class DependencyInjection
{
    public function __construct(
        private Worker $worker
    ) {
    }

    public function work(): string
    {
        return $this->worker->work();
    }
}

$developer = new DependencyInjection(new Developer());
echo $developer->work();

$tester = new DependencyInjection(new Tester());
echo $tester->work();