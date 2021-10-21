<?php
namespace Controllers;

use Model\Service;

class APIController
{
    public static function index()
    {
        echo json_encode(Service::all());
    }

    public static function bookDate()
    {
        $response =
        [
            "data" => $_POST
        ];
        
        echo json_encode($response);
    }
}