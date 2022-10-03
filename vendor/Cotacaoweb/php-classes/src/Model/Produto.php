<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Produto extends Model{
    public static function listar($paginacao = false, $search="", $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

                //validar se está com search da pesquisa na tela
                if ($search != ""){
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS
                    produto.*,
                    grupo.nomegrupo,
                    marca.nomemarca
                    from produto 
                    inner join grupo on (produto.idgrupo = grupo.idgrupo)
                    inner join marca on (produto.idmarca = marca.idmarca)
                    where descricao like :search
                    order by datacadastro desc
                    limit $start, $itensporpagina", [
                        ':search'=>'%'.$search.'%'
                    ]);
                }else{
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS
                    produto.*,
                    grupo.nomegrupo,
                    marca.nomemarca
                    from produto 
                    inner join grupo on (produto.idgrupo = grupo.idgrupo)
                    inner join marca on (produto.idmarca = marca.idmarca)
                    order by datacadastro desc
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
            return $sql->select("select * from produto order by nomeproduto");
        }        
    }

    public function salvar(){
        $sql = new Sql();
            $resultado = $sql->select("call salvar_produto (:idproduto,:descricao,:descricaodetalhada,:ncm,:unidademedida,:idgrupo,:idsubgrupo, :idmarca)", array(         
                ":idproduto"=>$this->getidproduto(),
                ":descricao"=>$this->getdescricao(), 
                ":descricaodetalhada"=>$this->getdescricaodetalhada(),  
                ":ncm"=>$this->getncm(),
                ":unidademedida"=>$this->getunidademedida(),
                ":idgrupo"=>$this->getidgrupo(),
                ":idsubgrupo"=>$this->getidsubgrupo(),
                ":idmarca"=>$this->getidmarca()
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idproduto){
        $sql = new Sql();
        $results = $sql->select ("select * from produto where idproduto = :idproduto", array(
            ":idproduto"=>$idproduto
        ));
        $this->setData($results[0]);
    }

    public function deletar(){
        $sql = new Sql();
        $query = '';      

        if ($this->getdatacadastro() != ''){
            $query = "update produto set datacadastro = null where idproduto = :idproduto";
        }else{
            $query = "update produto set datacadastro = now() where idproduto = :idproduto";

        }

        $sql->query($query, array(
            ':idproduto'=>$this->getidproduto()
        ));
    }

}
