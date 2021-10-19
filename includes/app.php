<?php
require __DIR__ . "/../vendor/autoload.php";

// DB
use Model\ActiveRecord;
$db = mysqli_connect("localhost", "root", "root", "appsalon");
ActiveRecord::setDB($db);

if(!$db)
{
    echo "No se pudo conectar a la base de datos";
    exit;
}


//
function debug($var, $exit = 1)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";

    if($exit) exit;
}

function s($html): string
{
    return htmlspecialchars($html);
}