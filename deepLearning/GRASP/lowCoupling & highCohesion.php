<?php

trait Time
{
    public function getTime(): string
    {
        return date('Y-m-d H:i:s');
    }
}

trait Temperature
{
    public function getTemperature(): float
    {
        return 20.0;
    }
}

class WeatherStation
{
    use Time;
    use Temperature;

    public function getWeatherReport(): string
    {
        return "The temperature is " . $this->getTemperature() . "°C at " . $this->getTime();
    }
}

$weatherStation = new WeatherStation();
echo $weatherStation->getWeatherReport();