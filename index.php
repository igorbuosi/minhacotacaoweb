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
require_once("ProdutoController.php");
require_once("CodigobarraprodutoController.php");
require_once("HomeController.php");

$app->run();

 ?>