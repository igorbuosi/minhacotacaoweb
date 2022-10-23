<?php
use Cotacaoweb\PageHome;
use Cotacaoweb\Model\Estado;
use Cotacaoweb\Model\Cidade;
use Cotacaoweb\Model\Empresa;

$app->get('/empresa', function() {
	$page = new PageHome();

	$estados = Estado::listar(false);
	$cidades = Cidade::listar(false);

		$page->setTpl("empresa", array(
			"estados"=>$estados['data'],
			"cidades"=>$cidades['data']
		));
});

$app->post('/empresa/cadastrar', function(){
	$empresa = new Empresa();
	
	$empresa->setData($_POST);

	/*SE FOR INSERCAO, O ID EMPRESA NAO VEM PREENCHIDO, PORTANTO O TIPO PADRAO É J (JURIDICO E O VERIFICADO N)*/
	if (!$_POST['idempresa'] || $_POST['idempresa'] == '0' || $_POST['idempresa'] == ''){
		$empresa->settipopessoa("J");
		$empresa->setverificado("N");
	}
	
	$empresa->salvar();

	echo json_encode([
        'resultado'=>'ok'
    ]);
    exit;
});


?>