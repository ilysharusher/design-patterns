<?php

class WorkerPool
{
    private array $occupiedWorkers = [];
    private array $freeWorkers = [];

    public function getWorker(): Worker
    {
        if (!count($this->freeWorkers)) {
            $worker = new Worker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function dispose(Worker $worker): void
    {
        $key = spl_object_hash($worker);

        if (isset($this->occupiedWorkers[$key])) {
            unset($this->occupiedWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }
}

class Worker
{
    public function work(): string
    {
        return 'I\'m working' . PHP_EOL;
    }
}

$workerPool = new WorkerPool();

$worker1 = $workerPool->getWorker();
echo $worker1->work();

$workerPool->dispose($worker1);