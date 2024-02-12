<?php

class WorkerFacade
{
    public function __construct(
        protected Developer $developer,
        protected Designer $designer
    ) {
    }

    public function startWork(): string
    {
        return $this->developer->startDevelop() . ' ' . $this->designer->startDesign();
    }

    public function stopWork(): string
    {
        return $this->developer->stopDevelop() . ' ' . $this->designer->stopDesign();
    }
}

class Developer
{
    public function startDevelop(): string
    {
        return 'Developing...';
    }

    public function stopDevelop(): string
    {
        return 'Stop developing...';
    }
}

class Designer
{
    public function startDesign(): string
    {
        return 'Designing...';
    }

    public function stopDesign(): string
    {
        return 'Stop designing...';
    }
}

$worker = new WorkerFacade(new Developer(), new Designer());

echo $worker->startWork() . PHP_EOL;
echo $worker->stopWork();