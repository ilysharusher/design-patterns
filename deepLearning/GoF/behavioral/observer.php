<?php

// Could also be called "Listener"
// It's challenging to build a big GUI application without using this pattern
// This one is alternative to the "Mediator" pattern with some differences

interface Observer
{
    public function update(string $state): void;
}

class FirstObserver implements Observer
{
    public function update(string $state): void
    {
        echo 'Updated by FirstObserver with state: ' . $state . PHP_EOL;
    }
}

class SecondObserver implements Observer
{
    public function update(string $state): void
    {
        echo 'Updated by SecondObserver with state: ' . $state . PHP_EOL;
    }
}

interface Subject
{
    public function addObserver(Observer $observer): void;

    public function removeObserver(Observer $observer): void;
}

class RSubject implements Subject
{
    private string $state;
    private array $observers = [];

    public function addObserver(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(Observer $observer): void
    {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function setState(string $state): void
    {
        $this->state = $state;
        $this->notify();
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->state);
        }
    }
}

$firstObserver = new FirstObserver();
$secondObserver = new SecondObserver();

$subject = new RSubject();
$subject->addObserver($firstObserver);
$subject->addObserver($secondObserver);

$subject->setState('state1');

$subject->removeObserver($firstObserver);

$subject->setState('state2');
