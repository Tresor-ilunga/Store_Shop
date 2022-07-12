<?php
require "include.php";
$url=  trim( $_SERVER['PATH_INFO'], '/');
$url = explode('/',$url);
$route = array(
    "accueil",
    "contact"
);

//print_r($url);

$action = $url[0];

//Controller
if(!in_array($action, $route))
{
    echo 'error';
}
else
{
    //echo "Bienvenue sur la page " .$action;
    $function = "display".ucwords($action)."()";
    echo $function;
}