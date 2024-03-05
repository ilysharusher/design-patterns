<?php

enum AnimalRunType: string
{
    case Run = 'Run';
    case Fly = 'Fly';
    case Swim = 'Swim';
}

interface Animal {
    public function makeSound(): string;

    public function run(): AnimalRunType;
}

class Dog implements Animal {

    #[\Override] public function makeSound(): string
    {
        return 'Woof';
    }

    #[\Override] public function run(): AnimalRunType
    {
        return AnimalRunType::Run;
    }
}

class Bird implements Animal {

    #[\Override] public function makeSound(): string
    {
        return 'Chirp Chirp';
    }

    #[\Override] public function run(): AnimalRunType
    {
        return AnimalRunType::Fly;
    }
}

class Fish implements Animal {

    #[\Override] public function makeSound(): string
    {
        return 'Blub Blub';
    }

    #[\Override] public function run(): AnimalRunType
    {
        return AnimalRunType::Swim;
    }
}

class AnimalStart
{
    public function __construct(
        private Animal $animal
    ) {
    }

    public function makeSound(): string
    {
        return $this->animal->makeSound();
    }

    public function run(): AnimalRunType
    {
        return $this->animal->run();
    }
}

$dog = new Dog();
$bird = new Bird();
$fish = new Fish();

$animalStart = new AnimalStart($dog);

echo $animalStart->makeSound() . ' goes ' . $animalStart->run()->value . PHP_EOL;