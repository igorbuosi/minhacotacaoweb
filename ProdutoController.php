<?php

use Cotacaoweb\Model\Marca;
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Produto;
use Cotacaoweb\Model\Subgrupo;
use Cotacaoweb\Model\Grupo;

$app->get('/painel/produto', function(){
	/*LISTAR OS SELECTS DOS CADASTROS NOS FILTROS */
	$grupos = Grupo::listar(false);
	$subgrupos = Subgrupo::listar(false);
	$marcas = Marca::listar(false);
	
	/*FILTROS DA PAGINACAO*/
	$pages = [];
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;


	/*codigo/descricao*/
	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	/*codigo de barra*/
	$codigobarra = (isset($_GET['codigobarra'])) ? $_GET['codigobarra'] : '';
	$idgrupo = (isset($_GET['idgrupo'])) ? $_GET['idgrupo'] : '0';
	$idsubgrupo = (isset($_GET['idsubgrupo'])) ? $_GET['idsubgrupo'] : '0';
	$idmarca = (isset($_GET['idmarca'])) ? $_GET['idmarca'] : '0';
	
	$pagination = Produto::listar(true, $search, $codigobarra,$idgrupo, $idsubgrupo, $idmarca, $page);


	for ($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/painel/produto?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search,
				'codigobarra'=>$codigobarra,
				'idgrupo'=>$idgrupo,
				'idsubgrupo'=>$idsubgrupo,
				'idmarca'=>$idmarca
			]),
			'text'=>$x+1
		]);

	}
	$page = new PagePainel();
		$page->setTpl("produto",
		array(
		"produtos"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages,
		"codigobarra"=>$codigobarra,
		"numRegistros"=>count($pagination['data']),
		"grupos"=>$grupos['data'],
		"subgrupos"=>$subgrupos['data'],
		"marcas"=>$marcas['data']));
    exit;
});

$app->get('/painel/produto/:idproduto', function($idproduto){
	$produto = new Produto();
	
	$produto->carregar((int) $idproduto);


	$grupos = Grupo::listar(false);
	$subgrupos = Subgrupo::listar(false);
	$marcas = Marca::listar(false);

	
	$page = new PagePainel();
		$page->setTpl("produto-cadastro",
		array(
		"produto"=>$produto->getValues(),
		"grupos"=>$grupos['data'],
		"subgrupos"=>$subgrupos['data'],
		"marcas"=>$marcas['data']));
    exit;
});


$app->get('/painel/produto/cadastrar', function(){

	$grupos = Grupo::listar(false);
	$subgrupos = Subgrupo::listar(false);
	$marcas = Marca::listar(false);

	
	$page = new PagePainel();
		$page->setTpl("produto-cadastro",
		array(
		"produto"=>"",
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


$app->get("/painel/produto/deletar/:idproduto", function($idproduto){
	$produto = new Produto();
	$produto->carregar((int)$idproduto);
	$produto->deletar();
	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});
