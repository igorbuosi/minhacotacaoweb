<?php 
//session_start();
require_once("vendor/autoload.php");
use \Slim\Slim;


$app = new Slim();

$app->config('debug', true);



//require_once("functions.php");
require_once("EstadoController.php");
require_once("GrupoController.php");
require_once("MarcaController.php");
require_once("Subgrupocontroller.php");
require_once("CidadeController.php");
//require_once("admin.php");
//require_once("admin-categories.php");
//require_once("admin-users.php");
//require_once("admin-products.php");
//require_once("admin-orders.php");




$app->run();

 ?>