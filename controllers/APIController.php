<?php
namespace Controllers;

use Model\Date;
use Model\Service;

class APIController
{
    public static function index()
    {
        echo json_encode(Service::all());
    }

    public static function bookDate()
    {
        echo json_encode($_POST);
        exit;

        $response_code = 0;

        $userId = $_SESSION["id"];

        // Verificar datos de sesion y formulario
        if(!(isset($_SESSION["logged"]) && $_SESSION["logged"] == true)) $response_code = 401;
      


        if($_SESSION["id"] == $_POST["userId"]) echo "bien ahi capo";
        else echo "tramposo de mierda!!";
        exit;

        echo json_encode($_POST);
        


        /*$date = new Date($_POST);
        echo var_dump($date);
        exit;


        $date = new Date($_POST);
        $response = $date->save();
        echo json_encode(["success" => $response]);*/
    }
}

function isDateInRange($date)
{
    $val = strtotime($date);
    $min = strtotime("now");
    $max = strtotime("+1 month");

    return ($val >= $min && $val <= $max);
}