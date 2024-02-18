<?php

abstract class Handler
{
    private ?Handler $successor;

    public function __construct(?Handler $handler)
    {
        $this->successor = $handler;
    }

    final public function handle(TaskInterface $task): ?array
    {
        $processed = $this->processing($task);

        if ($processed === null && $this->successor) {
            $processed = $this->successor->handle($task);
        }

        return $processed;
    }

    abstract public function processing(TaskInterface $task): ?array;
}

interface TaskInterface
{
    public function getArray(): array;
}

class DevTask implements TaskInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getArray(): array
    {
        return $this->data;
    }
}

class Senior extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return $task->getArray();
    }
}

class Middle extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

class Junior extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

$dev = new DevTask(['name' => 'John', 'age' => 25]);

$senior = new Senior(null);
$middle = new Middle($senior);
$junior = new Junior($middle);

var_dump($junior->handle($dev));