<?php

error_reporting(0);

include_once __DIR__ . "/vendor/autoload.php";
include_once __DIR__ . "/example/example.php";

function pageDetect()
{
    $s = ltrim($_SERVER['REQUEST_URI'], '/');
    $s = explode('?', $s);
    $s = $s[0];
    $s = array_filter(explode('/', $s));
    return $s;
}

$page = pageDetect();

switch($page[0])
{
    case "example":
        new Example($page[1]);
        break;
    case "swagger-yaml":
        include __DIR__ . "/swagger.php";
        break;
}