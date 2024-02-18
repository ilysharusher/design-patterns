<?php

interface Specification
{
    public function isNormal(Student $student): bool;
}

class Student
{
    public function __construct(
        private int $score
    ) {
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }
}

class NormalScoreSpecification implements Specification
{
    public function __construct(
        private int $minimumScore
    ) {
    }

    public function isNormal(Student $student): bool
    {
        return $student->getScore() >= $this->minimumScore;
    }
}

class AndScoreSpecification implements Specification
{
    private array $specifications;

    public function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isNormal(Student $student): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isNormal($student)) {
                return false;
            }
        }

        return true;
    }
}

class OrScoreSpecification implements Specification
{
    private array $specifications;

    public function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isNormal(Student $student): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isNormal($student)) {
                return true;
            }
        }

        return false;
    }
}

class NotScoreSpecification implements Specification
{
    public function __construct(
        private Specification $specification,
    ) {
    }

    public function isNormal(Student $student): bool
    {
        return !$this->specification->isNormal($student);
    }
}

$student = new Student(80);

$normalScoreSpecification = new NormalScoreSpecification(70);
echo $normalScoreSpecification->isNormal($student) . PHP_EOL;

$andScoreSpecification = new AndScoreSpecification(
    new NormalScoreSpecification(70),
    new NormalScoreSpecification(90),
);
echo $andScoreSpecification->isNormal($student) . PHP_EOL;

$orScoreSpecification = new OrScoreSpecification(
    new NormalScoreSpecification(70),
    new NormalScoreSpecification(90),
);
echo $orScoreSpecification->isNormal($student) . PHP_EOL;

$notScoreSpecification = new NotScoreSpecification(
    new NormalScoreSpecification(70),
);
echo $notScoreSpecification->isNormal($student);