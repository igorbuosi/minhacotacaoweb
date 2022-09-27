<?php
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Subgrupo;


$app->get('/painel/subgrupo', function() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$pagination = Subgrupo::listar(true, $search, $page);

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/painel/subgrupo?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	//var_dump($pagination['data']);
	//exit;

	$page = new PagePainel();
		$page->setTpl("subgrupo",
			array(
			"subgrupos"=>$pagination['data'],
			"search"=>$search,
			"pages"=>$pages,
			"numRegistros"=>count($pagination['data'])
		));
		//destrutor é automatico
});

$app->post('/painel/subgrupo/cadastrar', function(){
	$subgrupo = new Subgrupo();
	
	$subgrupo->setData($_POST);

	/*SE FOR INSERCAO, O ID subgrupo NAO VEM PREENCHIDO, PORTANTO A SITUACAO PADRAO É A = ATIVA*/
	if (!$_POST['idsubgrupo'] || $_POST['idsubgrupo'] == '0' || $_POST['idsubgrupo'] == ''){
		$subgrupo->setsituacao("A");
	}
	
	$subgrupo->salvar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});

$app->get("/painel/subgrupo/:idsubgrupo", function($idsubgrupo){
	$subgrupo = new Subgrupo();
	$subgrupo->carregar((int)$idsubgrupo);
	/*retornar o objeto carregado como json*/
	echo json_encode($subgrupo->getValues());
	exit;
});

$app->get("/painel/subgrupo/deletar/:idsubgrupo", function($idsubgrupo){
	$subgrupo = new Subgrupo();
	$subgrupo->carregar((int)$idsubgrupo);
	$subgrupo->deletar();
	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});



 ?>