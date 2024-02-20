<?php

abstract class Task
{
    public function printSections(): void
    {
        $this->printHeader();
        $this->printBody();
        $this->printFooter();
        $this->printCustom();
    }

    private function printHeader(): void
    {
        echo "Default Header\n";
    }

    private function printBody(): void
    {
        echo "Default Body\n";
    }

    private function printFooter(): void
    {
        echo "Default Footer\n";
    }

    abstract protected function printCustom();
}

class DeveloperTask extends Task
{
    protected function printCustom(): void
    {
        echo "Developer Custom\n\n";
    }
}

class DesignerTask extends Task
{
    protected function printCustom(): void
    {
        echo "Designer Custom\n\n";
    }
}

$developerTask = new DeveloperTask();
$developerTask->printSections();

$designerTask = new DesignerTask();
$designerTask->printSections();