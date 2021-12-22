<?php


namespace App\Repositories;


use App\Models\Collections\WeathersStation1Collection;
use App\Models\WeatherStation1;
use App\Repositories\WeatherRepositoryInterface;

class JSONWeatherRepository implements WeatherRepositoryInterface
{

    private WeathersStation1Collection $weathers;

    private array $location;

    public function __construct()
    {


        $str = file_get_contents('WeatherData/' . date("d-m-Y") . '.json');
        $data = json_decode($str, true);

        $weathers = [];

        $this->location = $data['location'];


        foreach ($data['forecast']['forecasthourly'] as $row) {


            $weathers[] = new WeatherStation1(
                $row['time'],
                $row['wind'],
                $row['temp_f'],
                $row['humidity'],
                $row['rain'],
                $row['light'],
                $row['battery_lvl']
            );

        }
        $this->weathers = new WeathersStation1Collection($weathers);

    }

    public function getAll(): WeathersStation1Collection
    {

        return $this->weathers;

    }

    public function getByIndex(int $index): ?array
    {

        if (array_key_exists($index, $this->weathers->toArray())) {
            return $this->weathers->toArray()[$index];
        }

        return NULL;


    }

    public function getLocation(): array
    {
        return $this->location;
    }


}
