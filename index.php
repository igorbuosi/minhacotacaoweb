<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$sql = new \Cotacaoweb\DB\Sql();

	$results = $sql->select("select * from teste");

	echo json_encode($results);


});

$app->run();

 ?>