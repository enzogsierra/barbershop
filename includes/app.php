<?php
require __DIR__ . "/../vendor/autoload.php";

// DB
$db = mysqli_connect("localhost", "root", "root", "appsalon");
if(!$db)
{
    echo "No se pudo conectar a la base de datos";
    exit;
}

use Model\ActiveRecord;
ActiveRecord::setDB($db);

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