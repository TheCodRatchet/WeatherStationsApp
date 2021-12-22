<?php


namespace App\Models;

class WeatherStation2
{

    private string $time;
    private float $temp_c;
    private int $humidity;
    private int $rain;
    private int $light;
    private int $batteryLvl;
    private float $wind;

    public function __construct(string $time, float $temp_c, int $humidity, int $rain, int $light, int $batteryLvl, float $wind)
    {

        $this->time = $time;
        $this->temp_c = $temp_c;
        $this->humidity = $humidity;
        $this->rain = $rain;
        $this->light = $light;
        $this->batteryLvl = $batteryLvl;
        $this->wind = $wind;
    }


    public function getTime(): string
    {
        return $this->time;
    }

    public function getWind(): float
    {
        return $this->wind;
    }

    public function getTempC(): float
    {
        return $this->temp_c;
    }


    public function getHumidity(): int
    {
        return $this->humidity;
    }


    public function getRain(): int
    {
        return $this->rain;
    }


    public function getLight(): int
    {
        return $this->light;
    }


    public function getBatteryLvl(): int
    {
        return $this->batteryLvl;
    }

    public function toArray(): array
    {

        return [
            'time' => $this->getTime(),
            'temp_c' => $this->getTempC(),
            'humidity' => $this->getHumidity(),
            'rain' => $this->getRain(),
            'wind' => $this->getWind(),
            'light' => $this->getLight(),
            'battery_lvl' => $this->getBatteryStatus($this->getBatteryLvl())
        ];

    }

    private function getBatteryStatus(int $battery): string
    {

        switch ($battery) {
            case 100:
                return 'full';
                break;
            case $battery <= 25:
                return 'low';
                break;
            case $battery >= 75:
                return 'high';
                break;
            case $battery > 25 && $battery < 75:
                return 'medium';
                break;
            default:
                return 'unknown level';
                break;
        }

    }

}