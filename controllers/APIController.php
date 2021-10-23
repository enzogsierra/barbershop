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
        $valid = true;

        // Verificar sesion
        if(!(isset($_SESSION["logged"]) && $_SESSION["logged"] == true)) 
        {
            sendResponse(401);
        }


        // Fecha
        $date = $_POST["date"] ?? null;

        if(strlen($date) != 10) $valid = false; // yyyy-mm-dd
        else 
        {
            $tmp = explode("-", $date, 3); // Dividir la fecha en 3 arrays
            $m = $tmp[1] ?? -1;
            $d = $tmp[2] ?? -1;
            $y = $tmp[0] ?? -1;

            if(!checkdate($m, $d, $y)) $valid = false; // Fecha válida
            else if(!isDateInRange("$y-$m-$d")) $valid = false; // Fecha en un rango +1 día / +1 mes
        }

        if(!$valid) sendResponse(400);


        // Hora
        $time = $_POST["time"] ?? null;

        if(strlen($time) != 5) $valid = false; // hh:mm
        else
        {
            $tmp = explode(":", $time, 2);
            $h = $tmp[0] ?? -1;
            $t = $tmp[1] ?? -1;

            if(!($h >= 8 && $h <= 21)) $valid = false;
            if(!($t >= 0 && $t <= 59)) $valid = false;
        }

        if(!$valid) sendResponse(400);


        // Servicios
        $services = $_POST["services"] ?? null;

        if(!strlen($services) || strlen($services) >= 255) $valid = false;
        else
        {
            $tmp = explode(",", $services, 80); // Dividir los servicios hasta en 80 arrays
            $services = []; // Limpiar los servicios para asignarles enteros

            for($i = 0; $i < count($tmp); $i++)
            {
                if($services[] = filter_var($tmp[$i], FILTER_VALIDATE_INT)) continue; // Servicio valido
                else // Formato no válido
                {
                    $services = [];
                    $valid = false;
                    break;
                }
            }
        }

        if(!$valid) sendResponse(400);


        // Guardar cita
        $date = new Date(
        [
            "date" => $date,
            "time" => $time,
            "services" => join(",", $services),
            "userId" => $_SESSION["id"] ?? 0
        ]);
        if(!$date->save()) sendResponse(500);


        // OK
        sendResponse(200);      
    }
}


function sendResponse($code)
{
    echo json_encode(["response" => $code]);
    exit;
}
