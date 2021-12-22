<?php


namespace App\Controllers;

use App\Repositories\JSONWeatherRepository\JSONWeatherRepository;
use Exception;

class WeatherStation1Controller
{

    private JSONWeatherRepository $jsonWeatherRepo;

    public function __construct()
    {
        $this->jsonWeatherRepo = new JSONWeatherRepository();
    }

    public function index()
    {

        echo json_encode($this->jsonWeatherRepo->getAll()->toArray());

    }

    public function details(int $index)
    {


        echo json_encode($this->jsonWeatherRepo->getByIndex($index));


    }

}