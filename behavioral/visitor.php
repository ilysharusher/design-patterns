<?php

interface WorkerVisitor
{
    public function visitDeveloper(Worker $worker): void;

    public function visitManager(Worker $worker): void;
}

class RecorderVisitor implements WorkerVisitor
{
    private array $visited = [];

    public function visitDeveloper(Worker $developer): void
    {
        $this->visited[] = $developer;
    }

    public function visitManager(Worker $designer): void
    {
        $this->visited[] = $designer;
    }

    public function getVisited(): array
    {
        return $this->visited;
    }
}

interface Worker
{
    public function work(): string;

    public function accept(WorkerVisitor $visitor): void;
}

class Developer implements Worker
{
    public function work(): string
    {
        return 'coding';
    }

    public function accept(WorkerVisitor $visitor): void
    {
        $visitor->visitDeveloper($this);
    }
}

class Manager implements Worker
{
    public function work(): string
    {
        return 'managing';
    }

    public function accept(WorkerVisitor $visitor): void
    {
        $visitor->visitManager($this);
    }
}

$visitor = new RecorderVisitor();

$developer = new Developer();
$manager = new Manager();

$developer->accept($visitor);
$manager->accept($visitor);

var_dump($visitor->getVisited());