<?php

interface AbstractFactory
{
    public static function createDeveloper(): Developer;
    public static function createTester(): Tester;
}

class OutsourceFactory implements AbstractFactory
{
    public static function createDeveloper(): Developer
    {
        return new OutsourceDeveloper();
    }

    public static function createTester(): Tester
    {
        return new OutsourceTester();
    }
}

class NativeFactory implements AbstractFactory
{
    public static function createDeveloper(): Developer
    {
        return new NativeDeveloper();
    }

    public static function createTester(): Tester
    {
        return new NativeTester();
    }
}

interface Worker
{
    public static function work(): string;
}

interface Developer extends Worker
{
}

interface Tester extends Worker
{
}

class OutsourceDeveloper implements Developer
{
    public static function work(): string
    {
        return 'Outsource developer is working';
    }
}

class NativeDeveloper implements Developer
{
    public static function work(): string
    {
        return 'Native developer is working';
    }
}

class OutsourceTester implements Tester
{
    public static function work(): string
    {
        return 'Outsource tester is working';
    }
}

class NativeTester implements Tester
{
    public static function work(): string
    {
        return 'Native tester is working';
    }
}

$outsourceDeveloper = OutsourceFactory::createDeveloper();
$nativeDeveloper = NativeFactory::createDeveloper();
$outsourceTester = OutsourceFactory::createTester();
$nativeTester = NativeFactory::createTester();

echo $outsourceDeveloper::work() . PHP_EOL;
echo $nativeDeveloper::work() . PHP_EOL;
echo $outsourceTester::work() . PHP_EOL;
echo $nativeTester::work() . PHP_EOL;