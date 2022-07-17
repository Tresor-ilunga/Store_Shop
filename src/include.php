<?php
/**
 * Les fonctions appelée par le controlloer
 */
require "functions.php";
//print_r(); exit();
define("SRC", dirname(__FILE__));
define("ROOT", dirname(SRC));
const SEPARATOR = DIRECTORY_SEPARATOR;
const CONFIG =  ROOT. SEPARATOR  . "config";
const VIEWS  =  ROOT . SEPARATOR . "views";
const MODEL  =  ROOT . SEPARATOR . "model";
define("BASE_URL", dirname(dirname($_SERVER['SCRIPT_NAME'])));

/**
 * Import du model
 */
require_once CONFIG.SEPARATOR."config.php";
require_once MODEL.SEPARATOR."DataLayer.class.php";


$model = new DataLayer();
$category = $model->getCategory();


