<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/">Home</a>
                <a class="breadcrumb-item text-dark" href="/empresa">Empresa</a>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cadastro de
                    Empresa</span></h5>
            <div class="bg-light p-30 mb-5">
                <input class="form-control" type="hidden" name="idpessoa" id="idpessoa" value="" readonly="readonly" />
                <input class="form-control" type="hidden" name="idpessoajuridica" id="idpessoajuridica" value=""
                    readonly="readonly" />
                <input class="form-control" type="hidden" name="idempresa" id="idempresa" value=""
                    readonly="readonly" />
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label id="labelcpfcnpj">CNPJ</label>
                        <input class="form-control" id="cnpj" name="cnpj" value="" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Inscrição Estadual</label>
                        <input class="form-control" id="ie" name="ie" value="" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                        <label id="labelnomecompleto">Nome Fantasia</label>
                        <input class="form-control" id="nomecompleto" name="nomecompleto" value="" type="text"
                            placeholder="Doe">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Razão Social</label>
                        <input class="form-control" id="razaosocial" name="razaosocial" value="" type="text">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>CEP</label>
                        <input class="form-control" type="text" name="ceppessoa" id="ceppessoa" value=""
                            placeholder="00000-000" oninput="criaMascaraCEP('ceppessoa')" maxLength="8" />
                    </div>

                    <div class="col-md-8 form-group">
                        <label>Endereço</label>
                        <input class="form-control" id="endereco" name="endereco" value="" type="text">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Nº</label>
                        <input class="form-control" id="numendereco" name="numendereco" value="" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Bairro</label>
                        <input class="form-control" id="bairro" name="bairro" value="" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Complemento</label>
                        <input class="form-control" id="complemento" name="complemento" value="" type="text">
                    </div>

                    <div class="col-md-6 form-group">
                        <label id="labelestado" for="idestado">Estado</label>
                        <select class="form-control" id="idestado" name="idestado">
                            <?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>
                            <option id="<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label id="labelcidade" for="idcidade">Cidade</label>
                        <select class="form-control" id="idcidade" name="idcidade">
                            <?php $counter1=-1;  if( isset($cidades) && ( is_array($cidades) || $cidades instanceof Traversable ) && sizeof($cidades) ) foreach( $cidades as $key1 => $value1 ){ $counter1++; ?>
                            <option id="<?php echo htmlspecialchars( $value1["idcidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idcidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomecidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Telefone</label>
                        <input class="form-control" value="" placeholder="(00) 00000-0000"
                            oninput="criaMascaraTelefone('tel1')" maxLength="11" id="tel1" name="tel1" type="text">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Celular</label>
                        <input class="form-control" value="" placeholder="(00) 00000-0000"
                            oninput="criaMascaraTelefone('tel2')" maxLength="11" id="tel2" name="tel2" type="text">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" id="email" name="email" type="text" placeholder="example@email.com">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Site</label>
                        <input class="form-control" id="site" name="site" type="text">
                    </div>

                    <div class="col-md-3 form-group">
                        <label>Login</label>
                        <input class="form-control" id="login" name="login" value="" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Senha</label>
                        <input class="form-control" id="senha" name="senha" value="" type="password">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Repita sua senha</label>
                        <input class="form-control" id="confirmacaosenha" name="confirmacaosenha" value=""
                            type="password">
                    </div>
                    <div class="col-md-3 form-group">
                        <label> &nbsp;</label>
                        <button id="salvar" onclick="validarCampos()"
                            class="btn btn-block btn-primary font-weight-bold">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Checkout End -->

<script type="text/javascript" language="javascript">
    function validarCampos() {

        /* CAMPOS OBRIGATORIOS
        cnpj varchar(45) 
    ie varchar(45) 
    razaosocial varchar(100)
    nomecompleto varchar(100) 
    datainsert datetime 
    ceppessoa varchar(10) 
    endereco varchar(100) 
    numendereco varchar(10) 
    bairro varchar(50) 
    complemento varchar(45)
    login varchar(45) 
    senha varchar(45) 
    tipopessoa char(1) 
    tel1 varchar(15)*/

        console.log('Entrei na função de validação de campos');
        if (document.getElementById("nomecompleto").value == '') {
            document.getElementById('labelnomecompleto').innerHTML = "<FONT COLOR='red'>O nome fantasia é obrigatório</FONT>";
            document.getElementById('nomecompleto').classList.remove("is-valid");
            document.getElementById('nomecompleto').classList.add("is-invalid");
            $("#nomecompleto").focus();
        } else {
            gravarDados();
        }
    }


    function gravarDados() {
        document.getElementById("salvar").disabled = true; //desabilitar o botão pra nao deixar apertar varias vezes
        var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/empresa";
        console.log("" + url);
        //var dados = $('#cadastroempresa').serialize();
        console.log("Variavel dados: " + dados);

        var dados = "";
        dados = "idpessoa=" + document.getElementById("idpessoa").value
            + "&idpessoajuridica=" + document.getElementById("idpessoajuridica").value
            + "&idempresa=" + document.getElementById("idempresa").value
            + "&cnpj=" + document.getElementById("cnpj").value
            + "&ie=" + document.getElementById("ie").value
            + "&nomecompleto=" + document.getElementById("nomecompleto").value
            + "&razaosocial=" + document.getElementById("razaosocial").value
            + "&ceppessoa=" + document.getElementById("ceppessoa").value
            + "&endereco=" + document.getElementById("endereco").value
            + "&numendereco=" + document.getElementById("numendereco").value
            + "&bairro=" + document.getElementById("bairro").value
            + "&complemento=" + document.getElementById("complemento").value
            + "&idestado=" + document.getElementById("idestado").value
            + "&idcidade=" + document.getElementById("idcidade").value
            + "&tel1=" + document.getElementById("tel1").value
            + "&tel2=" + document.getElementById("tel2").value
            + "&site=" + document.getElementById("site").value
            + "&login=" + document.getElementById("login").value
            + "&senha=" + document.getElementById("senha").value
            + "&email=" + document.getElementById("email").value;

        $.ajax({
            asyc: false,
            type: "POST",
            url: url + "/cadastrar",
            data: dados,
            dataType: "json",
            error: function (xhr) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Erro',
                    text: 'Não foi possível salvar empresa!',
                    showConfirmButton: true,
                    timer: 10000
                }).then(function () {
                    window.location.href = window.location.href = url;
                    document.getElementById("salvar").disabled = false; //se der erro habilitar o salvar de novo
                })
            },
            success: function (data) {
                if (data.resultado == 'ok') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Empresa salva com sucesso! \n Aguarde seu perfil ser verificado para logar!',
                        showConfirmButton: true,
                        timer: 10000
                    }).then(function () {
                        window.location.href = window.location.href = url;
                    })
                }
            }
        });
    }
</script>