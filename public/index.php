<?php
require_once __DIR__ . "/../includes/app.php";
session_start();

use Controllers\AuthController;
use MVC\Router;

$router = new Router();

// Login
$router->get("/", [AuthController::class, "login"]);
$router->post("/", [AuthController::class, "login"]);
$router->get("/logout", [AuthController::class, "logout"]);
$router->get("/auth-msg", [AuthController::class, "authMsg"]);

// Crear cuentas
$router->get("/signup", [AuthController::class, "signup"]);
$router->post("/signup", [AuthController::class, "signup"]);
$router->get("/email-confirmation", [AuthController::class, "emailConfirmation"]);

// Recuperar contraseña
$router->get("/password-recovery", [AuthController::class, "passwordRecovery"]);
$router->post("/password-recovery", [AuthController::class, "passwordRecovery"]);
$router->get("/password-reset", [AuthController::class, "passwordReset"]);
$router->post("/password-reset", [AuthController::class, "passwordReset"]);

//
$router->checkRoutes();