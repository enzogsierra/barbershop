<?php
namespace Controllers;

use MVC\Router;

class DateController
{
    public static function index(Router $router)
    {
        $router->render("date/index",
        [
            "name" => $_SESSION["name"]
        ]);
    }
}