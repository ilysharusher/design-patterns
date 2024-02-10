<?php

interface NativeDeveloper
{
    public function countSalary(): int;
}

interface RemoteDeveloper
{
    public function countSalaryByHour(int $hour): int;
}

class NativeDeveloperImpl implements NativeDeveloper
{
    public function countSalary(): int
    {
        return 5000;
    }
}

class RemoteDeveloperImpl implements RemoteDeveloper
{
    public function countSalaryByHour(int $hour): int
    {
        return 30 * $hour;
    }
}

class RemoteDeveloperAdapter implements NativeDeveloper
{
    public function __construct(
        private RemoteDeveloper $remoteDeveloper
    ) {
    }

    public function countSalary(): int
    {
        return $this->remoteDeveloper->countSalaryByHour(160);
    }
}

$nativeDeveloper = new NativeDeveloperImpl();
$remoteDeveloper = new RemoteDeveloperImpl();

$remoteDeveloperAdapter = new RemoteDeveloperAdapter($remoteDeveloper);
echo $remoteDeveloperAdapter->countSalary();