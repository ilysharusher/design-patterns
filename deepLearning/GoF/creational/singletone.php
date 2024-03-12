<?php

final class Singleton
{
    private static ?self $instance = null;
    private string $value;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}

$singleton = Singleton::getInstance();
$singleton->setValue('First value');

$singleton2 = Singleton::getInstance();
echo $singleton2->getValue();