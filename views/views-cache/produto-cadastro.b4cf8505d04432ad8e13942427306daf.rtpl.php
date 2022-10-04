<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Cadastro de Produto</h3>
      </div>
      <div class="card-body p-0">
        <div class="bs-stepper">
          <div class="bs-stepper-header" role="tablist">
            <!-- Configuração do cabecalho do passo a passo -->
            <div class="step" data-target="#dadosproduto-part">
              <button type="button" class="step-trigger" role="tab" aria-controls="dadosproduto-part"
                id="dadosproduto-part-trigger">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Dados</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#codbarras-part">
              <button type="button" class="step-trigger" role="tab" aria-controls="codbarras-part"
                id="codbarras-part-trigger">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Códigos de Barra</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#fotos-part">
              <button type="button" class="step-trigger" role="tab" aria-controls="fotos-part" id="fotos-part-trigger">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Fotos</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content">
            <!-- Dados Iniciais do produto 
              -->
            <div id="dadosproduto-part" class="content" role="tabpanel" aria-labelledby="dadosproduto-part-trigger">
              <div class="card-body">
                <div class="form-group">
                  <div class="form-line row">
                    <input class="form-control" type="hidden" name="idproduto" id="idproduto" value=""
                      readonly="readonly">
                    <div class="col-6">
                      <label for="descricao" id="labeldescricao">Descrição</label>
                      <input type="text" class="form-control" maxlength="100" id="descricao" name="descricao"
                        placeholder="Digite a descrição resumida do produto">
                    </div>
                    <div class="col-4">
                      <label for="ncm" id="labelncm">NCM</label>
                      <input class="form-control" type="text" name="ncm" id="ncm" value="" maxLength="8" />
                    </div>
                    <div class="col-2">
                      <label for="unidademedida" id="labelunidademedida">Unidade Medida</label>
                      <input class="form-control" type="text" name="unidademedida" id="unidademedida" maxLength="5" />
                    </div>

                  </div>
                </div>
                <div class="form-group">
                  <div class="form-line row">
                    <!-- Loop das marcas -->
                    <div class="col-sm">
                      <label id="labelmarca" for="idmarca">Marca</label>
                      <select class="form-control" id="idmarca" name="idmarca">
                        <option id="0" value="0">Selecione a marca</option>
                        <?php $counter1=-1;  if( isset($marcas) && ( is_array($marcas) || $marcas instanceof Traversable ) && sizeof($marcas) ) foreach( $marcas as $key1 => $value1 ){ $counter1++; ?>
                        <option id="<?php echo htmlspecialchars( $value1["idmarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idmarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomemarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <!-- Loop dos grupos -->
                    <div class="col-sm">
                      <label id="labelgrupo" for="idgrupo">Grupo</label>
                      <select class="form-control" id="idgrupo" name="idgrupo">
                        <option id="0" value="0">Selecione o grupo</option>
                        <?php $counter1=-1;  if( isset($grupos) && ( is_array($grupos) || $grupos instanceof Traversable ) && sizeof($grupos) ) foreach( $grupos as $key1 => $value1 ){ $counter1++; ?>
                        <option id="<?php echo htmlspecialchars( $value1["idgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomegrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <!-- Loop dos subgrupos -->
                    <div class="col-sm">
                      <label id="labelsubgrupo" for="idsubgrupo">Subgrupo</label>
                      <select class="form-control" id="idsubgrupo" name="idsubgrupo">
                        <option id="0" value="0">Selecione o subgrupo</option>
                        <?php $counter1=-1;  if( isset($subgrupos) && ( is_array($subgrupos) || $subgrupos instanceof Traversable ) && sizeof($subgrupos) ) foreach( $subgrupos as $key1 => $value1 ){ $counter1++; ?>
                        <option id="<?php echo htmlspecialchars( $value1["idsubgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idsubgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomesubgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-line row">
                    <div class="col-sm">
                      <label for="descricaodetalhada" id="labeldescricaodetalhada">Descrição detalhada</label>
                      <textarea class="form-control" id="descricaodetalhada" name="descricaodetalhada" rows="3"
                        placeholder="Digite a descrição detalhada" maxlength="500"></textarea>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary" id="salvarecontinuar" onclick="validarCampos()">Salvar e continuar <i
                    class="fa fa-arrow-right"></i></button>
              </div>
            </div>
            <!--</form>-->
            <!-- Fim dos dados iniciais do produto -->
            <!-- Inicio código de barras -->
            <div id="codbarras-part" class="content" role="tabpanel" aria-labelledby="codbarras-part-trigger">
              <div class="card-body">
                <div class="form-group">
                  <div class="form-line row">
                    <div class="col-sm">
                      <label for="descricaodetalhada" id="labelcodigobarraproduto">Código de Barras</label>
                      <div class="input-group input-group-mb-3">
                        <input type="text" class="form-control" id="codigobarraproduto"
                          place="Digite o código de barras do produto" />
                        <span class="input-group-append">
                          <button type="button" onclick="validarCamposCodigoBarraProduto()"
                            class="btn btn-primary btn-flat" id="adicionarcodigobarraproduto">Adicionar</button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Loop dos códigos de barras já cadastrados
                <?php $counter1=-1;  if( isset($codigobarraprodutos) && ( is_array($codigobarraprodutos) || $codigobarraprodutos instanceof Traversable ) && sizeof($codigobarraprodutos) ) foreach( $codigobarraprodutos as $key1 => $value1 ){ $counter1++; ?>
                <div class="form-group">
                </div>
                <div id="espacoadd">
                  <div class="form-line row">
                    <div class="col-sm">
                      <div class="input-group input-group-mb-3">
                        <input type="text" class="form-control" id="<?php echo htmlspecialchars( $value1["idcodigobarraproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["codigobarra"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled />
                        <span class="input-group-append">
                          <button type="button" class="btn btn-danger btn-flat">Remover</button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>-->
                <div id="espacoadd">

                </div>



                <div class="form-group">
                </div>

                  <button class="btn btn-primary" onclick="stepper.previous()">Voltar <i
                      class="fa fa-arrow-left"></i></button>
                  <button class="btn btn-primary" onclick="stepper.next()">Salvar e continuar
                    <i class="fa fa-arrow-right"></i></button>
                </div>
              
            </div>
          </div>
          <!-- Fim código de barras -->
          <!-- Inicio fotos produto -->

          <div id="fotos-part" class="content" role="tabpanel" aria-labelledby="fotos-part-trigger">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputFile">Fotos</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Escolha o arquivo</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Salvar</span>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" onclick="stepper.previous()">Voltar <i
                  class="fa fa-arrow-left"></i></button>
              <button class="btn btn-primary" onclick="">Finalizar</i></button>
            </div>
          </div>
          <!-- Fim fotos produto -->

        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">

    </div>
  </div>
  <!-- /.card -->
</div>
</div>
<!-- /.row -->

<script>
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  });

  function layoutPadraoModal() {
    document.getElementById('labeldescricao').innerHTML = "Descrição";
    document.getElementById('labelgrupo').innerHTML = "Grupo";
    document.getElementById('labelmarca').innerHTML = "Marca";
    document.getElementById('descricao').classList.remove("is-invalid");
    document.getElementById('idgrupo').classList.remove("is-invalid");
    document.getElementById('idmarca').classList.remove("is-invalid");
    document.getElementById("salvarecontinuar").disabled = false;
  }

  function validarCampos() {
    console.log('Entrei na função de validação de campos');
    layoutPadraoModal();
    if (document.getElementById("descricao").value == '') {
      document.getElementById('labeldescricao').innerHTML = "<FONT COLOR='red'>A descrição é obrigatória</FONT>";
      document.getElementById('descricao').classList.remove("is-valid");
      document.getElementById('descricao').classList.add("is-invalid");
      $("#descricao").focus();
    } else if (document.getElementById("idmarca").value == 0) {
      document.getElementById('labelmarca').innerHTML = "<FONT COLOR='red'>A marca é obrigatória</FONT>";
      document.getElementById('idmarca').classList.remove("is-valid");
      document.getElementById('idmarca').classList.add("is-invalid");
    } else if (document.getElementById("idgrupo").value == 0) {
      document.getElementById('labelgrupo').innerHTML = "<FONT COLOR='red'>O grupo é obrigatório</FONT>";
      document.getElementById('idgrupo').classList.remove("is-valid");
      document.getElementById('idgrupo').classList.add("is-invalid");
    } else {
      gravarDados();
    }
  }


  function gravarDados() {
    layoutPadraoModal();
    document.getElementById("salvarecontinuar").disabled = true; //desabilitar o botão pra nao deixar apertar varias vezes
    var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/produto";
    var dados = "";
    dados = "idproduto=" + document.getElementById("idproduto").value
      + "&descricao=" + document.getElementById("descricao").value
      + "&ncm=" + document.getElementById("ncm").value
      + "&unidademedida=" + document.getElementById("unidademedida").value
      + "&idmarca=" + document.getElementById("idmarca").value
      + "&idgrupo=" + document.getElementById("idgrupo").value
      + "&descricaodetalhada=" + document.getElementById("descricaodetalhada").value;

    if (document.getElementById("idsubgrupo").value != "0") {
      dados += "&idsubgrupo=" + document.getElementById("idsubgrupo").value;
    }


    console.log("Variavel dados: " + dados);
    console.log("URL:" + url + "/cadastrar" + dados);

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
          text: 'Não foi possível salvar o produto!',
          showConfirmButton: true,
          timer: 10000
        }).then(function () {
          window.location.href = window.location.href = url;
          document.getElementById("salvarecontinuar").disabled = false; //se der erro habilitar o salvar de novo
        })
      },
      success: function (data) {
        if (data.resultado == 'ok' && data.idproduto != '') {
          document.getElementById("idproduto").value = data.idproduto; //passar o campo do idproduto cadastrado para o campo do formulario que está escondido.
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Sucesso',
            text: 'Produto salvo com sucesso',
            showConfirmButton: true,
            timer: 10000
          }).then(function () {
            stepper.next();
            layoutPadraoModal();
          })
        }
      }
    });
  }

  function layoutPadraoModalCodigoBarraProduto() {
    document.getElementById('labelcodigobarraproduto').innerHTML = "Código de Barras";
    document.getElementById('codigobarraproduto').classList.remove("is-invalid");
    document.getElementById("adicionarcodigobarraproduto").disabled = false;
  }

  function validarCamposCodigoBarraProduto() {
    console.log('Entrei na função de validação de campos do código de barras');
    layoutPadraoModalCodigoBarraProduto();
    if (document.getElementById("codigobarraproduto").value == '') {
      document.getElementById('labelcodigobarraproduto').innerHTML = "<FONT COLOR='red'>O código de barras é obrigatório</FONT>";
      document.getElementById('codigobarraproduto').classList.remove("is-valid");
      document.getElementById('codigobarraproduto').classList.add("is-invalid");
      $("#codigobarraproduto").focus();
    } else {
      gravarDadosCodigoBarraProduto();
    }

  }

  function gravarDadosCodigoBarraProduto() {
    console.log("entrei na gravarDadosCodigoBarraProduto");
    document.getElementById("adicionarcodigobarraproduto").disabled = true;
    var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/codigobarraproduto";
    var dados = "";
    dados = "idproduto=" + document.getElementById("idproduto").value
      + "&codigobarra=" + document.getElementById("codigobarraproduto").value;

    console.log("variavel dados: " + dados);

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
          text: 'Não foi possível salvar o codigo de barras do produto!',
          showConfirmButton: true,
          timer: 10000
        }).then(function () {
          window.location.href = url;
          document.getElementById("adicionarcodigobarraproduto").disabled = false; //se der erro habilitar o salvar de novo
        })
      },
      success: function (data) {
        if (data.resultado == 'ok' && data.idproduto != '' && data.codigobarra != '' && data.idcodigobarraproduto != '') {
          addLinhaCodBarraHTML(data.idcodigobarraproduto, data.codigobarra);
          document.getElementById("adicionarcodigobarraproduto").disabled = false;
        }
      }
    });


  }

  function addLinhaCodBarraHTML(idcodigobarraproduto, codigobarra) {
    var html = '<div class="form-group"></div><div class="form-line row">'
      + '<div class="col-sm">'
      + '<div class="input-group input-group-mb-3">'
      + '<input type="text" class="form-control" id="' + idcodigobarraproduto + '" value="' + codigobarra + '" disabled/>'
      + '<span class="input-group-append">'
      + '<button type="button" class="btn btn-danger btn-flat">Remover</button>'
      + '</span></div></div></div> ';
    $("#espacoadd").append(html);
  }


</script>