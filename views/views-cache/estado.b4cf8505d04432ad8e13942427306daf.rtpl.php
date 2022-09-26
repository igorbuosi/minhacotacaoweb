<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Container Principal -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">   
            
            <div class="card-header">
              <div class="box-header">   
                      
                <div class="box-tools">               
                  <button type="button" onclick="setDadosModal(0)"
                    class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                    Cadastrar
                  </button>  
                  <br>
                </div>
              </div>    
            </div>        

            <div class="card">            
              <div class="card-header">
                <h3 class="card-title">Listagem de Estados</h3>
                <div class="card-tools">     
                  <form action="/painel/estado">            
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control float-right" placeholder="Pesquisar">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form> 
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
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>  
                    <?php } ?>                    
                    <?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>

                    <tr>
                      <td><?php echo htmlspecialchars( $value1["siglaEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["nomeEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["codigoEstadoIBGE"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["codigoPaisIBGE"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><a href="" data-toggle="modal" data-target="#modal-lg" 
                        onclick='setDadosModal(<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)' 
                        class="btn btn-primary btn-block">
                        <i class="fa fa-edit"></i>Editar</a>
                      </td>
                      <td>
                        <?php if( $value1["situacao"] == 'I' ){ ?> 
                          <a class="btn btn-success btn-block" onclick="deletar(<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                          <i class="fa fa-edit"></i>                        
                            Ativar 
                          </a>                        
                        <?php } ?>

                        <?php if( $value1["situacao"] == 'A' ){ ?> 
                          <a class="btn btn-danger btn-block" onclick="deletar(<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                          <i class="fa fa-edit"></i>                        
                            Inativar 
                          </a>                        
                        <?php } ?>                     
                      </td>
                    </tr>   
                    <?php } ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-left">
                <li class="page-item"><a class="page">Total de registros: <?php echo htmlspecialchars( $numRegistros, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
              </ul>
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
              <h4 class="modal-title" id="tituloModal">Cadastro de Estado</h4>
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
              <button type="button" id="salvar" onclick="validarCampos()" class="btn btn-primary">Salvar</button>
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

      var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/estado";     

      function layoutPadraoModal(){
          document.getElementById('labelSigla').innerHTML = "Sigla";
          document.getElementById('siglaEstado').classList.remove("is-invalid");
          document.getElementById('labelNome').innerHTML = "Nome";
          document.getElementById('nomeEstado').classList.remove("is-invalid");
          document.getElementById('tituloModal').innerHTML = "Cadastro de Estado"
          document.getElementById("salvar").disabled = false;
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
      document.getElementById("salvar").disabled = true; //desabilitar o botão pra nao deixar apertar varias vezes
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
            Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Erro',
                  text: 'Não foi possível salvar estado!',
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
                    text: 'Estado salvo com sucesso',
                    showConfirmButton: true,
                    timer: 10000
                }).then(function () {
                    window.location.href = window.location.href = url;
            })              
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

      function setDadosModal(valor){        
        limparModal();
        layoutPadraoModal();
        document.getElementById('idEstado').value = valor;
        var idEstado = valor;
        if (idEstado != "0"){
          document.getElementById('tituloModal').innerHTML = "Alteração de Estado"
          $.getJSON({
            asyc:false,
            type:"GET",
            url: url + "/" + valor,
            error: function (xhr) {
              alert("Problemas ao  carregar! Erro: " + xhr.status);
            },
            success: function (respostaServlet) {
              $('#idEstado').val(respostaServlet.idestado);
              $('#siglaEstado').val(respostaServlet.siglaEstado);
              $('#nomeEstado').val(respostaServlet.nomeEstado);
              $('#codigoEstadoIBGE').val(respostaServlet.codigoEstadoIBGE);
              $('#codigoPaisIBGE').val(respostaServlet.codigoPaisIBGE);
              $('#nomePais').val(respostaServlet.nomePais);          
            }
        });

        }
      }

      function deletar(idEstado, situacao){
        var titulo = "";
        var tituloConfirmacao = "";
        var confirmButtonText = "";

        if (situacao == 'I') {
            titulo = "Você deseja realmente ativar o estado?";
            confirmButtonText = "Sim, ative o estado!";
            tituloConfirmacao = "Estado ativado com sucesso!";

        } else {
            titulo = "Você deseja realmente inativar o estado?";
            confirmButtonText = "Sim, inative o estado!";
            tituloConfirmacao = "Estado inativado com sucesso!";
        }

        Swal.fire({
            title: 'Você tem certeza?',
            text: titulo,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
              $.getJSON({
                type: 'GET',
                url: url + "/deletar/" + idEstado,
                success:
                        function (data) {
                            if (data.resultado == 'ok') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Sucesso',
                                    text: tituloConfirmacao,
                                    showConfirmButton: true,
                                    timer: 10000
                                }).then(function () {
                                  window.location.href = window.location.href = url;
                                })
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Erro',
                                    text: 'Não foi possível ativar/inativar estado!',
                                    showConfirmButton: true,
                                    timer: 10000
                                }).then(function () {
                                  window.location.href = window.location.href = url;
                                })
                            }
                        },
                error:
                        function (data) {
                          window.location.href = window.location.href = url;
                        }
                });
            };
        });


      }
    </script>

  