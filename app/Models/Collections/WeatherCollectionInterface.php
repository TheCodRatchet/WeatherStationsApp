<?php


namespace App\Models\Collections;

interface WeatherCollectionInterface
{

    public function getForecast(): array;

    public function toArray(): array;
}
