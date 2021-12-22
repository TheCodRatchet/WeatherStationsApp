<?php

namespace App\Models\Collections;

use App\Models\WeatherStation2;

class WeathersStation2Collection implements WeatherCollectionInterface
{

    private array $forecast;

    public function __construct(array $weathers)
    {
        foreach ($weathers as $weather) {
            if ($weather instanceof WeatherStation2) {
                $this->forecast[] = $weather;
            }
        }
    }

    public function getForecast(): array
    {
        return $this->forecast;
    }

    public function toArray(): array
    {

        $weathers = [];

        foreach ($this->forecast as $item) {
            $weathers[] = $item->toArray();
        }

        return $weathers;

    }

}
