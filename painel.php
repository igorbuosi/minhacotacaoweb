<?php
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Estado;

$app->get('/painel', function() {

	$page = new PagePainel(); // instanciou o construct
		$page->setTpl("index");
		//destrutor é automatico
});


$app->get('/painel/estado', function() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$pagination = Estado::listar(true, $page);

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/painel/estado?'.http_build_query([
				'page'=>$x+1
			]),
			'text'=>$x+1
		]);

	}

	$page = new PagePainel();
		$page->setTpl("estado",
			array(
			"estados"=>$pagination['data'],
			"pages"=>$pages,
			"numRegistros"=>count($pagination['data'])
		));
		//destrutor é automatico
});

$app->post('/painel/estado/cadastrar', function(){
	$estado = new Estado();
	
	$estado->setData($_POST);

	/*SE FOR INSERCAO, O ID ESTADO NAO VEM PREENCHIDO, PORTANTO A SITUACAO PADRAO É A = ATIVA*/
	if (!$_POST['idEstado'] || $_POST['idEstado'] == '0' || $_POST['idEstado'] == ''){
		$estado->setsituacao("A");
	}
	
	$estado->salvar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});




 ?>