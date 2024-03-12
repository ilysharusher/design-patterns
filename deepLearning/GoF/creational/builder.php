<?php

class Director
{
    public function __construct(
        private Builder $builder
    ) {
    }

    public function buildDisplay(): string
    {
        return $this->builder->buildDisplay();
    }

    public function buildWindow(): string
    {
        return $this->builder->buildWindow();
    }

    public function buildButton(): string
    {
        return $this->builder->buildButton();
    }
}

interface Builder
{
    public function buildDisplay();

    public function buildWindow();

    public function buildButton();
}

class WindowsBuilder implements Builder
{
    public function buildDisplay(): string
    {
        return 'Windows display';
    }

    public function buildWindow(): string
    {
        return 'Windows window';
    }

    public function buildButton(): string
    {
        return 'Windows button';
    }
}

class MacBuilder implements Builder
{
    public function buildDisplay(): string
    {
        return 'Mac display';
    }

    public function buildWindow(): string
    {
        return 'Mac window';
    }

    public function buildButton(): string
    {
        return 'Mac button';
    }
}

$os = 'mac';

if ($os === 'windows') {
    $windowsBuilder = new WindowsBuilder();
    $director = new Director($windowsBuilder);
} else {
    $macBuilder = new MacBuilder();
    $director = new Director($macBuilder);
}

echo $director->buildDisplay() . PHP_EOL;
echo $director->buildWindow() . PHP_EOL;
echo $director->buildButton();