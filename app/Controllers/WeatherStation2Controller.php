<?php


namespace App\Controllers;

use App\Repositories\CSVWeatherRepository\CSVWeatherRepository;

class WeatherStation2Controller
{

    private CSVWeatherRepository $csvWeatherRepo;

    public function __construct()
    {
        $this->csvWeatherRepo = new CSVWeatherRepository();
    }

    public function index()
    {

        echo json_encode($this->csvWeatherRepo->getAll()->toArray());

    }

    public function details(int $index)
    {


        echo json_encode($this->csvWeatherRepo->getByIndex($index));


    }


}