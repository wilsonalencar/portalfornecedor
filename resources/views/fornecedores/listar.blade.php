@include('layouts.master')

<div id="page-wrapper">
<div class="header"> 
            <h1 class="page-header">
                Consulta de Fornecedores.
            </h1>
            <ol class="breadcrumb">
          <li><a href="#">Fornecedores</a></li>
          <li class="active">Consulta de Fornecedores</li>
        </ol> 
                        
</div>
<div id="page-inner"> 

<div class="row">
    
    <div class="col-md-12">
                    <div class="card">
                        <div class="card-action">
                             Consulta de Fornecedores
                        </div>
                        <div class="card-content">
                            <?php
                              if (!empty($msg)) { 

                                if ($success) {
                                    echo "<div class='alert alert-success'>
                                            <strong>Sucesso !</strong> $msg
                                          </div>";
                                  }

                                  if (!$success) {
                                    echo "<div class='alert alert-danger'>
                                            <strong>ERRO !</strong> $msg
                                          </div>";

                                  }                           
                                }
                             ?> 
                            <div class="table-responsive">
                            <form action="{{ action('FornecedoresController@create') }}" method="post" id="fornecedores_edit">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CNPJ/CPF</th>
                                            <th>Inscrição Estadual</th>
                                            <th>Inscrição Municipal</th>
                                            <th>Status</th>
                                            <th>Alterar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if (!empty($table))
                                         @foreach ($table as $key => $value)
                                           <?php
                                              if ($value->status == 'A') {
                                                  $status = 'Ativo';
                                              }
                                              if ($value->status == 'I') {
                                                $status = 'Inativo';
                                              }
                                           ?>
                                                <tr class="odd gradeX">
                                                  <td><?php echo utf8_decode($value->nome_fantasia);?></td>
                                                  <td><?php echo $value->cnpj_cpf;?></td>
                                                  <td><?php echo $value->insc_estadual;?></td>
                                                  <td><?php echo $value->insc_municipal;?></td>
                                                  <td><?php echo $status;?></td>
                                                  <td>
                                                    <a href="{{ route('fornecedor.editar', $value->id) }}"><i class="material-icons">mode_edit</i></a>
                                                    <a href="{{ route('fornecedor.excluir', $value->id) }}"><i class="material-icons">delete</i></a>
                                                </tr>
                                        @endforeach
                                      @endif
                                       </tbody>
                                    </table>
                                </form>
                            </div>  
                        </div>
                    </div>

<script>
$('#dataTables-example').dataTable({
        language: {                        
            "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Portuguese-Brasil.json"
        },
        dom: 'frti',
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

function edita(id) {
    if (id > 0) {
        document.getElementById('id').value = id;
        document.getElementById('fornecedores_edit').submit();
    }
}

function exclui(id) {
    var r = confirm("Certeza que quer excluir este registro?");
    if (r != true) {
        return false;
    } 
    if (id > 0) {
        document.getElementById('id').value = id;
        document.getElementById('action').value = "3";
        document.getElementById('fornecedores_edit').submit();
    }   
}

</script>