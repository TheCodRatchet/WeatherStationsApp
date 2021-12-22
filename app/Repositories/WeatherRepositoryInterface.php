<?php

namespace App\Repositories;


use App\Models\Collections\WeatherCollectionInterface;

interface WeatherRepositoryInterface
{

    public function getAll(): WeatherCollectionInterface;

    public function getByIndex(int $index);

    public function getLocation(): array;

}
