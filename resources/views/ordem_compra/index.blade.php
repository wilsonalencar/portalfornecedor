@include('layouts.master')
    
    <div id="page-wrapper" >
		  <div class="header"> 
            <h1 class="page-header">
                 Ordem de Compra
            </h1>
					<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li class="active">Ordem de Compra</li>
					</ol> 
									
		  </div>
		
         <div id="page-inner"> 
         <div class="row">
         <div class="col-lg-12">
         <div class="card">
                <div class="card-action">
                    Ordem de Compra
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

                    <form class="col s12" action="{{ action('OrdemCompraController@create') }}" method="post" id="form" name="cad_ordem">
                      <input type="hidden" name="id" id="id_ordemcompra">
                      <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token(); !!}"> 
                        <div class="col-md-2">
                        <input type="hidden" id="id_estab" name="estabid">

                        <label for="cnpj_cpf">CNPJ Filial</label>
                          <input type="text" id="cnpj_cpf" maxlength="18" onblur="buscaFornecedorAgenda(this.value)" onkeypress="mask(this,val_cnpj)">
                        </div>
                        <div id="dados_estabelecimento" style="display:none;">
                          <div class="col-md-4">
                            <label for="razao_social">Razão Social</label>
                            <input type="text" id="razao_social" readonly="true" value="">
                          </div>
                          <div class="col-md-2">
                            <label for="municipio_agenda">Municipio</label>
                            <input type="text" id="municipio_agenda" readonly="true" value="">
                          </div> 
                          <div class="col-md-1">
                            <label for="uf_agenda">UF</label>
                            <input type="text" id="uf_agenda" readonly="true" value="">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label for="ordemcompra">Ordem de Compra</label>
                          <input type="text" id="ordemcompra" name="ordemcompra" class="validate" maxlength="255" value="">
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-2">
                              <label for="fornecedor_id">Fornecedor</label>
                              <select id="fornecedor_id" name="fornecedorid" class="form-control" onchange="buscaFornecedor(this.value)">
                                   <option value="">Selecione</option>
  	                               @foreach($fornecedores as $fornecedor)
                                     <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome_fantasia }}</option>
                                    @endforeach
                               </select>
                          </div>
                          <div id="dados_fornecedor" style="display:none">
                            
                            <div class="col-md-4">
                              <label for="cnpj_cpf">CNPJ/CPF</label>
                              <input type="text" id="cnpj_cpf_exibe" maxlength="18" onkeypress="mask(this,val_cnpj)" readonly="true">
                            </div>
                            <div class="col-md-2">
                              <label for="municipio">Municipio</label>
                              <input type="text" id="municipio_exibe" value="" readonly="true">
                            </div> 
                            <div class="col-md-1">
                              <label for="uf">UF</label>
                              <input type="text" id="uf_exibe" value="" readonly="true">
                            </div>
                          </div>
                      </div>
                     
                      <br />

                      <div class="row">
                      <div class="input-field col s1">
                      </div>
                      <div class="input-field col s1">
                            <a href="#" onclick="reset()" class="waves-effect waves-light btn">Novo</a>
                        </div>
                        <div class="input-field col s1">
                            <input type="submit" value="salvar" id="submit" class="waves-effect waves-light btn">
                        </div>
                      </div>
                    </form>

                  <div class="clearBoth"></div>
                    <hr>
                  </div>
                      @if (!empty($table))
                      <h3 align="center">Ordens de compra </h3>
                      <br />
                      <div class="table-responsive">
                            <form action="{{ action('OrdemCompraController@create') }}" method="get" id="ordemcompra_id">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ordem de Compra</th>
                                            <th>CNPJ Filial</th>
                                            <th>Fornecedor</th>
                                            <th>Alterar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($table as $key => $value)
                                                <tr class="odd gradeX">
                                                  <td style="width: 15%"><?php echo ($value->ordemcompra);?></td>
                                                  <td><?php echo $value->estabelecimento($value->estabid);?></td>
                                                  <td><?php echo $value->fornecedor->nome_fantasia;?></td>
                                                  <td>
                                                    <a href="#" onclick="editar('<?php echo $value->id; ?>','<?php echo $value->estabelecimento($value->estabid, true); ?>','<?php echo $value->fornecedor->id; ?>','<?php echo $value->ordemcompra; ?>')"><i class="material-icons">mode_edit</i></a>
                                                    <a href="#"><i class="material-icons" onclick="confirmdelete(<?php echo $value->id; ?>)">delete</i></a>
                                                  </td>
                                                </tr>
                                        @endforeach
                                   </tbody>
                                </table>
                            </form>
                      </div> 
                      @endif
                  </div>
                  </div>
            </div>
      </div>

<script>
$('#dataTables-example').dataTable({
        language: {                        
            "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Portuguese-Brasil.json"
        },
        dom: '',
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

function confirmdelete(id)
{
  var r = confirm("Você tem certeza de que quer excluir esse registro ?");
  if (r == true) {
    window.location.href = 'http://'+window.location.hostname+'/portalfornecedor/public/portalfornecedor/ordemcompra/delete/'+id;
  }

}

function editar(id_ordemcompra, cnpj, id_fornecedor, ordemcompra)
{
  $('#fornecedor_id').val(id_fornecedor);
  $('#ordemcompra').val(ordemcompra);
  buscaFornecedor(id_fornecedor);
  buscaFornecedorAgenda(cnpj);
  $('#id_ordemcompra').val(id_ordemcompra);
}

function buscaFornecedor(id)
{
    if (!isNaN(id)) {
      $('#dados_fornecedor').css('display', 'none');    
      $("#municipio_exibe").val('');
      $("#uf_exibe").val('');
      $("#cnpj_cpf_exibe").val('');
    }
    
    var script = document.createElement('script');
    script.src = 'http://'+window.location.hostname+'/portalfornecedor/public/portalfornecedor/busca_fornecedor/'+id;
    document.body.appendChild(script);
}

function callback(conteudo) {
   if (conteudo.id > 0) {
      $('#dados_fornecedor').css('display', 'block');
      $("#municipio_exibe").val(conteudo.municipio);
      $("#uf_exibe").val(conteudo.uf);
      $("#cnpj_cpf_exibe").val(conteudo.cnpj_cpf);
   } else {
      $('#dados_fornecedor').css('display', 'none');    
      $("#municipio_exibe").val('');
      $("#uf_exibe").val('');
      $("#cnpj_cpf_exibe").val('');
   }
}

function reset()
{
  $('#form')[0].reset();
}

function NotFoundCNPJ()
{
  alert('O CNPJ informado não está cadastrado para esta empresa.')
}

function buscaFornecedorAgenda(res)
{
    var cnpj = res.replace('.', "");
    cnpj = cnpj.replace(".", "");
    cnpj = cnpj.replace("/", "");
    cnpj = cnpj.replace("-", "");

    if (isNaN(cnpj)) {
      $('#dados_estabelecimento').css('display', 'none');    
      $("#municipio_agenda").val('');
      $("#cnpj_cpf").val('');
      $("#uf_agenda").val('');
      $("#id_estab").val('');
      $("#razao_social").val('');
      return false;
    } 
    
    var script = document.createElement('script');
    script.src = 'http://'+window.location.hostname+'/portalfornecedor/public/portalfornecedor/busca_fornecedor_agenda/'+cnpj;
    document.body.appendChild(script);
}

function callbackAgenda(conteudo) {  

   if (conteudo.id > 0) {
      $('#dados_estabelecimento').css('display', 'block');
      $("#municipio_agenda").val(conteudo.municipio_agenda);
      $("#cnpj_cpf").val(conteudo.cnpj_cpf);
      $("#uf_agenda").val(conteudo.uf_agenda);
      $("#id_estab").val(conteudo.id);
      $("#razao_social").val(conteudo.razao_social);
   } else {
      alert('CNPJ não encontrado');
      $('#dados_estabelecimento').css('display', 'none');    
      $("#municipio_agenda").val('');
      $("#cnpj_cpf").val('');
      $("#uf_agenda").val('');
      $("#id_estab").val('');
      $("#razao_social").val('');
   }
}
</script>

