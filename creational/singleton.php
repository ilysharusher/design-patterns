<?php

final class Connection
{
    private static self $instance;
    public static string $name;

    public function __clone(): void
    {
    }

    public function __wakeup(): void
    {
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getName(): string
    {
        return self::$name;
    }

    public static function setName(string $name): void
    {
        self::$name = $name;
    }
}

$connection1 = Connection::getInstance();
$connection1::setName('First Connection');
echo $connection1::getName() . PHP_EOL;

$connection2 = Connection::getInstance();
$connection2::setName('Second Connection');
echo $connection1::getName() . PHP_EOL;
echo $connection2::getName() . PHP_EOL;