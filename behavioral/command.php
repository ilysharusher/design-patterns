<?php

interface Command
{
    public function execute();
}

interface UndoableCommand extends Command
{
    public function undo();
}

class Output
{
    private string $text = '';
    private bool $switcher = true;

    public function getText(): string
    {
        return $this->text;
    }

    public function enable(): void
    {
        $this->switcher = true;
    }

    public function disable(): void
    {
        $this->switcher = false;
    }

    public function write(string $text): void
    {
        if ($this->switcher) {
            $this->text = $text;
        }
    }
}

class Invoker
{
    private Command $command;

    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }

    public function run(): void
    {
        $this->command->execute();
    }
}

class Message implements Command
{
    public function __construct(
        private Output $output
    ) {
    }

    public function execute(): void
    {
        $this->output->write('Hello World');
    }
}

class SwitchStatus implements UndoableCommand
{
    public function __construct(
        private Output $output
    ) {
    }

    public function execute(): void
    {
        $this->output->enable();
    }

    public function undo(): void
    {
        $this->output->disable();
    }
}

$output = new Output();
$invoker = new Invoker();

$message = new Message($output);
$message->execute();
echo $output->getText() . PHP_EOL;

$switchStatus = new SwitchStatus($output);
$switchStatus->undo();
$output->write('Hello World');
echo $output->getText() . PHP_EOL;

$switchStatus->execute();
$output->write('Hello World v2');
echo $output->getText() . PHP_EOL;

