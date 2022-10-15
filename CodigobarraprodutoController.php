<?php
use Cotacaoweb\Model\Codigobarraproduto;
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Produto;

/*$app->get('/painel/codigobarraproduto/cadastrar', function(){

    $codigobarraproduto = Codigobarraproduto::listar();
	
	$page = new PagePainel();
		$page->setTpl("produto-cadastro",
		array(
		"codigobarraprodutos"=>$codigobarraproduto['data']));
    exit;
});

/*nao vai mais precisar desse metodo*/
$app->get('/painel/codigobarraproduto/buscar/:idproduto', function($idproduto){

	$codigobarraproduto = new Codigobarraproduto();

	$pesquisaCodBarra = Codigobarraproduto::buscarCodBarraProd($idproduto);

	echo json_encode($pesquisaCodBarra);
	exit;
});

$app->post('/painel/codigobarraproduto/cadastrar', function(){
	$codigobarraproduto = new Codigobarraproduto();

	$pesquisaCodBarra = Codigobarraproduto::buscarProdCodBarra($_POST['codigobarra']);

	/*validacao se a ja existe o codigo de barra cadastrado*/
	if ((isset($pesquisaCodBarra[0])) && ($pesquisaCodBarra[0]['idproduto'] > 0)){
		$codigobarraproduto->carregar((int) $pesquisaCodBarra[0]['idcodigobarraproduto']);
		$codigobarraproduto->getValues();
		$produto = new Produto();
		$produto->carregar((int) $pesquisaCodBarra[0]['idproduto']);
		$produto->getValues();

		echo json_encode([
			'resultado'=>'N-OK',
			'idproduto'=>$codigobarraproduto->getidproduto(),
			'idcodigobarraproduto'=>$codigobarraproduto->getidcodigobarraproduto(),
			'codigobarra'=>$codigobarraproduto->getcodigobarra(),
			'descricao'=>$produto->getdescricao()
		]);
		exit;
	}else{	
		$codigobarraproduto->setData($_POST);		
		$codigobarraproduto->salvar();

		echo json_encode([
			'resultado'=>'ok',
			'idproduto'=>$codigobarraproduto->getidproduto(),
			'idcodigobarraproduto'=>$codigobarraproduto->getidcodigobarraproduto(),
			'codigobarra'=>$codigobarraproduto->getcodigobarra()
		]);
		
		exit;
	}
});



$app->POST('/painel/codigobarraproduto/deletar', function(){
	$codigobarraproduto = new Codigobarraproduto();
	
	$codigobarraproduto->carregar((int) $_POST['idcodigobarraproduto']);

	$codigobarraproduto->deletar();

	echo json_encode([
		'resultado'=>'ok'
    ]);
    
    exit;
});
