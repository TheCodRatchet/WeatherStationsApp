<?php

namespace App\Models\Collections;

use App\Models\WeatherStation1;

class WeathersStation1Collection implements WeatherCollectionInterface
{

    private array $forecast;

    public function __construct(array $weathers)
    {
        foreach ($weathers as $weather) {
            if ($weather instanceof WeatherStation1) {
                $this->forecast[] = $weather;
            }
        }
    }

    public function getForecast(): array
    {
        return $this->forecast;
    }

    public function toArray(bool $metric = false): array
    {

        $weathers = [];

        foreach ($this->forecast as $item) {
            $weathers[] = $item->toArray($metric);
        }

        return $weathers;

    }

}