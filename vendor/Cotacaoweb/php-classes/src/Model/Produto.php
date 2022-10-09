<?php

namespace Cotacaoweb\Model;

use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Produto extends Model
{
    public static function listar($paginacao = false, $search, $codigobarra, $idgrupo, $idsubgrupo, $idmarca, $pagina = 1, $itensporpagina = 10)
    {
        $sql = new Sql();
        $params = [];

        //listar com paginação
        if ($paginacao = true) {
            $start = ($pagina - 1) * $itensporpagina;
                
            $select = " 
                select  SQL_CALC_FOUND_ROWS
                produto.*,
                grupo.nomegrupo,
                marca.nomemarca
                from produto                    
                inner join grupo on (produto.idgrupo = grupo.idgrupo)
                inner join marca on (produto.idmarca = marca.idmarca)                
                where upper(descricao) like upper(:search)";
            $params[':search'] = '%' . $search . '%';

            if ($idgrupo > 0){
                $select .= "and produto.idgrupo = :idgrupo ";
                $params[':idgrupo'] = $idgrupo;
            }

            if ($idmarca > 0){
                $select .= "and produto.idmarca = :idmarca ";
                $params[':idmarca'] = $idmarca;
            }

            if ($idsubgrupo > 0){
                $select .= "and produto.idsubgrupo = :idsubgrupo ";
                $params[':idsubgrupo'] = $idsubgrupo;
            };

            if (strlen($codigobarra) > 0) {
                $select = $select . " and produto.idproduto in (select codigobarraproduto.idproduto from codigobarraproduto where codigobarraproduto.idproduto = produto.idproduto 
                and codigobarraproduto.codigobarra like :codigobarra)";
                $params[':codigobarra'] = $codigobarra;
            }

            $select = $select . " order by datacadastro desc limit $start, $itensporpagina";

            $resultados = $sql->select($select, $params);
        
            $resultadoTotal = $sql->select("select found_rows() as nrtotal");

            return [
                'data' => $resultados,
                'total' => (int) $resultadoTotal[0]["nrtotal"],
                'pages' => ceil($resultadoTotal[0]["nrtotal"] /  $itensporpagina)
            ];
        }
        /*somente listar simples - sem validar paginacao*/
        if ($paginacao = false) {
            return $sql->select("select * from produto order by nomeproduto");
        }
    }

    public function salvar()
    {
        $sql = new Sql();
        $resultado = $sql->select("call salvar_produto (:idproduto,:descricao,:descricaodetalhada,:ncm,:unidademedida,:idgrupo,:idsubgrupo, :idmarca)", array(
            ":idproduto" => $this->getidproduto(),
            ":descricao" => $this->getdescricao(),
            ":descricaodetalhada" => $this->getdescricaodetalhada(),
            ":ncm" => $this->getncm(),
            ":unidademedida" => $this->getunidademedida(),
            ":idgrupo" => $this->getidgrupo(),
            ":idsubgrupo" => $this->getidsubgrupo(),
            ":idmarca" => $this->getidmarca()
        ));

        $this->setData($resultado[0]);
    }

    public function carregar($idproduto)
    {
        $sql = new Sql();
        $results = $sql->select("select * from produto where idproduto = :idproduto", array(
            ":idproduto" => $idproduto
        ));
        $this->setData($results[0]);
    }

    public function deletar()
    {
        $sql = new Sql();
        $query = '';

        if ($this->getdatainativacao() != '') {
            $query = "update produto set datainativacao = null where idproduto = :idproduto";
        } else {
            $query = "update produto set datainativacao = now() where idproduto = :idproduto";
        }

        $sql->query($query, array(
            ':idproduto' => $this->getidproduto()
        ));
    }
}
