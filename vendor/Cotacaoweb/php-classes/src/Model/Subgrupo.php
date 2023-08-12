<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Subgrupo extends Model{
    public static function listar($paginacao = false, $search="", $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

                //validar se está com search da pesquisa na tela
                if ($search != ""){
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from subgrupo 
                    where nomesubgrupo like :search or descricaosubgrupo like :search
                    order by nomesubgrupo
                    limit $start, $itensporpagina", [
                        ':search'=>'%'.$search.'%'
                    ]);
                }else{
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from subgrupo 
                    order by nomesubgrupo
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
            return $sql->select("select * from subgrupo order by nomesubgrupo");
        }        
    }

    public function salvar(){
        $sql = new Sql();

            $resultado = $sql->select("call salvar_subgrupo (:idsubgrupo, :nomesubgrupo, :descricaosubgrupo, :situacao)", array(
                ":idsubgrupo"=>$this->getidsubgrupo(),
                ":nomesubgrupo"=>$this->getnomesubgrupo(), 
                ":descricaosubgrupo"=>$this->getdescricaosubgrupo(),  
                ":situacao"=>$this->getsituacao()
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idsubgrupo){
        $sql = new Sql();
        $results = $sql->select ("select * from subgrupo where idsubgrupo = :idsubgrupo", array(
            ":idsubgrupo"=>$idsubgrupo
        ));
        
        if (isset($results[0])){
            $this->setData($results[0]);
        }
    }

    public function deletar(){
        $sql = new Sql();
        $situacao = 'A';      

        if ($this->getsituacao() == 'A'){
            $situacao = 'I';
        }

        $sql->query("update subgrupo set situacao = :situacao where idsubgrupo = :idsubgrupo", array(
            ':idsubgrupo'=>$this->getidsubgrupo(),
            ':situacao'=>$situacao
        ));
    }

}
?>