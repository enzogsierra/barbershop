<?php
namespace MVC;

class Router
{
    public $routes_get = [];
    public $routes_post = [];

    public function get($url, $fn)
    {
        $this->routes_get[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->routes_post[$url] = $fn;
    }

    public function checkRoutes()
    {
        $url = $_SERVER["PATH_INFO"] ?? "/";

        // Verificar si existe la ruta
        if($_SERVER["REQUEST_METHOD"] === "GET") $fn = $this->routes_get[$url] ?? NULL;
        else $fn = $this->routes_post[$url] ?? NULL;

        if($fn) call_user_func($fn, $this);
        else $this->render("public/404");
    }

    public function render($view, $params = [])
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";
        $content = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}