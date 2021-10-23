<?php
require_once __DIR__ . "/../includes/app.php";
session_start();

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\AuthController;
use Controllers\DateController;
use MVC\Router;

$router = new Router();

// Rutas para usuarios no autenticados
if(!isset($_SESSION["logged"]))
{
    // Login
    $router->get("/", [AuthController::class, "login"]);
    $router->post("/", [AuthController::class, "login"]);
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
}
else // Rutas para usuarios autenticados
{
    $router->get("/", [DateController::class, "index"]);
    $router->get("/logout", [AuthController::class, "logout"]);

    // API de citas
    $router->get("/api/services", [APIController::class, "index"]);
    $router->post("/api/book-date", [APIController::class, "bookDate"]);

    // Admin
    if($_SESSION["isAdmin"])
    {
        $router->get("/admin", [AdminController::class, "index"]);
        $router->get("/admin/services", [AdminController::class, "services"]);
        $router->post("/admin/services/new", [AdminController::class, "newService"]);
        $router->post("/admin/services/edit", [AdminController::class, "editService"]);
        $router->post("/admin/services/delete", [AdminController::class, "deleteService"]);
    }
}


//
$router->checkRoutes();