<?php
namespace Cotacaoweb;

class PagePainel extends Page{

    public function __construct($opts = array(), $tpl_dir = "/views/painel/")
    {
        parent::__construct($opts, $tpl_dir); //parent busca o metodo da classe pai (Page) pois essa extend os metodos de lá - Heranca
    }


}

?>