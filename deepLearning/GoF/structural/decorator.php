<?php

// This pattern is very hard to break due to his difficulty, as opposed to a bridge pattern, for example.
// Ideal balance between complexity and understanding.

interface AbstractPage
{
    public function render();
}

class Page implements AbstractPage
{
    public function render(): void
    {
        echo 'Some page';
    }
}

abstract class Decorator implements AbstractPage
{
    public function __construct(
        protected AbstractPage $subject
    ) {
    }
}

class NumericDecorator extends Decorator
{
    public function render()
    {
        echo 123 . PHP_EOL;

        return $this->subject->render();
    }
}

class StringDecorator extends Decorator
{
    public function render()
    {
        echo 'Some string' . PHP_EOL;

        return $this->subject->render();
    }
}

$page = new NumericDecorator(
    new StringDecorator(
        new Page()
    )
);

$page->render();