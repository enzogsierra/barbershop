<?php
namespace Model;

class User extends ActiveRecord
{
    public $id;
    public $email;
    public $password;
    public $name;
    public $surname;
    public $tel;
    public $isAdmin;
    public $isConfirmed;
    public $token;

    protected static $table = "users";
    protected static $columns = ["id", "email", "password", "name", "surname", "tel", "isAdmin", "isConfirmed", "token"];

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->name = $args["name"] ?? "";
        $this->surname = $args["surname"] ?? "";
        $this->tel = $args["tel"] ?? "";
        $this->isAdmin = $args["isAdmin"] ?? "0";
        $this->isConfirmed = $args["isConfirmed"] ?? "0";
        $this->token = $args["token"] ?? "";
    }

    public function validate()
    {
        $errors = [];

        // email
        if(!$this->email) $errors[] = "Ingrese un email";
        else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $errors[] = "Debes ingresar un email válido";

        // password
        if(!$this->password) $errors[] = "Ingrese una contraseña";
        else if(strlen($this->password) < 6) $errors[] = "La contraseña debe contener al menos 6 caracteres";

        // nombre
        $this->name = trim($this->name);
        if(!$this->name) $errors[] = "Ingrese un nombre";
        else if(preg_match('~[0-9]+~', $this->name)) $errors[] = "Su nombre contiene caracteres no admitidos";
        else if(!(strlen($this->name) >= 3 && strlen($this->name) <= 64)) $errors[] = "Su nombre debe contener entre 3 y 64 caracteres";

        // apellido
        $this->surname = trim($this->surname);
        if(!$this->surname) $errors[] = "Ingrese un apellido";
        else if(preg_match('~[0-9]+~', $this->surname)) $errors[] = "Su apellido contiene caracteres no admitidos";
        else if(!(strlen($this->surname) >= 3 && strlen($this->surname) <= 64)) $errors[] = "Su apellido debe contener entre 3 y 64 caracteres";

        // telefono
        if(!$this->tel) $errors[] = "Ingrese un número de teléfono";
        else if(!(filter_var($this->tel, FILTER_VALIDATE_INT) && strlen($this->tel) <= 16)) $errors[] = "Número de teléfono no válido";
        return $errors;
    }

    public function isEmailInUse() // Verificar si el email está registrado
    {
        return self::$db->query("SELECT email FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1")->num_rows != 0;
    }
}