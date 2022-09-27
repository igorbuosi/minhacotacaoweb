<?php
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Grupo;

$app->get('/painel', function() {
	$page = new PagePainel();
		$page->setTpl("index");
});

$app->get('/painel/grupo', function() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$pagination = Grupo::listar(true, $search, $page);

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/painel/grupo?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);
	}

	//var_dump($pagination['data']);
	//exit;

	$page = new PagePainel();
		$page->setTpl("grupo",
			array(
			"grupos"=>$pagination['data'],
			"search"=>$search,
			"pages"=>$pages,
			"numRegistros"=>count($pagination['data'])
		));
		//destrutor é automatico
});

$app->post('/painel/grupo/cadastrar', function(){
	$grupo = new Grupo();
	
	$grupo->setData($_POST);

	/*SE FOR INSERCAO, O ID GRUPO NAO VEM PREENCHIDO, PORTANTO A SITUACAO PADRAO É A = ATIVA*/
	if (!$_POST['idgrupo'] || $_POST['idgrupo'] == '0' || $_POST['idgrupo'] == ''){
		$grupo->setsituacao("A");
	}
	
	$grupo->salvar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});

$app->get("/painel/grupo/:idgrupo", function($idgrupo){
	$grupo = new Grupo();
	$grupo->carregar((int)$idgrupo);
	/*retornar o objeto carregado como json*/
	echo json_encode($grupo->getValues());
	exit;
});

$app->get("/painel/grupo/deletar/:idgrupo", function($idgrupo){
	$grupo = new Grupo();
	$grupo->carregar((int)$idgrupo);
	$grupo->deletar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});



 ?>