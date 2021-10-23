<?php
namespace Controllers;

use Model\ActiveRecord;
use Model\Date;
use Model\Service;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        // Servicios
        $services = [];
        foreach(Service::all() as $service)
        {
            $services[$service->id] = $service; // Asociar con el id de la cita
        }

        // Citas
        $date = $_GET["date"] ?? date("Y-m-d");
        $check = explode("-", $date, 3);

        // Verificar datos
        if(!ctype_digit($check[0] ?? NAN)) header("Location: /404");
        if(!ctype_digit($check[1] ?? NAN)) header("Location: /404");
        if(!ctype_digit($check[2] ?? NAN)) header("Location: /404");
        if(!checkdate($check[1], $check[2], $check[0])) header("Location: /404");
        
        // Query
        $query = "SELECT dates.*, concat(users.name, ' ', users.surname) as client, users.id as clientId, users.email as email, users.tel as tel FROM dates ";
        $query .= "INNER JOIN users ON userId = users.id ";
        $query .= "WHERE date = '$date' ";
        $query .= "ORDER BY time";
        $dates = ActiveRecord::custom($query);

        $router->render("admin/index",
        [
            "services" => $services,
            "dates" => $dates,
            "filterDate" => $date
        ]);
    }

    public static function services(Router $router)
    {
        $router->render("admin/services",
        [
            "services" => Service::all()
        ]);
    }

    public static function newService()
    {
        $text = trim($_POST["text"] ?? "");
        $price = floatval($_POST["price"] ?? NAN);

        // Verificar información
        if(strlen($text) < 5 || strlen($text) > 64) sendResponse(400);
        if(!is_float($price)) sendResponse(401);

        // Crear servicio
        $service = new Service($_POST);
        if(!$service->save()) sendResponse(502);

        echo json_encode(
        [
            "response" => 200,
            "id" => $service->id
        ]);
    }

    public static function editService()
    {
        $id = $_POST["id"] ?? NAN;
        $text = trim($_POST["text"] ?? "");
        $price = floatval($_POST["price"] ?? NAN);

        // Verificar información
        if(!filter_var($id, FILTER_VALIDATE_INT)) sendResponse(500);
        if(strlen($text) < 5 || strlen($text) > 64) sendResponse(400);
        if(!is_float($price)) sendResponse(400);

        // Hacer consulta
        $service = Service::findById("$id");
        $service = array_shift($service);
        if(!$service) sendResponse(500);

        $service->text = $text;
        $service->price = "$price";
        if(!$service->update()) sendResponse(500);

        sendResponse(200);
    }

    public static function deleteService()
    {
        $id = $_POST["id"] ?? NAN;

        // Verificar información
        if(!filter_var($id, FILTER_VALIDATE_INT)) sendResponse(500);

        // Hacer consulta
        $service = Service::findById("$id");
        $service = array_shift($service);
        if(!$service) sendResponse(500);

        if(!$service->delete()) sendResponse(500);

        sendResponse(200);
    }
}

function sendResponse($code)
{
    echo json_encode(["response" => $code]);
    exit;
}
