<?php


function bootstrap()
{
    define('APP_PATH', __DIR__);
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}



function redirect($baseUrl, $route = '', $statusCode = 302)
{
    header('Location: ' . $baseUrl . $route, $statusCode);
}




?>
