<?php

use Cotacaoweb\Model\Marca;
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Produto;
use Cotacaoweb\Model\Subgrupo;
use Cotacaoweb\Model\Grupo;

$app->get('/painel/produto/cadastrar', function(){

	$grupos = Grupo::listar(false);
	$subgrupos = Subgrupo::listar(false);
	$marcas = Marca::listar(false);

	
	$page = new PagePainel();
		$page->setTpl("produto-cadastro",
		array(
		"grupos"=>$grupos['data'],
		"subgrupos"=>$subgrupos['data'],
		"marcas"=>$marcas['data']));
    exit;
});

$app->post('/painel/produto/cadastrar', function(){
	$produto = new Produto();
	
	$produto->setData($_POST);
	
	$produto->salvar();

	echo json_encode([
		'resultado'=>'ok',
		'idproduto'=>$produto->getidproduto()
    ]);
    exit;
});
