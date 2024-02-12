<?php

interface Mail
{
    public function render(): string;
}

abstract class TypeMail
{
    public function __construct(
        protected string $type
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }
}

class BusinessMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getType() . ' from business';
    }
}

class PersonalMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getType() . ' from personal';
    }
}

class MailFactory
{
    private array $mails = [];

    public function getMails(): array
    {
        return $this->mails;
    }

    public function getMail(int $id, string $type): Mail
    {
        if (!isset($this->mails[$id])) {
            $this->mails[$id] = match ($type) {
                'business' => new BusinessMail($type),
                'personal' => new PersonalMail($type),
                default => throw new \InvalidArgumentException('Invalid type mail'),
            };
        }

        return $this->mails[$id];
    }
}

$mailFactory = new MailFactory();

$mail1 = $mailFactory->getMail(1, 'business');
$mail2 = $mailFactory->getMail(2, 'personal');
$mail3 = $mailFactory->getMail(3, 'business');

var_dump($mail1->render());

var_dump($mailFactory->getMails());