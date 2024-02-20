<?php

class Memento
{
    public function __construct(
        private State $state
    ) {
    }

    public function getState(): State
    {
        return $this->state;
    }
}

class State
{
    public const string STATE_CREATED = 'created';
    public const string STATE_PROCESSED = 'processed';
    public const string STATE_TESTED = 'tested';
    public const string STATE_FINISHED = 'finished';

    public function __construct(
        private string $state
    ) {
    }

    public function __toString(): string
    {
        return $this->state;
    }
}

class Task
{
    public function __construct(
        private State $state
    ) {
    }

    public function created(): void
    {
        $this->state = new State(State::STATE_CREATED);
    }

    public function processed(): void
    {
        $this->state = new State(State::STATE_PROCESSED);
    }

    public function tested(): void
    {
        $this->state = new State(State::STATE_TESTED);
    }

    public function finished(): void
    {
        $this->state = new State(State::STATE_FINISHED);
    }

    public function saveToMemento(): Memento
    {
        return new Memento($this->state);
    }

    public function restoreFromMemento(Memento $memento): void
    {
        $this->state = $memento->getState();
    }

    public function getState(): State
    {
        return $this->state;
    }
}

$task = new Task(new State(State::STATE_CREATED));

$memento = $task->saveToMemento();

var_dump($task->getState() === $memento->getState());