<?php

class Worker implements SplSubject
{
    private SplObjectStorage $observers;
    private string $name = 'none';

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->notify();
    }
}

class WorkerObserver implements SplObserver
{
    private array $workers = [];

    public function update(SplSubject $subject): void
    {
        $this->workers[] = clone $subject;
    }

    public function getWorkers(): array
    {
        return $this->workers;
    }
}

$observer = new WorkerObserver();

$worker = new Worker();

$worker->attach($observer);
$worker->setName('John');
$worker->setName('Doe');
$worker->setName('Smith');

var_dump($observer->getWorkers());
var_dump(count($observer->getWorkers()));