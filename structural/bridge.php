<?php

interface Formatter
{
    public function format(string $text): string;
}

class PlainTextFormatter implements Formatter
{
    public function format(string $text): string
    {
        return $text;
    }
}

class HtmlFormatter implements Formatter
{
    public function format(string $text): string
    {
        return "<p>$text</p>";
    }
}

abstract class BridgeService
{
    public function __construct(
        protected Formatter $formatter
    ) {
    }

    abstract public function show(string $text): string;
}

class BridgeServiceA extends BridgeService
{
    public function show(string $text): string
    {
        return $this->formatter->format($text);
    }
}

class BridgeServiceB extends BridgeService
{
    public function show(string $text): string
    {
        return $this->formatter->format($text);
    }
}

$serviceA = new BridgeServiceA(new PlainTextFormatter());
echo $serviceA->show('Hello, World!');