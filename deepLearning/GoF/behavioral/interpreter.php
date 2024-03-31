<?php

// This pattern is very similar to the Composite pattern, but it is used for a different purpose.

class Context
{
    public function __construct(
        private string $input
    ) {
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function setInput(string $input): void
    {
        $this->input = $input;
    }
}

interface Expression
{
    public function interpret(Context $context): string;
}

class TerminalExpression implements Expression
{
    public function interpret(Context $context): string
    {
        return 'TerminalExpression on ' . spl_object_id($context);
    }
}

class NonTerminalExpression implements Expression
{
    public function __construct(
        private array $expressions
    ) {
    }

    public function interpret(Context $context): string
    {
        $result = 'NonTerminalExpression on ' . spl_object_id($context) . PHP_EOL;

        foreach ($this->expressions as $expression) {
            $result .= $expression->interpret($context) . PHP_EOL;
        }

        return $result;
    }
}

class UserInput
{
    public function __construct(
        private string $input
    ) {
    }

    public function parse(): string
    {
        $context = new Context($this->input);
        $expressions = [];

        for ($i = 0; $i < strlen($this->input); $i++) {
            $expressions[] = new TerminalExpression();
        }

        $nonTerminalExpression = new NonTerminalExpression($expressions);
        return $nonTerminalExpression->interpret($context);
    }
}

$userInput = new UserInput('Hello, World!');
echo $userInput->parse();