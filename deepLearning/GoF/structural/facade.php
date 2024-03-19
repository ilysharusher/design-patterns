<?php

interface IFacade
{
    public static function start(): string;
    public static function stop(): string;
}

class Facade implements IFacade
{
    use Car;
    use Bus;

    public static function start(): string
    {
        return self::startCar() . ' and ' . self::startBus();
    }

    public static function stop(): string
    {
        return self::stopCar() . ' and ' . self::stopBus();
    }
}

trait Car
{
    public static function startCar(): string
    {
        return 'Car started';
    }

    public static function stopCar(): string
    {
        return 'Car stopped';
    }
}

trait Bus
{
    public static function startBus(): string
    {
        return 'Bus started';
    }

    public static function stopBus(): string
    {
        return 'Bus stopped';
    }
}

echo Facade::start() . PHP_EOL;
echo Facade::stop() . PHP_EOL;