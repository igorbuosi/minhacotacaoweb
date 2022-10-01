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
                <button type="button" class="step-trigger" role="tab" aria-controls="dadosproduto-part" id="dadosproduto-part-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Dados</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#codbarras-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="codbarras-part" id="codbarras-part-trigger">
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
              <!-- Dados Iniciais do produto -->
              <div id="dadosproduto-part" class="content" role="tabpanel" aria-labelledby="dadosproduto-part-trigger">
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-line row"> 
                    <input class="form-control" type="hidden" name="idproduto" id="idproduto" value="" readonly="readonly">                   
                        <div class="col-6">
                          <label for="descricao" id="labeldescricao">Descrição</label>
                          <input type="text" class="form-control" maxlength="100" id="descricao" name="descricao" placeholder="Digite a descrição resumida do produto">
                        </div>
                        <div class="col-4">
                          <label for="ncm" id="labelncm">NCM</label>
                          <input class="form-control" type="text" name="ncm" id="ncm" value="" maxLength="8"/>                    
                        </div>                    
                        <div class="col-2">
                          <label for="unidademedida" id="labelunidademedida">Unidade Medida</label>
                          <input class="form-control" type="text" name="unidademedida" id="unidademedida" maxLength="5"/>
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
                          <textarea class="form-control" id="descricaodetalhada" name="descricaodetalhada" rows="3" placeholder="Digite a descrição detalhada" maxlength="500"></textarea>                    
                        </div>                  
                    </div>
                  </div>
                  <button class="btn btn-primary" id="salvarecontinuar" onclick="validarCampos()">Salvar e continuar <i class="fa fa-arrow-right"></i></button>
                </div> 
              </div>
              <!-- Fim dos dados iniciais do produto -->
              <!-- Inicio código de barras -->
              <div id="codbarras-part" class="content" role="tabpanel" aria-labelledby="codbarras-part-trigger">
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-line row"> 
                      <div class="col-sm">
                        <label for="descricaodetalhada" id="labeldescricaodetalhada">Código de Barras</label>
                        <div class="input-group input-group-mb-3">
                          <input type="text" class="form-control" place="Digite o código de barras do produto"/>
                          <span class="input-group-append">
                            <button type="button" class="btn btn-primary btn-flat">Adicionar</button>
                          </span>
                        </div>
                      </div>                    
                    </div>
                  </div>
                    <!-- Loop dos códigos de barras já cadastrados-->
                    <div class="form-line row"> 
                      <div class="col-sm">
                        <div class="input-group input-group-mb-3">
                          <input type="text" class="form-control" value = "789456123" disabled/>
                          <span class="input-group-append">
                            <button type="button" class="btn btn-danger btn-flat">Remover</button>
                          </span>
                        </div>
                      </div>                    
                    </div>

                    <div class="form-group">                      
                    </div>

                       
                  <button class="btn btn-primary" onclick="stepper.previous()">Voltar <i class="fa fa-arrow-left"></i></button>
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
                <button class="btn btn-primary" onclick="stepper.previous()">Voltar <i class="fa fa-arrow-left"></i></button>
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

  function layoutPadraoModal(){
            document.getElementById('labeldescricao').innerHTML = "Descrição";
            document.getElementById('labelgrupo').innerHTML = "Estado";
            document.getElementById('labelmarca').innerHTML = "Marca";
            document.getElementById('descricao').classList.remove("is-invalid");
            document.getElementById('idgrupo').classList.remove("is-invalid");
            document.getElementById('idmarca').classList.remove("is-invalid");
            document.getElementById("salvarecontinuar").disabled = false;
        }

  function validarCampos(){
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
          }else if (document.getElementById("idgrupo").value == 0) {
                  document.getElementById('labelgrupo').innerHTML = "<FONT COLOR='red'>O grupo é obrigatório</FONT>";
                  document.getElementById('idgrupo').classList.remove("is-valid");
                  document.getElementById('idgrupo').classList.add("is-invalid");
          }else{
            //gravarDados();
            stepper.next();
          }
        }


  </script>