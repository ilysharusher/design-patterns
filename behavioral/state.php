<?php

interface State
{
    public function toNext(Task $task): void;

    public function getStatus(): string;
}

class Task
{
    private State $state;

    public function __construct()
    {
        $this->state = new CreatedState();
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function toNext(): void
    {
        $this->state->toNext($this);
    }
}

class CreatedState implements State
{
    public function toNext(Task $task): void
    {
        $task->setState(new DevelopState());
    }

    public function getStatus(): string
    {
        return 'Created';
    }
}

class DevelopState implements State
{
    public function toNext(Task $task): void
    {
        $task->setState(new TestState());
    }

    public function getStatus(): string
    {
        return 'Develop';
    }
}

class TestState implements State
{
    public function toNext(Task $task): void
    {
        $task->setState(new DoneState());
    }

    public function getStatus(): string
    {
        return 'Test';
    }
}

class DoneState implements State
{
    public function toNext(Task $task): void
    {
        // Do nothing
    }

    public function getStatus(): string
    {
        return 'Done';
    }
}

$task = new Task();

echo $task->getState()->getStatus() . PHP_EOL;

$task->toNext();
echo $task->getState()->getStatus() . PHP_EOL;

$task->toNext();
echo $task->getState()->getStatus() . PHP_EOL;

$task->toNext();
echo $task->getState()->getStatus() . PHP_EOL;