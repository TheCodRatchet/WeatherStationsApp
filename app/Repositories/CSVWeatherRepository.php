<?php


namespace App\Repositories;

use App\Models\Collections\WeathersStation2Collection;
use App\Models\WeatherStation2;
use App\Repositories\WeatherRepositoryInterface;
use League\Csv\Reader;
use League\Csv\Statement;

class CSVWeatherRepository implements WeatherRepositoryInterface
{


    private WeathersStation2Collection $weathers;
    private array $location;

    public function __construct()
    {
        $stream = fopen('WeatherData/' . date("d-m-Y") . '.csv', 'r');
        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        $stmt = Statement::create();

        $weathers = [];
        $records = $stmt->process($csv);
        $location = [];
        foreach ($records as $row) {
            $weathers[] = new WeatherStation2(
                $row['time'],
                $row['wind'],
                $row['temp_c'],
                $row['humidity'],
                $row['rain'],
                $row['light'],
                $row['battery_lvl']
            );

            if (empty($location)) {

                $location = [$row['country'], $row['city']];

            }
        }
        $this->weathers = new WeathersStation2Collection($weathers);
        $this->location = $location;

    }

    public function getAll(): WeathersStation2Collection
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
