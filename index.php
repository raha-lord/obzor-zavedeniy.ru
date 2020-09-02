<?php
//FRONT CONTROLLER
session_start();
ob_start();
//1. Basic setting
ini_set('display_errors',1);
error_reporting(E_ALL);
//2.Connection system files
define('ROOT',dirname(__FILE__));

require_once (ROOT.'/components/Autoload.php');


//require_once(ROOT.'/components/Router.php');
//include_once ROOT.'/components/DB.php';
//3.Connection to DB

//4. Call to Router

$router = new Router();
$router->run();