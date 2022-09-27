<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Grupo extends Model{
    public static function listar($paginacao = false, $search="", $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

                //validar se está com search da pesquisa na tela
                if ($search != ""){
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from grupo 
                    where nomegrupo like :search or descricaogrupo like :search
                    order by nomegrupo
                    limit $start, $itensporpagina", [
                        ':search'=>'%'.$search.'%'
                    ]);
                }else{
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from grupo 
                    order by nomegrupo
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
            return $sql->select("select * from grupo order by nomegrupo");
        }        
    }

    public function salvar(){
        $sql = new Sql();

            $resultado = $sql->select("call salvar_grupo (:idgrupo, :nomegrupo, :descricaogrupo, :situacao)", array(
                ":idgrupo"=>$this->getidgrupo(),
                ":nomegrupo"=>$this->getnomegrupo(), 
                ":descricaogrupo"=>$this->getdescricaogrupo(),  
                ":situacao"=>$this->getsituacao()
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idgrupo){
        $sql = new Sql();
        $results = $sql->select ("select * from grupo where idgrupo = :idgrupo", array(
            ":idgrupo"=>$idgrupo
        ));
        $this->setData($results[0]);
    }

    public function deletar(){
        $sql = new Sql();
        $situacao = 'A';      

        if ($this->getsituacao() == 'A'){
            $situacao = 'I';
        }

        $sql->query("update grupo set situacao = :situacao where idgrupo = :idgrupo", array(
            ':idgrupo'=>$this->getidgrupo(),
            ':situacao'=>$situacao
        ));
    }

}
?>