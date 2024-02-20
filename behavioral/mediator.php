<?php

interface Mediator
{
    public function getWorker();
}

abstract class Worker
{
    public function __construct(
        private readonly string $name
    ) {
    }

    public function sayHello(): string
    {
        return "Hello, my name is {$this->name}";
    }

    public function work(): string
    {
        return $this->name . ' is working';
    }
}

class InfoBase
{
    public function getInformation(Worker $worker): string
    {
        return $worker->work();
    }
}

class WorkerInfoBaseMediator implements Mediator
{
    public function __construct(
        private Worker $worker,
        private InfoBase $infoBase
    ) {
    }

    public function getWorker(): Worker
    {
        return $this->worker;
    }

    public function getInformation(): string
    {
        return $this->infoBase->getInformation($this->worker);
    }
}

class Developer extends Worker
{
}

$developer = new Developer('John');
$mediator = new WorkerInfoBaseMediator($developer, new InfoBase());

echo $developer->sayHello() . PHP_EOL;
echo $mediator->getInformation() . PHP_EOL;