@include('layouts.master')
    
    <div id="page-wrapper" >
		  <div class="header"> 
            <h1 class="page-header">
                 Fornecedores
            </h1>
					<ol class="breadcrumb">
					  <li><a href="#">Fornecedores</a></li>
					  <li class="active">Cadastro de Fornecedores</li>
					</ol> 
									
		  </div>
		
         <div id="page-inner"> 
    		 <div class="row">
    		 <div class="col-lg-12">
    		 <div class="card">
                <div class="card-action">
                    Cadastro de Fornecedores
                </div>
                <div class="card-content">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-12">
                          <?php
                            if (!empty($msg)) { 
                              if ($success) {
                                  echo "<div class='alert alert-success'>";
                                  foreach ($msg as $x => $message) {
                                      echo $message;
                                  }
                                  echo "</div>";
                                
                                }

                                if (!$success) {
                                  echo "<div class='alert alert-danger'>";
                                  foreach ($msg as $x => $message) {
                                      echo $message.'<br />';
                                  }
                                  echo "</div>";

                                }                           
                              }
                         ?>
                      </div>
                    </div>

                    <form class="col s12" action="{{ action('FornecedoresController@create') }}" method="post" name="cad_fornecedor">
                      <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token(); !!}"> 
                        <div class="col s3">
                        <label for="razao_social">Razão Social</label>
                          <input id="razao_social" type="text" name="razao_social" maxlength="20" class="validate" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        <label for="nome_fantasia">Nome Fantasia</label>
                          <input type="text" id="nome_fantasia" name="nome_fantasia" class="validate" maxlength="255" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s3">
                        <label for="Tipo">Tipo</label>
                          <select id="tipo" name="tipo" class="form-control input-sm">
                            <option value="J">Pessoa Jurídica</option>
                            <option value="F">Pessoa Física</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s3">
                        <label for="cnpj_cpf">CNPJ/CPF</label>
                          <input type="text" id="cnpj_cpf" name="cnpj_cpf" value="" maxlength="18" onkeypress="mask(this,val_cnpj)" class="validate">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        <label for="insc_estadual">Inscrição Estadual</label>
                          <input type="text" id="insc_estadual" name="insc_estadual" class="validate" maxlength="255" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        <label for="insc_municipal">Inscrição Municipal</label>
                          <input type="text" id="insc_municipal" name="insc_municipal" class="validate" maxlength="255" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        <label for="endereco">Endereço</label>
                          <input type="text" id="endereco" name="endereco" class="validate" maxlength="255" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                          <label for="complemento">Complemento</label>
                          <input type="text" id="complemento" name="complemento" class="validate" maxlength="255" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s3">
                            <label for="cod_municipio">Municipio</label>
                            <select id="cod_municipio" name="cod_municipio" class="form-control input-sm">
                              <option value="" disabled selected>Cidade</option>

                              @foreach($municipios as $municipio)

                                 <option value="{{ $municipio->codigo }}">{{ $municipio->nome }}</option>

                             @endforeach

                              
                            </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s3">
                          <label for="telefone">CEP</label>
                          <input type="text" id="cep" name="cep" onkeypress="mask(this,val_cep)" maxlength="9" class="validate" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s3">  
                        <label for="telefone">Telefone</label>
                          <input type="text" id="telefone" name="telefone" maxlength="15" value="" onkeypress="mask(this,val_tel)" class="validate">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        <label for="contato">Contato</label>
                          <input type="text" id="contato" maxlength="255" name="contato" class="validate" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s6">
                        <label for="email">Email</label>
                          <input type="text" maxlength="255" id="email" name="email" class="validate" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s3">
                          <label for="Status">Status</label>
                            <select id="status" name="status" class="form-control input-sm">
                              <option value="A">Ativo</option>
                              <option value="I">Inativo</option>
                            </select>
                        </div>
                      </div>
                      <br />
                      <div class="row">
                      <div class="input-field col s1">
                        </div>

                        <div class="input-field col s2">
                            <a href="#"  class="waves-effect waves-light btn">Voltar</a>
                        </div>
                        <div class="input-field col s1">
                            <input type="submit" name="salvar" value="salvar" id="submit" class="waves-effect waves-light btn">
                        </div>
                      </div>
                    </form>

                	<div class="clearBoth"></div>
                  </div>
                  </div>
                  </div>
            </div>
      </div>