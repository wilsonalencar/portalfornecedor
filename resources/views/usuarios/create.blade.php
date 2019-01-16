@include('layouts.master')

<div id="page-wrapper">
  <div class="header"> 
    <h1 class="page-header">
        Usuários
    </h1>
    <ol class="breadcrumb">
      <li><a href="#">Usuários</a></li>
      <li class="active">Cadastro de Usuários</li>
    </ol>                        
  </div>
<div id="page-inner"> 

<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-action">
                 Cadastro de Usuários
            </div>
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
            </div>


            <div class="card-content">
				        <form class="col s12" action="{{ action('UsuariosController@create') }}" method="post" name="cad_usuarios">
                  {{ csrf_field()  }}
                  <div class="row">
                    <div class="col s6">
                    <label for="nome">Nome</label>
                      <input type="text" id="nome" name="nome" class="validate" maxlength="255">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s6">
                    <label for="email">Email</label>
                      <input type="text" id="email" name="email" class="validate" maxlength="255">
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col s3">
                        <label for="id_perfilusuario">Perfil</label>
                        <select id="id_perfilusuario" name="id_perfilusuario" class="form-control" onchange="checkPerfil(this.value)">
                             <option value="">Selecione</option>

                             @foreach($perfis as $perfil)

                                 <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>

                             @endforeach

                         </select>
                    </div>

                    <div class="col s3">
                        <label for="id_empresa">Empresas</label>
                        <select id="id_empresa" name="id_empresa[]" multiple class="form-control input-sm">
                             @foreach($empresas as $empresa)

                                 <option value="{{ $empresa['id'] }}">{{ $empresa['razao_social'] }}</option>

                             @endforeach

                         </select>
                    </div>
                  </div>
                  
                  <div class="row" id="cpf-cnpj" style="display:none">
                    <div class="col s3">
                    <label for="cnpj_cpf">CNPJ_CPF</label>
                      <input type="text" id="cnpj_cpf" name="cnpj_cpf" class="validate" maxlength="">
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

<script>
$('#dataTables-example').dataTable({
        language: {                        
            "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Portuguese-Brasil.json"
        },
        dom: '<B>frtip',
        buttons: [
             {
                extend: 'copyHtml5',
                exportOptions: {
                   columns: [ 0, 1, 2]
                }
             },
             {
                extend: 'excelHtml5',
                exportOptions: {
                   columns: [ 0, 1, 2]
                }
             },
             {
                extend: 'csvHtml5',
                exportOptions: {
                   columns: [ 0, 1, 2]
                }
             },
             {
                extend: 'pdfHtml5',
                exportOptions: {
                   columns: [ 0, 1, 2]
                }
             },
         ]
    });  

function checkPerfil(value){
  if (value == 4) {
      $('#cpf-cnpj').css('display', 'block');
  } else {
      $('#cpf-cnpj').css('display', 'none');    
  }
}

</script>