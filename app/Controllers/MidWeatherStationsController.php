<?php


namespace App\Controllers;

use App\Models\MidWeatherStation;
use App\Repositories\CSVWeatherRepository\CSVWeatherRepository;
use App\Repositories\JSONWeatherRepository\JSONWeatherRepository;
use App\Repositories\MidWeatherRepository\MidWeatherRepository;
use Exception;

class MidWeatherStationsController
{

    private MidWeatherRepository $midWeatherRepo;

    public function __construct()
    {
        $this->midWeatherRepo = new MidWeatherRepository();
    }

    public function index()
    {

        echo json_encode($this->midWeatherRepo->getAll()->toArray());

    }

    public function details(int $index)
    {


        echo json_encode($this->midWeatherRepo->getByIndex($index));


    }

}
