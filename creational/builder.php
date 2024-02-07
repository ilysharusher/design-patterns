<?php

class Operator
{
    public function build(Builder $builder): Message
    {
        $builder->make();
        $builder->makeHeader();
        $builder->makeBody();
        $builder->makeFooter();

        return $builder->getResult();
    }
}

interface Builder
{
    public function makeHeader();

    public function makeBody();

    public function makeFooter();

    public function getResult();
}

class TextBuilder implements Builder
{
    private Message $message;

    public function make(): void
    {
        $this->message = new Message();
    }

    public function makeHeader(): void
    {
        $this->message->setPart(new Header('Text header'));
    }

    public function makeBody(): void
    {
        $this->message->setPart(new Body('Text body'));
    }

    public function makeFooter(): void
    {
        $this->message->setPart(new Footer('Text footer'));
    }

    public function getResult(): Message
    {
        return $this->message;
    }
}

class Section
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->text;
    }
}

class Header extends Section
{
}

class Body extends Section
{
}

class Footer extends Section
{
}

class Message
{
    private string $message = '';

    public function setPart($message): void
    {
        $this->message .= $message . PHP_EOL;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}

$operator = new Operator();

$builder = new TextBuilder();
$builder->make();

$message = $operator->build($builder);
echo $message->getMessage();