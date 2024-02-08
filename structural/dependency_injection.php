<?php

class ControllerConfigurator
{
    private string $class;
    private string $action;

    public function __construct(string $class, string $action)
    {
        $this->class = $class;
        $this->action = $action;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}

class Controller
{
    private ControllerConfigurator $configurator;

    public function __construct(ControllerConfigurator $configurator)
    {
        $this->configurator = $configurator;
    }

    public function run(): string
    {
        $class = $this->configurator->getClass();
        $action = $this->configurator->getAction();

        return "Running $class::$action";
    }
}

$configurator = new ControllerConfigurator('HomeController', 'index');
$controller = new Controller($configurator);
echo $controller->run();