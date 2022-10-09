<?php
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Marca;


$app->get('/painel/marca', function() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$pagination = Marca::listar(true, $search, $page);

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/painel/marca?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	$page = new PagePainel();
		$page->setTpl("marca",
			array(
			"marcas"=>$pagination['data'],
			"search"=>$search,
			"pages"=>$pages,
			"numRegistros"=>count($pagination['data'])
		));
		//destrutor é automatico
});

$app->post('/painel/marca/cadastrar', function(){
	$marca = new Marca();
	
	$marca->setData($_POST);

	/*SE FOR INSERCAO, O ID marca NAO VEM PREENCHIDO, PORTANTO A SITUACAO PADRAO É A = ATIVA*/
	if (!$_POST['idmarca'] || $_POST['idmarca'] == '0' || $_POST['idmarca'] == ''){
		$marca->setsituacao("A");
	}
	
	$marca->salvar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});

$app->get("/painel/marca/:idmarca", function($idmarca){
	$marca = new Marca();
	$marca->carregar((int)$idmarca);
	/*retornar o objeto carregado como json*/
	echo json_encode($marca->getValues());
	exit;
});

$app->get("/painel/marca/deletar/:idmarca", function($idmarca){
	$marca = new Marca();
	$marca->carregar((int)$idmarca);
	$marca->deletar();
	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});



 ?>