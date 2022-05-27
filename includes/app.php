<?php
require __DIR__ . "/../vendor/autoload.php";

// DB
use Model\ActiveRecord;
$db = mysqli_connect("localhost", "root", "root", "barbershop");
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

function isDateInRange($date)
{
    $val = strtotime($date);
    $min = strtotime("next day 00:00:00");
    $max = strtotime("+1 month");

    return ($val >= $min && $val <= $max);
}