<?php

class WorkerList
{
    private array $list = [];
    private int $index = 0;

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function getItem($key): Worker
    {
        return $this->list[$key];
    }

    public function addIndex(): void
    {
        $this->index === count($this->list) - 1 ? $this->index = count($this->list) - 1 : $this->index++;
    }

    public function removeIndex(): void
    {
        $this->index === 0 ? $this->index = 0 : $this->index--;
    }

    public function getByIndex()
    {
        return $this->list[$this->index];
    }
}

class Worker
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

$worker = new Worker('John');
$worker2 = new Worker('Doe');
$worker3 = new Worker('Smith');

$workerList = new WorkerList();
$workerList->setList([$worker, $worker2, $worker3]);

echo $workerList->getByIndex()->getName();

$workerList->addIndex();
echo $workerList->getByIndex()->getName();