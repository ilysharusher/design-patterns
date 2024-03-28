<?php

// This pattern violates the Single Responsibility Principle (SRP) because it requires creating a new class for each command.
// Also, it violates the OOP principle because it is more like a procedural code than an object-oriented one, which wrapped in an object to save the state.

class Invoker
{
    private array $list_undo = [];
    private array $list_redo = [];

    public function runCommand(Command $command): string
    {
        $this->list_undo[] = $command;

        return $command->execute();
    }

    public function undo(): string
    {
        if (empty($this->list_undo)) {
            return 'Nothing to undo';
        }

        $command = array_pop($this->list_undo);
        $this->list_redo[] = $command;

        return $command->undo();
    }

    public function redo(): string
    {
        if (empty($this->list_redo)) {
            return 'Nothing to redo';
        }

        $command = array_pop($this->list_redo);
        $this->list_undo[] = $command;

        return $command->execute();
    }
}

class Receiver
{
    public function draw(): string
    {
        return 'Drawing';
    }

    public function undoDraw(): string
    {
        return 'Undo drawing';
    }

    public function fill(): string
    {
        return 'Filling';
    }

    public function undoFill(): string
    {
        return 'Undo filling';
    }
}

abstract class Command
{
    public function __construct(
        protected Receiver $receiver
    ) {
    }

    abstract public function execute(): string;

    abstract public function undo(): string;
}

class DrawCommand extends Command
{
    public function execute(): string
    {
        return $this->receiver->draw();
    }

    public function undo(): string
    {
        return $this->receiver->undoDraw();
    }
}

class FillCommand extends Command
{
    public function execute(): string
    {
        return $this->receiver->fill();
    }

    public function undo(): string
    {
        return $this->receiver->undoFill();
    }
}

$invoker = new Invoker();
$receiver = new Receiver();

echo $invoker->runCommand(new DrawCommand($receiver)) . PHP_EOL;
echo $invoker->runCommand(new FillCommand($receiver)) . PHP_EOL;

echo $invoker->undo() . PHP_EOL;
echo $invoker->redo() . PHP_EOL;