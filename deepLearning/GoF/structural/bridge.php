<?php

abstract class Report
{
    public function __construct(
        protected Output $output
    ) {
    }

    public function getSummary(string $report): string
    {
        return $this->output->load($report);
    }
}

class DayReport extends Report
{
}

class WeekReport extends Report
{
}

class MonthReport extends Report
{
}

interface Output
{
    public function load(string $report): string;
}

class WordOutput implements Output
{
    public function load(string $report): string
    {
        return "Word: $report";
    }
}

class ExcelOutput implements Output
{
    public function load(string $report): string
    {
        return "Excel: $report";
    }
}

class JsonOutput implements Output
{
    public function load(string $report): string
    {
        return "Json: $report";
    }
}

$dayReport = new DayReport(new WordOutput());
echo $dayReport->getSummary('Day summary') . PHP_EOL;

$weekReport = new WeekReport(new ExcelOutput());
echo $weekReport->getSummary('Week summary') . PHP_EOL;

$monthReport = new MonthReport(new JsonOutput());
echo $monthReport->getSummary('Month summary');