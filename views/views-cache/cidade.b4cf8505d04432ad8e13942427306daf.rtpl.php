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
                  <h3 class="card-title">Listagem de Cidades</h3>
                  <div class="card-tools">     
                    <form action="/painel/cidade">            
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
                        <th>Nome</th>
                        <th>CEP Padrão</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if( $numRegistros == 0 ){ ?>
                      <tr>
                        <td>Nenhum registro encontrado</td>
                        <td></td>
                        <td></td>
                      </tr>  
                      <?php } ?>                    
                      <?php $counter1=-1;  if( isset($cidades) && ( is_array($cidades) || $cidades instanceof Traversable ) && sizeof($cidades) ) foreach( $cidades as $key1 => $value1 ){ $counter1++; ?>
                      <tr>
                        <td><?php echo htmlspecialchars( $value1["nomecidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo htmlspecialchars( $value1["ceppadrao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo htmlspecialchars( $value1["nomeestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><a href="" data-toggle="modal" data-target="#modal-lg" 
                          onclick='setDadosModal(<?php echo htmlspecialchars( $value1["idcidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)' 
                          class="btn btn-primary btn-block">
                          <i class="fa fa-edit"></i>Editar</a>
                        </td>
                        <td>
                          <?php if( $value1["situacao"] == 'I' ){ ?> 
                            <a class="btn btn-success btn-block" onclick="deletar(<?php echo htmlspecialchars( $value1["idcidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                            <i class="fa fa-edit"></i>                        
                              Ativar 
                            </a>                        
                          <?php } ?>
                          <?php if( $value1["situacao"] == 'A' ){ ?> 
                            <a class="btn btn-danger btn-block" onclick="deletar(<?php echo htmlspecialchars( $value1["idcidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
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
                <h4 class="modal-title" id="tituloModal">Cadastro de Cidade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <!-- Formulario do Modal -->
                  <form id="cadastrocidade">
                    <div class="card-body">
                      <div class="form-group">
                        <div class="form-line row"> 
                          <input class="form-control" type="hidden" name="idcidade" id="idcidade" value="" readonly="readonly"/>                   
                          <div class="col-sm">
                            <label for="nomecidade" id="labelnome">Nome</label>
                            <input type="text" class="form-control" maxlength="100" id="nomecidade" name="nomecidade" placeholder="Digite o nome da cidade">
                          </div>
                          <div class="col-sm">
                            <label for="ceppadrao" id="labelcep">CEP</label>
                            <input class="form-control" type="text" name="ceppadrao" id="ceppadrao" value="" placeholder="00000-000" oninput="criaMascaraCEP('ceppadrao')" maxLength="8"/>
                          </div>
                        </div>                      
                      </div>  
                      <div class="form-group">
                        <div class="form-line row">                    
                          <div class="col-sm">
                            <label for="codigoibge">Código IBGE</label>
                            <input type="number" class="form-control" id="codigoibge" name="codigoibge" placeholder="Digite o código IBGE da cidade">
                          </div>
                          <div class="col-sm">
                            <label for="ddd">Código DDD Cidade</label>
                            <input type="text" class="form-control" id="ddd" name="ddd" placeholder="Digite o ddd da cidade">
                          </div>

                            <div class="col-sm">
                                <label id="labelestado" for="idestado">Estado</label>
                                    <select class="form-control" id="idestado" name="idestado">
                                        <?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>
                                        <option id="<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                        <?php } ?>
                                    </select>
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
        var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/cidade";     

        function menuAtivo() {
          document.getElementById('titulopainel').innerHTML = "<strong>Cidade</strong>";
          document.getElementById('menucidade').classList.add("active");
          document.getElementById('agrupamentolocalizacao').classList.add("menu-open");
          document.getElementById('menulocalizacao').classList.add("active");
        }

        $(document).ready(function () {
            menuAtivo();
        });
  
        function layoutPadraoModal(){
            document.getElementById('labelnome').innerHTML = "Nome";
            document.getElementById('labelestado').innerHTML = "Estado";
            document.getElementById('nomecidade').classList.remove("is-invalid");
            document.getElementById('idestado').classList.remove("is-invalid");
            document.getElementById('tituloModal').innerHTML = "Cadastro de Cidade"
            document.getElementById("salvar").disabled = false;
        }
  
        function validarCampos(){
            console.log('Entrei na função de validação de campos');
            layoutPadraoModal();       
  
          if (document.getElementById("nomecidade").value == '') {
                  document.getElementById('labelnome').innerHTML = "<FONT COLOR='red'>O nome é obrigatório</FONT>";
                  document.getElementById('nomecidade').classList.remove("is-valid");
                  document.getElementById('nomecidade').classList.add("is-invalid");
                  $("#nomecidade").focus();
          } else if (document.getElementById("idestado").value == 0) {
                  document.getElementById('labelestado').innerHTML = "<FONT COLOR='red'>O estado é obrigatório</FONT>";
                  document.getElementById('idestado').classList.remove("is-valid");
                  document.getElementById('idestado').classList.add("is-invalid");
          }else{
            gravarDados();
          }
        }
  
      function gravarDados(){
        layoutPadraoModal();
        document.getElementById("salvar").disabled = true; //desabilitar o botão pra nao deixar apertar varias vezes
        var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/cidade";
        console.log(""+url);
        var dados = $('#cadastrocidade').serialize();
        console.log("Variavel dados: "+dados);         
          $.ajax({
            asyc:false,
            type:"POST",
            url: url + "/cadastrar",
            data: dados,
            dataType: "json",
            error: function (xhr) {
              Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Erro',
                    text: 'Não foi possível salvar cidade!',
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
                      text: 'Cidade salva com sucesso',
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
          $('#idcidade').val("0");
          $('#nomecidade').val("");
          $('#ceppadrao').val("");
          $('#codigoibge').val("");
          $('#ddd').val(""); 
          document.getElementById('idestado').value = 0;
        }
  
        function setDadosModal(valor){        
          limparModal();
          layoutPadraoModal();
          
          
          var idcidade = valor;
          if (idcidade != "0"){
            
            document.getElementById('tituloModal').innerHTML = "Alteração de Cidade"
            $.getJSON({
              asyc:false,
              type:"GET",
              url: url + "/" + valor,
              error: function (xhr) {
                alert("Problemas ao  carregar! Erro: " + xhr.status);
              },
              success: function (respostaServlet) {
                $('#idcidade').val(respostaServlet.idcidade);
                $('#nomecidade').val(respostaServlet.nomecidade);
                $('#ceppadrao').val(respostaServlet.ceppadrao);
                $('#codigoibge').val(respostaServlet.codigoibge);
                $('#ddd').val(respostaServlet.ddd); 
                document.getElementById('idestado').value = respostaServlet.idestado;    
              }
          });
  
          }
        }
  
        function deletar(idcidade, situacao){
          var titulo = "";
          var tituloConfirmacao = "";
          var confirmButtonText = "";
  
          if (situacao == 'I') {
              titulo = "Você deseja realmente ativar a cidade?";
              confirmButtonText = "Sim, ative a cidade!";
              tituloConfirmacao = "Cidade ativada com sucesso!";
  
          } else {
              titulo = "Você deseja realmente inativar a cidade?";
              confirmButtonText = "Sim, inative a cidade!";
              tituloConfirmacao = "Cidade inativada com sucesso!";
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
                  url: url + "/deletar/" + idcidade,
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
                                      text: 'Não foi possível ativar/inativar cidade!',
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
  
    