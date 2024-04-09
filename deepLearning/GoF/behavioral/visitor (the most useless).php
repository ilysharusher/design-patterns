<?php

// This pattern is recommended to use only when you tried everything else and nothing worked.
// The best alternative for this pattern is to use a bridge pattern. Bridge pattern is a more flexible and powerful pattern.

interface Element
{
    public function accept(Visitor $visitor): void;
}

class ElementA implements Element
{
    public function accept(Visitor $visitor): void
    {
        $visitor->visitA($this);
    }
}

class ElementB implements Element
{
    public function accept(Visitor $visitor): void
    {
        $visitor->visitB($this);
    }
}

interface Visitor
{
    public function visitA(ElementA $element): void;

    public function visitB(ElementB $element): void;
}

class Operation1 implements Visitor
{
    public function visitA(ElementA $element): void
    {
        echo 'Operation1 visited ElementA' . PHP_EOL;
    }

    public function visitB(ElementB $element): void
    {
        echo 'Operation1 visited ElementB' . PHP_EOL;
    }
}

class Operation2 implements Visitor
{
    public function visitA(ElementA $element): void
    {
        echo 'Operation2 visited ElementA' . PHP_EOL;
    }

    public function visitB(ElementB $element): void
    {
        echo 'Operation2 visited ElementB' . PHP_EOL;
    }
}

$elementA = new ElementA();
$elementB = new ElementB();

$operation1 = new Operation1();
$operation2 = new Operation2();

$elementA->accept($operation1);
$elementA->accept($operation2);

$elementB->accept($operation1);
$elementB->accept($operation2);