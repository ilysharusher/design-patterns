<?php

abstract class ParentDAO
{
    public function run(): string
    {
        $first = 'First command';
        $second = $this->doAbstract();
        $third = 'Third command';

        return $first . ' ' . $second . ' ' . $third;
    }

    protected function doAbstract(): string
    {
        return '';
    }
}

class FirstDAO extends ParentDAO
{
    protected function doAbstract(): string
    {
        return 'FirstDAO command';
    }
}

class SecondDAO extends ParentDAO
{
    protected function doAbstract(): string
    {
        return 'SecondDAO command';
    }
}

class ThirdDAO extends ParentDAO
{
}

$firstDAO = new FirstDAO();
echo $firstDAO->run() . PHP_EOL;

$secondDAO = new SecondDAO();
echo $secondDAO->run() . PHP_EOL;

$thirdDAO = new ThirdDAO();
echo $thirdDAO->run() . PHP_EOL;