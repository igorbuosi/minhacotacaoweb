<?php
use Cotacaoweb\PageHome;

$app->get('/', function() {
	$page = new PageHome();
		$page->setTpl("index");
});


?>