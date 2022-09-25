<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Estado extends Model{    

    public static function listar($paginacao = false, $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

            $resultados = $sql->select("
                select  SQL_CALC_FOUND_ROWS *
                from estado 
                order by siglaEstado
                limit $start, $itensporpagina");
    
            $resultadoTotal = $sql->select(" select found_rows() as nrtotal");
    
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

}




    /*public function save(){
        $sql = new Sql();
        $results = $sql->select("CALL sp_categories_save(:idcategory, :descategory)", 
        array(
            ":idcategory"=>$this->getidcategory(),
            ":descategory"=>$this->getdescategory()
        ));

        $this->setData($results[0]);

        Category::updateFile();

    }

    public function get($idcategory){
        $sql = new Sql();
        $results = $sql->select ("select * from tb_categories where idcategory = :idcategory", array(
            ":idcategory"=>$idcategory
        ));
        $this->setData($results[0]);
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("delete from tb_categories where idcategory = :idcategory",array(
            ":idcategory"=>$this->getidcategory()
        ));
*/
   



?>