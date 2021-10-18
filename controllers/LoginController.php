<?php
namespace Controllers;

use Model\User;
use MVC\Router;

class LoginController
{
    public static function signup(Router $router)
    {
        $user = new User($_POST);
        $errors = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $user->sync($_POST);
        }
        
        $router->render("auth/signup",
        [
            "user" => $user
        ]);
    }

    public static function login(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            debug($_POST);
        }

        $router->render("auth/login");
    }

    public static function verify(Router $router)
    {
        $router->render("auth/verify");
    }
}