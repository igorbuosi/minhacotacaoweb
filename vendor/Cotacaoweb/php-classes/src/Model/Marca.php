<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Marca extends Model{
    public static function listar($paginacao = false, $search="", $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

                //validar se está com search da pesquisa na tela
                if ($search != ""){
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from marca 
                    where nomemarca like :search or descricaomarca like :search
                    order by nomemarca
                    limit $start, $itensporpagina", [
                        ':search'=>'%'.$search.'%'
                    ]);
                }else{
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from marca 
                    order by nomemarca
                    limit $start, $itensporpagina");
                }

            $resultadoTotal = $sql->select("select found_rows() as nrtotal");
    
            return [
                'data'=>$resultados,
                'total'=>(int) $resultadoTotal[0]["nrtotal"],
                'pages'=>ceil($resultadoTotal[0]["nrtotal"] /  $itensporpagina)
            ];
            
        }
        /*somente listar simples - sem validar paginacao*/ 
        if ($paginacao = false){
            return $sql->select("select * from marca order by nomemarca");
        }        
    }

    public function salvar(){
        $sql = new Sql();

            $resultado = $sql->select("call salvar_marca (:idmarca, :nomemarca, :descricaomarca, :situacao)", array(
                ":idmarca"=>$this->getidmarca(),
                ":nomemarca"=>$this->getnomemarca(), 
                ":descricaomarca"=>$this->getdescricaomarca(),  
                ":situacao"=>$this->getsituacao()
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idmarca){
        $sql = new Sql();
        $results = $sql->select ("select * from marca where idmarca = :idmarca", array(
            ":idmarca"=>$idmarca
        ));
        $this->setData($results[0]);
    }

    public function deletar(){
        $sql = new Sql();
        $situacao = 'A';      

        if ($this->getsituacao() == 'A'){
            $situacao = 'I';
        }

        $sql->query("update marca set situacao = :situacao where idmarca = :idmarca", array(
            ':idmarca'=>$this->getidmarca(),
            ':situacao'=>$situacao
        ));
    }

}
?>