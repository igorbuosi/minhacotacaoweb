<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Estado extends Model{    

    public static function listar($paginacao = false, $search="", $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

                //validar se está com search da pesquisa na tela
                if ($search != ""){
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from estado 
                    where siglaestado like :search or nomeestado like :search
                    order by siglaEstado
                    limit $start, $itensporpagina", [
                        ':search'=>'%'.$search.'%'
                    ]);
                }else{
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS *
                    from estado 
                    order by siglaEstado
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
            return $sql->select("select * from estado order by siglaEstado");
        }        
    }

    public function salvar(){
        $sql = new Sql();

            $resultado = $sql->select("call salvar_estado (:idEstado, :siglaEstado, :nomeEstado, :codigoEstadoIBGE, :codigoPaisIBGE, :nomePais, :situacao)", array(
                ":idEstado"=>$this->getidEstado(),
                ":siglaEstado"=>$this->getsiglaEstado(), 
                ":nomeEstado"=>$this->getnomeEstado(),  
                ":codigoEstadoIBGE"=>$this->getcodigoEstadoIBGE(), 
                ":codigoPaisIBGE"=>$this->getcodigoPaisIBGE(), 
                ":nomePais"=>$this->getnomePais(),  
                ":situacao"=>$this->getsituacao()
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idEstado){
        $sql = new Sql();
        $results = $sql->select ("select * from estado where idEstado = :idEstado", array(
            ":idEstado"=>$idEstado
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

        $sql->query("update estado set situacao = :situacao where idEstado = :idEstado", array(
            ':idEstado'=>$this->getidestado(),
            ':situacao'=>$situacao
        ));
    }

}
?>