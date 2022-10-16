<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Breadcrumb Start -->
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
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cadastro de Empresa</span></h5>
                <div class="bg-light p-30 mb-5">
                    <input class="form-control" type="hidden" name="idpessoa" id="idpessoa" value=""
                    readonly="readonly" />
                    <input class="form-control" type="hidden" name="idpessoajuridica" id="idpessoajuridica" value=""
                    readonly="readonly" />
                    <input class="form-control" type="hidden" name="idempresa" id="idempresa" value=""
                    readonly="readonly" />
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>CNPJ</label>
                            <input class="form-control" id="cnpj" name="cnpj" value="" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Inscrição Estadual</label>
                            <input class="form-control" id="ie" name="ie" value="" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Nome Fantasia</label>
                            <input class="form-control" id="nomecompleto" name="nomecompleto" value="" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Razão Social</label>
                            <input class="form-control" id="razaosocial" name="razaosocial" value="" type="text">
                        </div>

                        <div class="col-md-4 form-group">
                            <label>CEP</label>
                            <input class="form-control" type="text" name="ceppessoa" id="ceppessoa" value="" placeholder="00000-000" oninput="criaMascaraCEP('ceppessoa')" maxLength="8"/>
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
                            <label id="labelestado" for="idestado">Estado</label>
                                <select class="form-control" id="idestado" name="idestado">
                                <?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>
                                <option id="<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" value="<?php echo htmlspecialchars( $value1["idestado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nomeEstado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label>Telefone</label>
                            <input class="form-control" value="" placeholder="(00) 00000-0000" oninput="criaMascaraTelefone('tel1')" maxLength="11"  id="tel1" name="tel1" type="text">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Celular</label>
                            <input class="form-control" value="" placeholder="(00) 00000-0000" oninput="criaMascaraTelefone('tel2')" maxLength="11"  id="tel2" name="tel2" type="text">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control"  id="email" name="email" type="text" placeholder="example@email.com">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Site</label>
                            <input class="form-control"  id="site" name="site" type="text">
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
                            <input class="form-control" id="confirmacaosenha" name="confirmacaosenha" value="" type="password">
                        </div>

                        <div class="col-md-3 form-group">
                            <label> &nbsp;</label>
                            <button class="btn btn-block btn-primary font-weight-bold">Cadastrar</button>
                        </div>


                        
                    </div>
                </div>
                <!--<div class="collapse mb-5" id="shipping-address">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                    <div class="bg-light p-30">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select">
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123">
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            
        </div>
    </div>
    <!-- Checkout End -->
