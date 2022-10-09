<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Container Principal -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card-header">
          <div class="box-header">

            <div class="box-tools">
              <button type="button" onclick="setDadosModal(0)" class="btn btn-success" data-toggle="modal"
                data-target="#modal-lg">
                Cadastrar
              </button>
              <br>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listagem de Grupos</h3>
            <div class="card-tools">
              <form action="/painel/grupo">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="search" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control float-right"
                    placeholder="Pesquisar">
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
          <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descricao</th>
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
                <?php $counter1=-1;  if( isset($grupos) && ( is_array($grupos) || $grupos instanceof Traversable ) && sizeof($grupos) ) foreach( $grupos as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo htmlspecialchars( $value1["nomegrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["descricaogrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><a href="" data-toggle="modal" data-target="#modal-lg" onclick='setDadosModal(<?php echo htmlspecialchars( $value1["idgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)'
                      class="btn btn-primary btn-block">
                      <i class="fa fa-edit"></i>Editar</a>
                  </td>
                  <td>
                    <?php if( $value1["situacao"] == 'I' ){ ?>
                    <a class="btn btn-success btn-block" onclick="deletar(<?php echo htmlspecialchars( $value1["idgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                      <i class="fa fa-edit"></i>
                      Ativar
                    </a>
                    <?php } ?>
                    <?php if( $value1["situacao"] == 'A' ){ ?>
                    <a class="btn btn-danger btn-block" onclick="deletar(<?php echo htmlspecialchars( $value1["idgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["situacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
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
          <h4 class="modal-title" id="tituloModal">Cadastro de Grupo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Formulario do Modal -->
          <form id="cadastrogrupo">
            <div class="card-body">
              <div class="form-group">
                <div class="form-line row">
                  <input class="form-control" type="hidden" name="idgrupo" id="idgrupo" value="" readonly="readonly" />
                  <div class="col-sm">
                    <label for="nomegrupo" id="labelnome">Nome</label>
                    <input type="text" class="form-control" maxlength="100" id="nomegrupo" name="nomegrupo"
                      placeholder="Digite o nome do grupo">
                  </div>
                  <div class="col-sm">
                    <label for="descricaogrupo" id="labeldescricao">Descrição</label>
                    <input type="text" class="form-control" maxlength="500" id="descricaogrupo" name="descricaogrupo"
                      placeholder="Digite a descrição do grupo">
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

  var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/grupo";

  function menuAtivo() {
    document.getElementById('titulopainel').innerHTML = "<strong>Grupo</strong>";
    document.getElementById('menugrupo').classList.add("active");
    document.getElementById('agrupamentoprodutos').classList.add("menu-open");
    document.getElementById('menuprodutos').classList.add("active");
  }

  $(document).ready(function () {
    menuAtivo();
  });

  function layoutPadraoModal() {
    document.getElementById('labelnome').innerHTML = "Nome";
    document.getElementById('labelnome').classList.remove("is-invalid");
    document.getElementById('tituloModal').innerHTML = "Cadastro de Grupo"
    document.getElementById("salvar").disabled = false;
  }

  function validarCampos() {
    console.log('Entrei na função de validação de campos');
    layoutPadraoModal();
    if (document.getElementById("nomegrupo").value == '') {
      document.getElementById('labelnome').innerHTML = "<FONT COLOR='red'>O nome é obrigatório</FONT>";
      document.getElementById('nomegrupo').classList.remove("is-valid");
      document.getElementById('nomegrupo').classList.add("is-invalid");
      $("#nomegrupo").focus();
    } else {
      gravarDados();
    }
  }

  function gravarDados() {
    layoutPadraoModal();
    document.getElementById("salvar").disabled = true; //desabilitar o botão pra nao deixar apertar varias vezes
    var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/grupo";
    console.log("" + url);
    var dados = $('#cadastrogrupo').serialize();
    console.log("Variavel dados: " + dados);
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
          text: 'Não foi possível salvar grupo!',
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
            text: 'Grupo salvo com sucesso',
            showConfirmButton: true,
            timer: 10000
          }).then(function () {
            window.location.href = window.location.href = url;
          })
        }
      }
    });
  }

  function limparModal() {
    $('#idgrupo').val("0");
    $('#nomegrupo').val("");
    $('#descricaogrupo').val("");
  }

  function setDadosModal(valor) {
    limparModal();
    layoutPadraoModal();
    document.getElementById('idgrupo').value = valor;
    var idgrupo = valor;
    if (idgrupo != "0") {
      document.getElementById('tituloModal').innerHTML = "Alteração de Grupo"
      $.getJSON({
        asyc: false,
        type: "GET",
        url: url + "/" + valor,
        error: function (xhr) {
          alert("Problemas ao  carregar! Erro: " + xhr.status);
        },
        success: function (respostaServlet) {
          $('#idgrupo').val(respostaServlet.idgrupo);
          $('#nomegrupo').val(respostaServlet.nomegrupo);
          $('#descricaogrupo').val(respostaServlet.descricaogrupo);
        }
      });

    }
  }

  function deletar(idgrupo, situacao) {
    var titulo = "";
    var tituloConfirmacao = "";
    var confirmButtonText = "";

    if (situacao == 'I') {
      titulo = "Você deseja realmente ativar o grupo?";
      confirmButtonText = "Sim, ative o grupo!";
      tituloConfirmacao = "Grupo ativado com sucesso!";

    } else {
      titulo = "Você deseja realmente inativar o grupo?";
      confirmButtonText = "Sim, inative o grupo!";
      tituloConfirmacao = "Grupo inativado com sucesso!";
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
          url: url + "/deletar/" + idgrupo,
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
                  text: 'Não foi possível ativar/inativar grupo!',
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