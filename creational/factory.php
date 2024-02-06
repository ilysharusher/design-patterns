<?php

class Worker
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class WorkerFactory
{
    public static function create(): Worker
    {
        return new Worker();
    }
}

$worker1 = WorkerFactory::create();
$worker1->setName('First Worker');
echo $worker1->getName() . PHP_EOL;