<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Codigobarraproduto extends Model{

    public static function listar($idproduto = 0){
        $sql = new Sql();
        /*somente listar simples - sem validar paginacao*/ 
        if ($idproduto = 0){
            return $sql->select("select * from codigobarraproduto order by codigobarra");
        }else{
            return $sql->select("select * from codigobarraproduto where idproduto = :idproduto", array(
                ":idproduto"=>$idproduto
            ));

        }      
    }

    public static function buscarProdCodBarra($codigobarra){
        $sql = new Sql();
        
        return $sql->select("select * from codigobarraproduto where codigobarra = :codigobarra", array(
            ":codigobarra"=>$codigobarra
        ));

    }

    public static function buscarCodBarraProd($idproduto){
        $sql = new Sql();
        
        return $sql->select("select * from codigobarraproduto where idproduto = :idproduto", array(
            ":idproduto"=>$idproduto
        ));

    }

    public function salvar(){
        $sql = new Sql();
            $resultado = $sql->select("call salvar_codigobarraproduto (:idcodigobarraproduto,:codigobarra, :idproduto)", array(         
                ":idcodigobarraproduto"=>$this->getidcodigobarraproduto(),
                ":codigobarra"=>$this->getcodigobarra(), 
                ":idproduto"=>$this->getidproduto()
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idcodigobarraproduto){
        $sql = new Sql();
        $results = $sql->select ("select * from codigobarraproduto where idcodigobarraproduto = :idcodigobarraproduto", array(
            ":idcodigobarraproduto"=>$idcodigobarraproduto
        ));
        if (isset($results[0])){
            $this->setData($results[0]);
        }
    }

    public function deletar(){
        $sql = new Sql();
        $query = '';    
        
        $query = "delete from codigobarraproduto where idcodigobarraproduto = :idcodigobarraproduto";

        $sql->query($query, array(
            ':idcodigobarraproduto'=>$this->getidcodigobarraproduto()
        ));
    }

}
