<?php

interface Element
{
    public function increment(): void;
}

class Node implements Element
{
    private array $elements = [];

    public function __construct(
        private int $value
    ) {
    }

    public function add(Element $element): void
    {
        $this->elements[] = $element;
    }

    public function increment(): void
    {
        $this->value++;

        foreach ($this->elements as $child) {
            $child->increment();
        }
    }
}

class Leaf implements Element
{
    public function __construct(
        private int $value
    ) {
    }

    public function increment(): void
    {
        $this->value++;
    }
}

$node = new Node(1);
$node->add(new Leaf(2));
$node->add(new Leaf(3));
$node->add(new Leaf(4));

$node->increment();
var_dump($node);
