<?php
use Cotacaoweb\Model\Codigobarraproduto;
use Cotacaoweb\PagePainel;
use Cotacaoweb\Model\Produto;

$app->get('/painel/codigobarraproduto/cadastrar', function(){

    $codigobarraproduto = Codigobarraproduto::listar();
	
	$page = new PagePainel();
		$page->setTpl("produto-cadastro",
		array(
		"codigobarraprodutos"=>$codigobarraproduto['data']));
    exit;
});

$app->post('/painel/codigobarraproduto/cadastrar', function(){
	$codigobarraproduto = new Codigobarraproduto();
	
	$codigobarraproduto->setData($_POST);
	
	$codigobarraproduto->salvar();

	echo json_encode([
		'resultado'=>'ok',
		'idproduto'=>$codigobarraproduto->getidproduto(),
        'idcodigobarraproduto'=>$codigobarraproduto->getidcodigobarraproduto(),
        'codigobarra'=>$codigobarraproduto->getcodigobarra()
    ]);
    
    exit;
});
