<?php

// Could also be called "Token"
// This pattern is might use for internal transactions, for example, in the database.
// No one except the originator can access the memento object.

class Caretaker
{
    private array $mementos = [];

    public function __construct(
        private Originator $originator
    ) {
    }

    public function addMemento(): void
    {
        $this->mementos[] = $this->originator->createMemento();
    }

    public function restoreMemento(): void
    {
        $memento = array_pop($this->mementos);
        $this->originator->restoreMemento($memento);
    }
}

class Memento
{
    private string $state;

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }
}

class Originator
{
    private string $state;

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function createMemento(): Memento
    {
        $memento = new Memento();
        $memento->setState($this->state);

        return $memento;
    }

    public function restoreMemento(Memento $memento): void
    {
        $this->state = $memento->getState();
    }
}

$originator = new Originator();
$originator->setState('State1');

$caretaker = new Caretaker($originator);
$caretaker->addMemento();

$originator->setState('State2');
$caretaker->addMemento();

$originator->setState('State3');
$caretaker->addMemento();

$caretaker->restoreMemento();

var_dump($originator);
var_dump($caretaker);