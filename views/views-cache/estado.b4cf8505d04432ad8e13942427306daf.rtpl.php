<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Container Principal -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">   
            
            <div class="box-header">    
                     
              <div class="box-tools">               
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                  Cadastrar
                </button>  
                <br>
              </div>
            </div>            

            <div class="card">            
              <div class="card-header">
                <h3 class="card-title">Listagem de Estados</h3>
                <div class="card-tools">                  
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Pesquisar">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap table-striped">
                  <thead>
                    <tr>
                      <th>Sigla</th>
                      <th>Nome</th>
                      <th>Cód. IBGE</th>
                      <th>Cód. Pais IBGE</th>
                      <th>Situação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if( $numRegistros == 0 ){ ?>

                    <tr>
                      <td>Nenhum registro encontrado</td>
                    </tr>  
                    <?php } ?>                    
                    <?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>

                    <tr>
                      <td><?php echo htmlspecialchars( $value1["siglaEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["nomeEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["codigoEstadoIBGE"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["codigoPaisIBGE"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><button type="button" class="btn btn-primary btn-block"><i class="fa fa-edit"></i>Editar</button></td>
                      <td><button type="button" class="btn btn-danger btn-block"><i class="fa fa-edit"></i>Inativar</button></td>
                    </tr>   
                    <?php } ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                  <li class="page-item"><a class="page-link" href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                <?php } ?>

              </ul>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.card-body -->
          
        </div>        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->

      <!-- inicio da modal -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cadastro de Estado</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <!-- Formulario do Modal -->
                <form id="cadastroEstado">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="form-line row"> 
                        <input class="form-control" type="hidden" name="idEstado" id="idEstado" value="" readonly="readonly"/>                   
                        <div class="col-sm">
                          <label for="siglaEstado" id="labelSigla">Sigla</label>
                          <input type="text" class="form-control" maxlength="2" id="siglaEstado" name="siglaEstado" placeholder="Digite a sigla do estado">
                        </div>
                        <div class="col-sm">
                          <label for="nomeEstado" id= "labelNome">Nome</label>
                          <input type="text" class="form-control" id="nomeEstado" name="nomeEstado" placeholder="Digite o nome do estado">
                        </div>
                      </div>                      
                    </div>

                    <div class="form-group">
                      <div class="form-line row">                    
                        <div class="col-sm">
                          <label for="codigoEstadoIBGE">Código IBGE</label>
                          <input type="number" class="form-control" id="codigoEstadoIBGE" name="codigoEstadoIBGE" placeholder="Digite o código IBGE do estado">
                        </div>
                        <div class="col-sm">
                          <label for="codigoPaisIBGE">Código País IBGE</label>
                          <input type="text" class="form-control" id="codigoPaisIBGE" name="codigoPaisIBGE" placeholder="Digite o código IBGE do país">
                        </div>
                      </div>                      
                    </div>

                    <div class="form-group">
                      <div class="form-line row">                    
                        <div class="col-sm">
                          <label for="nomePais">Nome País</label>
                          <input type="text" class="form-control" id="nomePais" name="nomePais" placeholder="Digite nome do país">
                        </div>                       
                      </div>                      
                    </div>                  
                    
                   
                  </div>
                  <!-- /.card-body --> 
                </form>
                <!-- /Formulario do Modal -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" onclick="validarCampos()" class="btn btn-primary">Salvar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->

    <script type="text/javascript" language="javascript">            
      function layoutPadraoModal(){
        document.getElementById('labelSigla').innerHTML = "Sigla";
          document.getElementById('siglaEstado').classList.remove("is-invalid");
          document.getElementById('labelNome').innerHTML = "Nome";
          document.getElementById('nomeEstado').classList.remove("is-invalid");
      }

      function validarCampos(){
          console.log('Entrei na função de validação de campos');
          layoutPadraoModal();       

        if (document.getElementById("siglaEstado").value == '') {
                document.getElementById('labelSigla').innerHTML = "<FONT COLOR='red'>A Sigla é obrigatória</FONT>";
                document.getElementById('siglaEstado').classList.remove("is-valid");
                document.getElementById('siglaEstado').classList.add("is-invalid");
                $("#siglaEstado").focus();
        } else if (document.getElementById("nomeEstado").value == '') {
                document.getElementById('labelNome').innerHTML = "<FONT COLOR='red'>O nome é obrigatório</FONT>";
                document.getElementById('nomeEstado').classList.remove("is-valid");
                document.getElementById('nomeEstado').classList.add("is-invalid");
                $("#nomeEstado").focus();
        }else{
          gravarDados();
        }

      }

   

    function gravarDados(){
      layoutPadraoModal();
      var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/estado";
      console.log(""+url);
      var dados = $('#cadastroEstado').serialize();
      console.log("Variavel dados: "+dados);         
        $.ajax({
          asyc:false,
          type:"POST",
          url: url + "/cadastrar",
          data: dados,
            /*"siglaEstado=" + document.getElementById("siglaEstado").value 
            + "&nomeEstado=" + document.getElementById("nomeEstado").value            
            + "&codigoEstadoIBGE=" + document.getElementById("codigoEstadoIBGE").value
            + "&codigoPaisIBGE=" + document.getElementById("codigoPaisIBGE").value
            + "&nomePais=" + document.getElementById("nomePais").value,*/
          dataType: "json",
          error: function (xhr) {
            alert("Problemas ao  cadastrar! Erro: " + xhr.status);
          },
          success: function (data) {
            if (data.resultado == 'ok') {
              window.location.href = url;
            }
          }
        });
      }

      function limparModal(){
        $('#idEstado').val("0");
        $('#siglaEstado').val("");
        $('#nomeEstado').val("");
        $('#codigoEstadoIBGE').val("");
        $('#codigoPaisIBGE').val("");
        $('#nomePais').val("");       
      }



    </script>

  