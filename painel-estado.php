<?php
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Estado;

$app->get('/painel', function() {
	$page = new PagePainel();
		$page->setTpl("index");
});

$app->get('/painel/estado', function() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$pagination = Estado::listar(true, $search, $page);

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/painel/estado?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	//var_dump($pagination['data']);
	//exit;

	$page = new PagePainel();
		$page->setTpl("estado",
			array(
			"estados"=>$pagination['data'],
			"search"=>$search,
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

$app->get("/painel/estado/:idEstado", function($idEstado){
	$estado = new Estado();
	$estado->carregar((int)$idEstado);
	/*retornar o objeto carregado como json*/
	echo json_encode($estado->getValues());
	exit;
});

$app->get("/painel/estado/deletar/:idEstado", function($idEstado){
	$estado = new Estado();
	$estado->carregar((int)$idEstado);
	$estado->deletar();
	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});



 ?>