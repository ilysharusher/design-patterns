<?php

abstract class WorkerPrototype
{
    protected string $name;
    protected string $position;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }
}

class Developer extends WorkerPrototype
{
    public function __construct()
    {
        $this->setName('Ivan');
        $this->setPosition('Developer');
    }
}

class Designer extends WorkerPrototype
{
    public function __construct()
    {
        $this->setName('Vlad');
        $this->setPosition('Designer');
    }
}

$developer = new Developer();
$designer = new Designer();

$developer2 = clone $developer;
$designer2 = clone $designer;

echo $developer2->getName() . ' ' . $developer2->getPosition() . PHP_EOL;
echo $designer2->getName() . ' ' . $designer2->getPosition() . PHP_EOL;