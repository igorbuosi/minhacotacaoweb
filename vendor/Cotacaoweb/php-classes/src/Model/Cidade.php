<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Cidade extends Model{
    public static function listar($paginacao = false, $search="", $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

                //validar se está com search da pesquisa na tela
                if ($search != ""){
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS
                    cidade.*,
                    estado.nomeestado
                    from cidade 
                    inner join estado on (estado.idestado = cidade.idestado)
                    where nomecidade like :search
                    order by nomecidade
                    limit $start, $itensporpagina", [
                        ':search'=>'%'.$search.'%'
                    ]);
                }else{
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS
                    cidade.*,
                    estado.nomeestado
                    from cidade 
                    inner join estado on (estado.idestado = cidade.idestado)
                    order by nomecidade
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
            return $sql->select("select * from cidade order by nomecidade");
        }        
    }

    public function salvar(){
        $sql = new Sql();

            $resultado = $sql->select("call salvar_cidade (:idcidade,:nomecidade,:ceppadrao,:codigoibge,:ddd,:situacao,:idestado)", array(
                ":idcidade"=>$this->getidcidade(),
                ":nomecidade"=>$this->getnomecidade(), 
                ":ceppadrao"=>$this->getceppadrao(),  
                ":codigoibge"=>$this->getcodigoibge(),
                ":ddd"=>$this->getddd(),
                ":situacao"=>$this->getsituacao(),
                ":idestado"=>$this->getidestado(),
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idcidade){
        $sql = new Sql();
        $results = $sql->select ("select * from cidade where idcidade = :idcidade", array(
            ":idcidade"=>$idcidade
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

        $sql->query("update cidade set situacao = :situacao where idcidade = :idcidade", array(
            ':idcidade'=>$this->getidcidade(),
            ':situacao'=>$situacao
        ));
    }

}
?>