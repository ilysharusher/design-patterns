<?php

interface Worker
{
    public function work(): string|null;
}

class WorkerObject
{
    public function __construct(
        private Worker $worker
    ) {
    }

    public function work(): string|null
    {
        return $this->worker->work();
    }
}

class WorkerReal implements Worker
{
    public function work(): string|null
    {
        return 'I am working';
    }
}

class WorkerNull implements Worker
{
    public function work(): string|null
    {
        return null;
    }
}

$worker = new WorkerObject(new WorkerReal());
$fakeWorker = new WorkerObject(new WorkerNull());

echo $worker->work() . PHP_EOL;
echo $fakeWorker->work();
