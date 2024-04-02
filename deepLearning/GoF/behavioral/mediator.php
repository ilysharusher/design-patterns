<?php

interface Mediator
{
    public function notify(IButton $button): void;
}

class ButtonMediator implements Mediator
{
    public function __construct(
        private OpenButton $openButton,
        private CloseButton $closeButton
    ) {
    }

    public function notify(IButton $button): void
    {
        if ($button instanceof OpenButton) {
            $this->openButton->changeState(false);
            $this->closeButton->changeState(true);
        } elseif ($button instanceof CloseButton) {
            $this->openButton->changeState(true);
            $this->closeButton->changeState(false);
        }
    }
}

interface IButton
{
    public function changeState(bool $state): void;

    public function click(Mediator $mediator): void;
}

class OpenButton implements IButton
{
    private bool $isEnable;

    public function changeState(bool $state): void
    {
        $this->isEnable = $state;
    }

    public function isEnable(): bool
    {
        return $this->isEnable;
    }

    public function click(Mediator $mediator): void
    {
        $mediator->notify($this);
    }
}

class CloseButton implements IButton
{
    private bool $isEnable;

    public function changeState(bool $state): void
    {
        $this->isEnable = $state;
    }

    public function isEnable(): bool
    {
        return $this->isEnable;
    }

    public function click(Mediator $mediator): void
    {
        $mediator->notify($this);
    }
}

$openButton = new OpenButton();
$closeButton = new CloseButton();

$mediator = new ButtonMediator($openButton, $closeButton);

$openButton->click($mediator);

echo $openButton->isEnable() . PHP_EOL;
echo $closeButton->isEnable() . PHP_EOL;

$closeButton->click($mediator);

echo $openButton->isEnable() . PHP_EOL;
echo $closeButton->isEnable();