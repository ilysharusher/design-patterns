<?php

interface Worker
{
    public function hoursClosed(int $hours): void;

    public function countSalary(): int;
}

class WorkerOutsource implements Worker
{
    private array $hours = [];

    public function hoursClosed(int $hours): void
    {
        $this->hours[] = $hours;
    }

    public function countSalary(): int
    {
        return array_sum($this->hours) * 10;
    }
}

class WorkerProxy extends WorkerOutsource
{
    private int $salary;

    public function countSalary(): int
    {
        return $this->salary ?? $this->salary = parent::countSalary();
    }
}

$worker = new WorkerProxy();

$worker->hoursClosed(8);

echo $worker->countSalary() . PHP_EOL;
$worker->hoursClosed(88);
echo $worker->countSalary();