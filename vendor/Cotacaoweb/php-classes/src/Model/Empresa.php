<?php
namespace Cotacaoweb\Model;
use Cotacaoweb\Model;
use Cotacaoweb\DB\Sql;

class Empresa extends Model{

    public static function listar($paginacao = false, $search="", $pagina = 1, $itensporpagina = 10){
        $sql = new Sql();
        //listar com paginação
        if ($paginacao = true){
            $start = ($pagina-1) * $itensporpagina;

                //validar se está com search da pesquisa na tela
                if ($search != ""){
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS
                    * 
                    from empresa, pessoajuridica, pessoa
                    where empresa.idpessoajuridica = pessoajuridica.idpessoajuridica
                    and pessoajuridica.idpessoa = pessoa.idpessoa
                    where pessoa.nomecompleto like :search
                    order by pessoa.nomecompleto
                    limit $start, $itensporpagina", [
                        ':search'=>'%'.$search.'%'
                    ]);
                }else{
                    $resultados = $sql->select("
                    select  SQL_CALC_FOUND_ROWS
                    * 
                    from empresa, pessoajuridica, pessoa
                    where empresa.idpessoajuridica = pessoajuridica.idpessoajuridica
                    and pessoajuridica.idpessoa = pessoa.idpessoa
                    order by pessoa.nomecompleto
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
            return $sql->select("select * from empresa, pessoajuridica, pessoa
            where empresa.idpessoajuridica = pessoajuridica.idpessoajuridica
            and pessoajuridica.idpessoa = pessoa.idpessoa
            order by pessoa.nomecompleto");
        }        
    }

    public function salvar(){
        $sql = new Sql();      
            $resultado = $sql->select("CALL salvar_empresa(:idpessoa,:nomecompleto,:ceppessoa,:endereco,:numendereco,:bairro,:complemento,:email,:site,:login,:senha,:tipopessoa,:tel1,:tel2,:fotoperfil,:idcidade,:idpessoajuridica,:cnpj,:ie,:razaosocial,:idempresa,:verificado)", array(
                ":idpessoa"=>$this->getidpessoa(),
                ":nomecompleto"=>$this->getnomecompleto(), 
                ":ceppessoa"=>$this->getceppessoa(),  
                ":endereco"=>$this->getendereco(),
                ":numendereco"=>$this->getnumendereco(),
                ":bairro"=>$this->getbairro(),
                ":complemento"=>$this->getcomplemento(),
                ":email"=>$this->getemail(),
                ":site"=>$this->getsite(),
                ":login"=>$this->getlogin(),
                ":senha"=>$this->getsenha(),
                ":tipopessoa"=>$this->gettipopessoa(),
                ":tel1"=>$this->gettel1(),
                ":tel2"=>$this->gettel2(),
                ":fotoperfil"=>$this->getfotoperfil(),
                ":idcidade"=>$this->getidcidade(),
                ":idpessoajuridica"=>$this->getidpessoajuridica(),
                ":cnpj"=>$this->getcnpj(),
                ":ie"=>$this->getie(),
                ":razaosocial"=>$this->getrazaosocial(),
                ":idempresa"=>$this->getidempresa(),
                ":verificado"=>$this->getverificado()
            ));

            $this->setData($resultado[0]);
    }

    public function carregar($idempresa){
        $sql = new Sql();
        $results = $sql->select ("select * from empresa, pessoajuridica, pessoa
        where empresa.idpessoajuridica = pessoajuridica.idpessoajuridica
        and pessoajuridica.idpessoa = pessoa.idpessoa
        and empresa.idempresa = :idempresa", array(
            ":idempresa"=>$idempresa
        ));
        
        if (isset($results[0])){
            $this->setData($results[0]);
        }
    }

    public function deletar(){
        $sql = new Sql();
        $query = '';

        if ($this->getdatainativacao() != '') {
            $query = "update empresa set datainativacao = null where idempresa = :idempresa";
        } else {
            $query = "update empresa set datainativacao = now() where idempresa = :idempresa";
        }

        $sql->query($query, array(
            ':idempresa' => $this->getidempresa()
        ));
    }

}
?>