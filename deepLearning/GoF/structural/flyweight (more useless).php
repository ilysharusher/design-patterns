<?php

class SharedUnit
{
    public function __construct(
        protected string $unitType,
        protected string $texture,
        protected int $geometry,
        protected int $attack,
        protected int $defense
    ) {
    }
}

class ConcreteUnit
{
    public function __construct(
        private int $id,
        private SharedUnit $sharedUnit,
        private array $coordinates,
        private int $health
    ) {
    }

    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }
}

class UnitFactory
{
    private array $sharedUnitInfos = [];
    private array $concreteUnits = [];

    public function addSharedUnit(string $unitType, string $texture, int $geometry, int $attack, int $defense): void
    {
        $this->sharedUnitInfos[$unitType] = new SharedUnit($unitType, $texture, $geometry, $attack, $defense);
    }

    public function addConcreteUnit(int $id, SharedUnit $sharedUnitInfo, array $coordinates, int $health): void
    {
        $this->concreteUnits[$id] = new ConcreteUnit($id, $sharedUnitInfo, $coordinates, $health);
    }

    public function getSharedUnit(string $unitType): ?SharedUnit
    {
        return $this->sharedUnitInfos[$unitType] ?? null;
    }

    public function getConcreteUnit(int $id): ?ConcreteUnit
    {
        return $this->concreteUnits[$id] ?? null;
    }
}

$factory = new UnitFactory();

$factory->addSharedUnit('tank', 'tank.png', 3, 5, 7);
$factory->addSharedUnit('soldier', 'soldier.png', 1, 2, 3);

$sharedUnit1 = $factory->getSharedUnit('tank');
$sharedUnit2 = $factory->getSharedUnit('soldier');

$factory->addConcreteUnit(1, $sharedUnit1, [1, 2], 100);
$factory->addConcreteUnit(2, $sharedUnit2, [3, 4], 100);

$unit1 = $factory->getConcreteUnit(1);
$unit2 = $factory->getConcreteUnit(2);

$unit1->setCoordinates([3, 4]);
$unit2->setHealth(50);

var_dump($unit1, $unit2);
