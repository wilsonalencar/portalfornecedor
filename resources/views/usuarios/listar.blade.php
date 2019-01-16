@include('layouts.master')

<div id="page-wrapper">
<div class="header"> 
            <h1 class="page-header">
                Consulta de Usuários.
            </h1>
            <ol class="breadcrumb">
          <li><a href="#">Usuários</a></li>
          <li class="active">Busca de Usuários</li>
        </ol> 
                        
</div>
<div id="page-inner"> 

<div class="row">
    
    <div class="col-md-12">
                    <div class="card">
                        <div class="card-action">
                             Busca de Usuários
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
                            <form action="{{ action('UsuariosController@create') }}" method="post" id="usuarios_edit">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Perfil</th>
                                            <th>Alterar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if (!empty($table))
                                         @foreach ($table as $key => $value)
                                                <tr class="odd gradeX">
                                                  <td><?php echo utf8_decode($value->nome);?></td>
                                                  <td><?php echo $value->email;?></td>
                                                  <td><?php echo $value->perfil->nome;?></td>
                                                  <td>
                                                    <a href="{{ route('usuario.editar', $value->usuarioid) }}"><i class="material-icons">mode_edit</i></a>
                                                    <a href="{{ route('usuario.excluir', $value->usuarioid) }}"><i class="material-icons">delete</i></a>
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
        document.getElementById('usuarios_edit').submit();
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
        document.getElementById('usuarios_edit').submit();
    }   
}

</script>