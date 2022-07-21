<?php
session_start();
require "include.php";
$url=  trim( $_SERVER['PATH_INFO'], '/');
$url = explode('/',$url);
$route = array(
    "accueil",
    "contact",
    "produit",
    "category",
    "details",
    "panier",
    "supprimer"
);

//print_r($url);

$action = $url[0];

//Controller
if(!in_array($action, $route))
{
    $title = "Page Error";
    $content = "URL introuvable";
}
else
{
    //echo "Bienvenue sur la page " .$action;
    $function = "display".ucwords($action);
    $title = "Page ".$action;
    $content = $function();
}
require_once VIEWS.SEPARATOR."templates".SEPARATOR."default.php";