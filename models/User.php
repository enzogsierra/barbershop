<?php
namespace Model;

class User extends ActiveRecord
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $tel;
    public $isAdmin;
    public $isConfirmed;
    public $token;

    protected static $table = "users";
    protected static $columns = ["id", "name", "surname", "email", "password", "tel", "isAdmin", "isConfirmed", "token"];

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->name = $args["name"] ?? "";
        $this->surname = $args["surname"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->tel = $args["tel"] ?? "";
        $this->isAdmin = $args["isAdmin"] ?? false;
        $this->isConfirmed = $args["isConfirmed"] ?? false;
        $this->token = $args["token"] ?? "";
    }

    public function validate()
    {
        $errors = [];
        if(!$this->name) $errors[] = "Debes ingresar un nombre";
        if(!$this->surname) $errors[] = "Debes ingresar un apellido";
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $errors[] = "Debes ingresar un email válido";
        if(strlen($this->password) < 6) $errors[] = "La contraseña debe tener al menos 6 caracteres";
        if(filter_var($this->tel, FILTER_VALIDATE_INT)) $errors[] = "Número de teléfono no válido";

        return $errors;
    }
}