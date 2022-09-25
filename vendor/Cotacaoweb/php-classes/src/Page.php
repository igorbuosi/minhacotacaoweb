<?php
namespace Cotacaoweb;

use Rain\Tpl;

class Page{
    private $tpl;
    private $options=[];
    private $defaults = [
        "header"=>true,
        "footer"=>true,
        "data"=>[]
    ];

    // esse metodo é criado ao instanciar a classe page automaticamente
    public function __construct($opts = array(), $tpl_dir = "/views/home/")
    {
        $this->options = array_merge($this->defaults,$opts);
        // config
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views/views-cache/",
            "debug"         => false // set to false to improve the speed
        );
        Tpl::configure( $config );

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        if($this->options["header"] === true) $this->tpl->draw("header");
   }

   
   private function setData($data = array())
   {
        foreach($data as $key => $value){
            $this->tpl->assign($key, $value);
        }
   }

    public function setTpl($name, $data = array(), $returnHTML = false)
    {
        $this->setData($data);
        return $this->tpl->draw($name,$returnHTML);
    }

    // depois de isntanciar o metodo set Tpl, automaticamente o php destrói chamando o footer
    public function __destruct()
    {
        if($this->options["footer"] === true) $this->tpl->draw("footer");
        
    }


}


?>