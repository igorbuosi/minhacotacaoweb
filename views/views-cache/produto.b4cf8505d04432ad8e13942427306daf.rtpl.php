<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Container Principal -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card-header">
                    <div class="box-header">

                        <div class="box-tools">
                            <a type="button" href="/painel/produto/cadastrar" class="btn btn-success">
                                Cadastrar
                            </a>
                            <br>
                        </div>
                    </div>
                </div>


                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">Listagem de Produtos</h3>
                        <br>
                        <div class="card-tools">
                            <!--<div class="card">-->
                            <form action="/painel/produto">
                                <div class="form-line row">
                                    <div class="col-sm">
                                        <label for="search">Código/Descrição</label>
                                        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                            class="form-control float-right" placeholder="Pesquisar">
                                    </div>
                                    <div class="col-sm">
                                        <label for="codigobarra">Código de Barras</label>
                                        <input type="text" id="codigobarra" name="codigobarra" value="<?php echo htmlspecialchars( $codigobarra, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                            class="form-control float-right" placeholder="Pesquisar">
                                    </div>
                                    <!-- Loop das marcas -->
                                    <div class="col-sm">
                                        <label id="labelmarca" for="idmarca">Marca</label>
                                        <select class="form-control" id="idmarca" name="idmarca">
                                            <option value="0">Selecione a marca</option>
                                            <?php $counter1=-1;  if( isset($marcas) && ( is_array($marcas) || $marcas instanceof Traversable ) && sizeof($marcas) ) foreach( $marcas as $key1 => $value1 ){ $counter1++; ?>
                                            <option id="<?php echo htmlspecialchars( $value1["idmarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idmarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                                <?php echo htmlspecialchars( $value1["nomemarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- Loop dos grupos -->
                                    <div class="col-sm">
                                        <label id="labelgrupo" for="idgrupo">Grupo</label>
                                        <select class="form-control" id="idgrupo" name="idgrupo">
                                            <option value="0">Selecione o grupo</option>
                                            <?php $counter1=-1;  if( isset($grupos) && ( is_array($grupos) || $grupos instanceof Traversable ) && sizeof($grupos) ) foreach( $grupos as $key1 => $value1 ){ $counter1++; ?>
                                            <option id="<?php echo htmlspecialchars( $value1["idgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                                <?php echo htmlspecialchars( $value1["nomegrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- Loop dos subgrupos -->
                                    <div class="col-sm">
                                        <label id="labelsubgrupo" for="idsubgrupo">Subgrupo</label>
                                        <select class="form-control" id="idsubgrupo" name="idsubgrupo">
                                            <option value="0">Selecione o subgrupo</option>
                                            <?php $counter1=-1;  if( isset($subgrupos) && ( is_array($subgrupos) || $subgrupos instanceof Traversable ) && sizeof($subgrupos) ) foreach( $subgrupos as $key1 => $value1 ){ $counter1++; ?>
                                            <option id="<?php echo htmlspecialchars( $value1["idsubgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idsubgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                                <?php echo htmlspecialchars( $value1["nomesubgrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm">
                                        <label id="pesquisar" for="pesquisar">&nbsp;</label>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            &nbsp;
                                            <a onclick="limparFiltros()" class="btn btn-default">
                                                <i class="fas fa-eraser"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </form>
                            <!--</div>-->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descricao</th>
                                    <th>Grupo</th>
                                    <th>Marca</th>
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
                                <?php $counter1=-1;  if( isset($produtos) && ( is_array($produtos) || $produtos instanceof Traversable ) && sizeof($produtos) ) foreach( $produtos as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td><?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["nomegrupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["nomemarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/painel/produto/<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                            class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Editar</a>
                                    </td>
                                    <td>
                                        <?php if( $value1["datainativacao"] != '' ){ ?>
                                        <a class="btn btn-success btn-block"
                                            onclick="deletar(<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["datainativacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
                                            <i class="fa fa-edit"></i>
                                            Ativar
                                        </a>
                                        <?php } ?>
                                        <?php if( $value1["datainativacao"] == '' ){ ?>
                                        <a class="btn btn-danger btn-block"
                                            onclick="deletar(<?php echo htmlspecialchars( $value1["idproduto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, '<?php echo htmlspecialchars( $value1["datainativacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')">
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

        <script>
            $(document).ready(function () {
                carregarFiltroSelecionado();
                menuAtivo();
            });
            
            function menuAtivo() {
                document.getElementById('titulopainel').innerHTML = "<strong>Produto</strong>";
                document.getElementById('menuprodutos').classList.add("active");
                document.getElementById('agrupamentoprodutos').classList.add("menu-open");
                document.getElementById('menuproduto').classList.add("active");
            }

            function carregarFiltroSelecionado() {
                var urlParams = new URLSearchParams(window.location.search);
                var idmarca = urlParams.get("idmarca") != null ? urlParams.get("idmarca") : 0;
                var idgrupo = urlParams.get("idgrupo") != null ? urlParams.get("idgrupo") : 0;
                var idsubgrupo = urlParams.get("idsubgrupo") != null ? urlParams.get("idsubgrupo") : 0;

                //setar parametros pegos na url nos selects
                document.getElementById('idmarca').value = idmarca;
                document.getElementById('idgrupo').value = idgrupo;
                document.getElementById('idsubgrupo').value = idsubgrupo;
            }

            function limparFiltros() {
                document.getElementById('search').value = "";
                document.getElementById('codigobarra').value = "";
                document.getElementById('idmarca').value = 0;
                document.getElementById('idgrupo').value = 0;
                document.getElementById('idsubgrupo').value = 0;

            }

            function deletar(idproduto, datainativacao) {
                var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/produto";
                var titulo = "";
                var tituloConfirmacao = "";
                var confirmButtonText = "";

                if (datainativacao == '') {
                    titulo = "Você deseja realmente ativar o produto?";
                    confirmButtonText = "Sim, ative o produto!";
                    tituloConfirmacao = "Produto ativado com sucesso!";
                } else {
                    titulo = "Você deseja realmente inativar o produto?";
                    confirmButtonText = "Sim, inative o produto!";
                    tituloConfirmacao = "Produto inativado com sucesso!";
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
                            url: url + "/deletar/" + idproduto,
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
                                            window.location.href = window.location.href;
                                        })
                                    } else {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'Erro',
                                            text: 'Não foi possível ativar/inativar produto!',
                                            showConfirmButton: true,
                                            timer: 10000
                                        }).then(function () {
                                            window.location.href = window.location.href;
                                        })
                                    }
                                },
                            error:
                                function (data) {
                                    window.location.href = window.location.href;
                                }
                        });
                    };
                });
            }
        </script>