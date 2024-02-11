<?php

class Worker
{
    public function __construct(
        private string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class WorkerMapper
{
    public function __construct(
        private WorkerStorage $storage
    ) {
    }

    public function save(array $worker): void
    {
        $this->storage->persist($worker);
    }

    public function findById(int $id): Worker|null
    {
        return $this->storage->retrieve($id) ?? null;
    }
}

class WorkerStorage
{
    public function __construct(
        private array $workers
    ) {
    }

    public function persist(array $worker): void
    {
        $this->workers[] = $worker;
    }

    public function retrieve(int $id): Worker|null
    {
        return $this->workers[$id] ?? null;
    }
}

$workerStorage = new WorkerStorage([
    ['name' => 'John Smith'],
    ['name' => 'Jane Doe'],
    ['name' => 'Tom Brown'],
    ['name' => 'Lucy Black'],
    ['name' => 'Michael White'],
]);

$workerMapper = new WorkerMapper($workerStorage);

var_dump($workerStorage);