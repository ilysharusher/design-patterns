<?php

interface Worker
{
    public function countSalary(): int;
}

abstract class WorkerDecorator implements Worker
{
    public function __construct(
        protected Worker $worker
    ) {
    }
}

class Developer implements Worker
{
    public function countSalary(): int
    {
        return 5000;
    }
}

class DeveloperWithBonus extends WorkerDecorator
{
    public function countSalary(): int
    {
        return $this->worker->countSalary() + 1000;
    }
}

$developer = new Developer();
$developerWithBonus = new DeveloperWithBonus($developer);

echo $developer->countSalary() . PHP_EOL;
echo $developerWithBonus->countSalary();