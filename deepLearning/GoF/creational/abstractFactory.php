<?php

interface Window
{
    public function open(): string;
}

class MacWindow implements Window
{
    public function open(): string
    {
        return 'Mac window opened';
    }
}

class WindowsWindow implements Window
{
    public function open(): string
    {
        return 'Windows window opened';
    }
}

interface Button
{
    public function click(): string;
}

class MacButton implements Button
{
    public function click(): string
    {
        return 'Mac button clicked';
    }
}

class WindowsButton implements Button
{
    public function click(): string
    {
        return 'Windows button clicked';
    }
}

interface ScrollBar
{
    public function scroll(): string;
}

class MacScrollBar implements ScrollBar
{
    public function scroll(): string
    {
        return 'Mac scroll bar scrolled';
    }
}

class WindowsScrollBar implements ScrollBar
{
    public function scroll(): string
    {
        return 'Windows scroll bar scrolled';
    }
}

interface AbstractFactory
{
    public function createWindow(): Window;
    public function createButton(): Button;
    public function createScrollBar(): ScrollBar;
}

class MacFactory implements AbstractFactory
{
    public function createWindow(): Window
    {
        return new MacWindow();
    }

    public function createButton(): Button
    {
        return new MacButton();
    }

    public function createScrollBar(): ScrollBar
    {
        return new MacScrollBar();
    }
}

class WindowsFactory implements AbstractFactory
{
    public function createWindow(): Window
    {
        return new WindowsWindow();
    }

    public function createButton(): Button
    {
        return new WindowsButton();
    }

    public function createScrollBar(): ScrollBar
    {
        return new WindowsScrollBar();
    }
}

$os = 'mac';

if ($os === 'mac') {
    $factory = new MacFactory();
} else {
    $factory = new WindowsFactory();
}

$window = $factory->createWindow();
$button = $factory->createButton();
$scrollBar = $factory->createScrollBar();

echo $window->open() . PHP_EOL;
echo $button->click() . PHP_EOL;
echo $scrollBar->scroll() . PHP_EOL;