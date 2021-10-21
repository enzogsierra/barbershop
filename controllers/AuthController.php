<?php
namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class AuthController
{
    // Iniciar sesión
    public static function login(Router $router)
    {
        $errors = [];

        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $email = $_POST["email"] ?? NULL;
            $password = $_POST["password"] ?? NULL;

            // Verificar errores en el formulario
            if(!$email) $errors[] = "Ingresa tu email";
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Debes ingresar un email válido";

            if(!$password) $errors[] = "Ingresa una contraseña";

            // Formulario correcto
            if(empty($errors))
            {
                $user = User::where("email", $email);
                $user = array_shift($user);

                if(!$user) $errors[] = "El correo electrónico ingresado no está asociado a una cuenta";
                else if(!password_verify($password, $user->password)) $errors[] = "La contraseña ingresada es incorrecta";
                else if($user->isConfirmed == 0) $errors[] = "Debes verificar tu correo electrónico para poder iniciar sesión";
                else // Login correcto
                {
                    $_SESSION["logged"] = true;
                    $_SESSION["id"] = $user->id;
                    $_SESSION["name"] = $user->name;
                    $_SESSION["surname"] = $user->surname;
                    $_SESSION["isAdmin"] = $user->isAdmin;
                    header("Location: /");
                }
            }
        }

        $router->render("auth/login", 
        [
            "errors" => $errors,
            "email" => $email ?? NULL
        ]);
    }

    // Crear cuenta
    public static function signup(Router $router)
    {
        $user = new User($_POST);
        $errors = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $user->sync($_POST);
            $errors = $user->validate();
            
            if(empty($errors)) // No hay errores en el formulario de registro
            {
                if(!$user->isEmailInUse()) // El email es válido
                {
                    $user->password = password_hash($user->password, PASSWORD_BCRYPT); // Hash
                    $user->token = bin2hex(random_bytes(8)); // Generar token random seguro de 16 caracteres

                    // Verificar si se creó el usuario y enviar el email
                    if($user->save())
                    {
                        $email = new Email($user->email, $user->name, $user->token);
                        $email->sendConfirmation();

                        $_SESSION["auth-msg"]["id"] = 1;
                        $_SESSION["auth-msg"]["email"] = $user->email;
                        header("Location: /auth-msg");
                    }
                    else // No se pudo crear el usuario
                    {
                        $errors = array();
                        $errors[] = "Hubo un error al crear tu usuario. Inténtalo más tarde.";
                    }
                }
                else // El email ya está en uso
                {
                    $errors = array();
                    $errors[] = "Este email ya está registrado, ¿deseas <a href='/'>Inciar sesión</a>?";
                }
            }
        }
        
        $router->render("auth/signup",
        [
            "user" => $user,
            "errors" => $errors
        ]);
    }

    public static function confirmationSent(Router $router)
    {
        if(!isset($_SESSION["confirmation-sent-email"])) header("Location: /");

        $router->render("auth/confirmation-sent");
        unset($_SESSION["confirmation-sent-email"]);
    }

    public static function emailConfirmation(Router $router)
    {
        $token = $_GET["token"] ?? NULL;
        if(!ctype_alnum($token)) 
        {
            $_SESSION["auth-msg"]["id"] = 3;
            header("Location: /auth-msg");
        }

        //
        $user = User::where("token", $token);
        $user = array_shift($user);

        if($user) // Token encontrado
        {
            $user->token = "";
            $user->isConfirmed = "1";
            $user->update();

            $_SESSION["auth-msg"]["id"] = 2;
        }
        else $_SESSION["auth-msg"]["id"] = 3; // Token no válido

        header("Location: /auth-msg");
    }


    // Recuperar contraseña
    public static function passwordRecovery(Router $router)
    {
        $errors = [];
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $email = filter_var($_POST["email"] ?? NULL, FILTER_VALIDATE_EMAIL);

            if(!$email) $errors[] = "Ingresa un email válido";
            else 
            {
                $user = User::where("email", $email);
                $user = array_shift($user);

                if(!$user) $errors[] = "El correo electrónico ingresado no existe";
                else if($user->isConfirmed == 0) $errors[] = "Debes verificar este correo electrónico";
                else
                {
                    $user->token = $user->token = bin2hex(random_bytes(8));
                    $user->update();

                    // Enviar email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendRecover();

                    //
                    $_SESSION["auth-msg"]["id"] = 4;
                    header("Location: /auth-msg");
                }
            }
        }

        $router->render("auth/password-recovery",
        [
            "errors" => $errors,
            "email" => $email ?? NULL
        ]);
    }

    public static function passwordReset(Router $router)
    {
        $token = $_GET["token"] ?? NULL;
        if(!ctype_alnum($token)) // Token no válido
        {
            $_SESSION["auth-msg"]["id"] = 3;
            header("Location: /auth-msg");
        }

        $user = User::where("token", $token);
        $user = array_shift($user);
        if(!$user) 
        {
            $_SESSION["auth-msg"]["id"] = 3;
            header("Location: /auth-msg");
        }

        //
        $errors = [];
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $password = $_POST["password"] ?? NULL;
            $password2 = $_POST["password-2"] ?? NULL;

            if(!$password) $errors[] = "Ingresa tu nueva contraseña";
            else if(strlen($password) < 6) $errors[] = "La contraseña debe contener al menos 6 caracteres";
            else if(!$password2) $errors[] = "Debes confirmar tu nueva contraseña";
            else if($password != $password2) $errors[] = "Las contraseñas no coinciden. Asegúrate que sean iguales";

            //
            if(empty($errors))
            {
                $user->password = password_hash($password, PASSWORD_BCRYPT);
                $user->token = "";

                if($user->update()) 
                {
                    $_SESSION["auth-msg"]["id"] = 5;
                    header("Location: /auth-msg");
                }
                else $errors[] = "Hubo un error al reestablecer la contraseña. Intenta de nuevo más tarde";
            }
        }

        $router->render("auth/password-reset",
        [
            "errors" => $errors
        ]);
    }

    //
    public static function authMsg(Router $router)
    {
        $msg = $_SESSION["auth-msg"] ?? NULL;
        if(!isset($msg["id"])) header("Location: /");

        unset($_SESSION["auth-msg"]);
        $router->render("auth/auth-msg",
        [
            "msg" => $msg
        ]);
    }
}