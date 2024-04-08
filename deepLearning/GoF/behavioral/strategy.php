<?php

// This pattern is very similar to the state pattern

class Context
{
    public function __construct(
        private Strategy $strategy
    ) {
    }

    public function execute(string $string): string
    {
        return $this->strategy->execute($string);
    }
}

interface Strategy
{
    public function execute(string $string): string;
}

class StrategyA implements Strategy
{
    public function execute(string $string): string
    {
        return $string . ' Strategy A';
    }
}

class StrategyB implements Strategy
{
    public function execute(string $string): string
    {
        return $string . ' Strategy B';
    }
}

$context = new Context(new StrategyA());
echo $context->execute('Hello') . PHP_EOL;

$context = new Context(new StrategyB());
echo $context->execute('Hello') . PHP_EOL;