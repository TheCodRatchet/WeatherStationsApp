<?php


namespace App\Repositories;

use App\Models\Collections\MidWeatherStationCollection;
use App\Models\MidWeatherStation;
use App\Repositories\CSVWeatherRepository;
use App\Repositories\JSONWeatherRepository;
use App\Repositories\WeatherRepositoryInterface;

class MidWeatherRepository implements WeatherRepositoryInterface
{

    private JSONWeatherRepository $jsonWeatherRepo;
    private CSVWeatherRepository $csvWeatherRepo;

    private MidWeatherStationCollection $weathers;

    private array $location;

    public function __construct()
    {
        $this->csvWeatherRepo = new CSVWeatherRepository();
        $this->jsonWeatherRepo = new JSONWeatherRepository();

        $stationA = $this->csvWeatherRepo->getAll()->toArray();
        $stationB = $this->jsonWeatherRepo->getAll()->toArray(true);
        $weathers = [];

        $this->location = $this->jsonWeatherRepo->getLocation();
        for ($i = 0; $i < count($stationA); $i++) {


            $weathers[] = new MidWeatherStation(
                $stationB[$i]['time'],
                ($stationB[$i]['temp_f'] + $stationA[$i]['temp_c']) / 2,
                ($stationA[$i]['humidity'] + $stationA[$i]['humidity']) / 2,
                ($stationA[$i]['rain'] + $stationB[$i]['rain']) / 2,
                $stationA[$i]['light'],
                $stationB[$i]['battery_lvl'],
                ($stationA[$i]['wind'] + $stationB[$i]['wind']) / 2

            );

        }

        $this->weathers = new MidWeatherStationCollection($weathers);


    }

    public function getAll(): MidWeatherStationCollection
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
