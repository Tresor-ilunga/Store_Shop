<?php
/**
 * Les fonctions appelée par le controlloer
 */
require "functions.php";

define("SRC", dirname(__FILE__));
define("ROOT", dirname(SRC));
const SEPARATOR = DIRECTORY_SEPARATOR;
const CONFIG =  ROOT. SEPARATOR  . "config";
const VIEWS  =  ROOT . SEPARATOR . "views";
const MODEL  =  ROOT . SEPARATOR . "model";

/**
 * Import du model
 */
require_once CONFIG.SEPARATOR."config.php";
require_once MODEL.SEPARATOR."DataLayer.class.php";


$data = new DataLayer();

//$var = $data->createCustomers('Tresor', 'tresor@tresor.com', 'tresor');
//$auth = $data->authentifier('tresor@tresor.com', 'tresor');
//print_r($auth);
//exit();

//$data-> updateInfosCustomers(array('id'=>2,'sexe'=>1,'lastname'=>'Admin','pseudo'=>'Admin','firstname'=>'Admin','email'=>'admin@admin.com'));

$products =  $data->getProduct();
var_dump($products);
exit();