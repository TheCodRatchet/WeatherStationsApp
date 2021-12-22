<?php


namespace App\Models;

class WeatherStation1
{

    private string $time;
    private float $temp_f;
    private int $humidity;
    private int $rain;
    private int $light;
    private int $batteryLvl;
    private float $wind;

    public function __construct(string $time, float $temp_f, int $humidity, int $rain, int $light, int $batteryLvl, float $wind)
    {

        $this->time = $time;
        $this->temp_f = $temp_f;
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


    public function getTempF(): float
    {
        return $this->temp_f;
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

    public function getWind(): float
    {
        return $this->wind;
    }

    public function getBatteryLvl(): int
    {
        return $this->batteryLvl;
    }

    public function toArray(bool $metric = false): array
    {

        /*
         * @var bool $metric value true will return weather info converted to metric system
         */

        if (!$metric) {
            return [
                'time' => $this->getTime(),
                'temp_f' => $this->getTempF(),
                'humidity' => $this->getHumidity(),
                'rain' => $this->getRain(),
                'wind' => $this->getWind(),
                'light' => $this->getLight(),
                'battery_lvl' => $this->getBatteryLvl()
            ];
        }
        return [
            'time' => $this->getTime(),
            'temp_f' => ($this->getTempF() - 32) / (9 / 5),
            'humidity' => $this->getHumidity(),
            'wind' => round($this->getWind() * 1.609344, 2),
            'rain' => $this->getRain() * 25.4,
            'light' => $this->getLight(),
            'battery_lvl' => $this->getBatteryLvl()
        ];


    }


}
