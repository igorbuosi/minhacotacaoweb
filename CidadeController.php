<?php
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Cidade;
use Cotacaoweb\Model\Estado;

$app->get('/painel/cidade', function() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$pagination = Cidade::listar(true, $search, $page);

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/painel/cidade?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);
	}

    $estados = Estado::listar(false);

	$page = new PagePainel();
		$page->setTpl("cidade",
			array(
			"cidades"=>$pagination['data'],
            "estados"=>$estados['data'],
			"search"=>$search,
			"pages"=>$pages,
			"numRegistros"=>count($pagination['data'])
		));
		//destrutor é automatico

        
});

$app->post('/painel/cidade/cadastrar', function(){
	$cidade = new Cidade();
	
	$cidade->setData($_POST);

	/*SE FOR INSERCAO, O ID GRUPO NAO VEM PREENCHIDO, PORTANTO A SITUACAO PADRAO É A = ATIVA*/
	if (!$_POST['idcidade'] || $_POST['idcidade'] == '0' || $_POST['idcidade'] == ''){
		$cidade->setsituacao("A");
	}
	
	$cidade->salvar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});

$app->get("/painel/cidade/:idcidade", function($idcidade){
	$cidade = new Cidade();
	$cidade->carregar((int)$idcidade);
	/*retornar o objeto carregado como json*/
	echo json_encode($cidade->getValues());
	exit;
});

$app->get("/painel/cidade/deletar/:idcidade", function($idcidade){
	$cidade = new Cidade();
	$cidade->carregar((int)$idcidade);
	$cidade->deletar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});



 ?>