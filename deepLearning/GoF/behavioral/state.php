<?php

// This pattern is rarely used

interface DoorState
{
    public function open(): void;

    public function close(): void;

    public function setState(State $state): void;
}

class Door implements DoorState
{
    public function __construct(
        private State $state
    ) {
    }

    public function open(): void
    {
        $this->state->open($this);
    }

    public function close(): void
    {
        $this->state->close($this);
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }
}

interface State
{
    public function open(DoorState $door);

    public function close(DoorState $door);
}

class OpenedState implements State
{
    public function open(DoorState $door): Exception
    {
        throw new \Exception('The door is already opened');
    }

    public function close(DoorState $door): void
    {
        $door->setState(new ClosedState());
    }
}

class ClosedState implements State
{
    public function open(DoorState $door): void
    {
        $door->setState(new OpenedState());
    }

    public function close(DoorState $door): Exception
    {
        throw new \Exception('The door is already closed');
    }
}

$door = new Door(new ClosedState());

$door->open();

$door->close();
try {
    $door->close();
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

$door->open();

try {
    $door->open();
} catch (\Exception $e) {
    echo $e->getMessage();
}