<?php

abstract class Expression
{
    abstract public function interpret(Context $context): bool;
}

class Context
{
    private array $variables = [];

    public function setVariables(string $variables): void
    {
        $this->variables[] = $variables;
    }

    public function lookup(string $name): string|null
    {
        return $this->variables[$name] ?? null;
    }
}

class VariableExpression extends Expression
{
    public function __construct(
        private int $key
    ) {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookup($this->key);
    }
}

class AndExpression extends Expression
{
    public function __construct(
        private int $expr1,
        private int $expr2
    ) {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookup($this->expr1) && $context->lookup($this->expr2);
    }
}

class OrExpression extends Expression
{
    public function __construct(
        private int $expr1,
        private int $expr2
    ) {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookup($this->expr1) || $context->lookup($this->expr2);
    }
}

$context = new Context();
$context->setVariables('x');
$context->setVariables('y');

$variableExpression = new VariableExpression(1);
$andExpression = new AndExpression(1, 3);
$orExpression = new OrExpression(1, 3);

echo $variableExpression->interpret($context) . PHP_EOL;
echo $andExpression->interpret($context) . PHP_EOL;
echo $orExpression->interpret($context);