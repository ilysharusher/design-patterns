<?php

// Could also be called "Cursor", but that's not a recommended name for this pattern
// This realization is more flexible and fits the SRP principle

interface IIterator
{
    public function hasNext(): bool;

    public function next(): Item;
}

class CollectionIterator implements IIterator
{
    private int $index = 0;

    public function __construct(
        private array $list
    ) {
    }

    public function hasNext(): bool
    {
        return $this->index < count($this->list);
    }

    public function next(): Item
    {
        return $this->list[$this->index++];
    }
}

interface ICollection
{
    public function add(Item $item): void;

    public function getCollectionIterator(): IIterator;
}

class Collection implements ICollection
{
    private array $list = [];

    public function add(Item $item): void
    {
        $this->list[] = $item;
    }

    public function getCollectionIterator(): IIterator
    {
        return new CollectionIterator($this->list);
    }
}

abstract class Item
{
    public function __construct(
        private string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class ItemA extends Item
{
}

class ItemB extends Item
{
}

$collection = new Collection();
$collection->add(new ItemA('Item A1'));
$collection->add(new ItemB('Item B1'));

$iterator = $collection->getCollectionIterator();

while ($iterator->hasNext()) {
    $item = $iterator->next();
    echo $item->getName() . PHP_EOL;
}