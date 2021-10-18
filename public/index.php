<?php
require_once __DIR__ . "/../includes/app.php";
session_start();

use Controllers\LoginController;
use MVC\Router;

$router = new Router();

// Login
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);

// Crear cuentas
$router->get("/signup", [LoginController::class, "signup"]);
$router->post("/signup", [LoginController::class, "signup"]);

// Recuperar contraseña
$router->get("/verify", [LoginController::class, "verify"]);
$router->post("/verify", [LoginController::class, "verify"]);
$router->get("/recover", [LoginController::class, "recover"]);
$router->post("/recover", [LoginController::class, "recover"]);

//
$router->checkRoutes();