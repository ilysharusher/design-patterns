<?php

interface Definer
{
    public function define($argument): string;
}

class Data
{
    private int|string|bool $argument;

    public function __construct(
        private Definer $definer
    ) {
    }

    public function setArgument(bool|int|string $argument): void
    {
        $this->argument = $argument;
    }

    public function defineArgument(): string
    {
        return $this->definer->define($this->argument);
    }
}

class IntDefiner implements Definer
{
    public function define($argument): string
    {
        return $argument . ' is int';
    }
}

class StringDefiner implements Definer
{
    public function define($argument): string
    {
        return $argument . ' is string';
    }
}

class BoolDefiner implements Definer
{
    public function define($argument): string
    {
        return $argument . ' is bool';
    }
}

$data = new Data(new IntDefiner());
$data->setArgument(1);
echo $data->defineArgument() . PHP_EOL;

$data = new Data(new StringDefiner());
$data->setArgument('hello');
echo $data->defineArgument() . PHP_EOL;

$data = new Data(new BoolDefiner());
$data->setArgument(true);
echo $data->defineArgument() . PHP_EOL;