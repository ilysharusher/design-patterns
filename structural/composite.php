<?php

interface Renderable
{
    public function render(): string;
}

class Mail implements Renderable
{
    private array $parts = [];

    public function addPart(Renderable $part): void
    {
        $this->parts[] = $part;
    }

    public function render(): string
    {
        $output = '';

        foreach ($this->parts as $part) {
            $output .= $part->render();
        }

        return $output;
    }
}

abstract class Text
{
    public function __construct(
        protected string $text
    ) {
    }

    public function getText(): string
    {
        return $this->text . PHP_EOL;
    }
}

class Header extends Text implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

class Body extends Text implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

class Footer extends Text implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

$mail = new Mail();

$mail->addPart(new Header('Header'));
$mail->addPart(new Body('Body'));
$mail->addPart(new Footer('Footer'));

echo $mail->render();