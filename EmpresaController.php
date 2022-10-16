<?php
use Cotacaoweb\PageHome;
use Cotacaoweb\Model\Estado;

$app->get('/empresa', function() {
	$page = new PageHome();

	$estados = Estado::listar(false);
		$page->setTpl("empresa", array(
			"estados"=>$estados['data']
		));
});


?>