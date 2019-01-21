@include('layouts.master')

<div id="page-wrapper">
<div class="header"> 
            <h1 class="page-header">
                Consulta de Notas Fiscais.
            </h1>
            <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Notas Fiscais</li>
        </ol> 
                        
</div>
<div id="page-inner"> 

<div class="row">
    
    <div class="col-md-12">
                    <div class="card">
                        <div class="card-action">
                             Notas Fiscais
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
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th>Nome Fantasia</th>
                                          <th>Data de Emissão</th>
                                          <th>Número Nota Fiscal</th>
                                          <th>Série</th>
                                          <th>Data Lançamento</th>
                                          <th>Valor Total Líquido</th>
                                          <th>Visualizar</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @if (!empty($table))
                                       @foreach ($table as $key => $value)
                                              <tr class="odd gradeX">
                                                <td><?php echo $value->fornecedor->nome_fantasia;?></td>
                                                <td>{{ date("d/m/Y", strtotime($value->data_emissao)) }}</td>
                                                <td><?php echo $value->nota_fiscal;?></td>
                                                <td><?php echo $value->serie;?></td>
                                                <td>{{ date("d/m/Y", strtotime($value->data_lancamento)) }}</td>
                                                <td>R$ <?php echo number_format($value->valor_total_liquido, 2, ',', '.');?></td>
                                                <td>
                                                  <?php
                                                    $data_atual = date('Y-m-d');
                                                    $datalancamento = $value->data_lancamento;
                                                    $data_limite = date('Y-m-d', strtotime('+5 days', strtotime($datalancamento)));
                                                  ?>
                                                    @if(strtotime($data_limite) > strtotime($data_atual))
                                                    <a href="{{ route('notafiscal.editar', $value->id) }}"><i class="material-icons">mode_edit</i></a>
                                                    @endif  
                                                    <a href="{{ action('NotaFiscalController@show', $value->id) }}"><i class="material-icons">zoom_in</i></a>
                                                    <a href="{{ route('notafiscal.excluir', $value->id) }}"><i class="material-icons">delete</i></a>
                                                </td>
                                              </tr>
                                      @endforeach
                                    @endif
                                     </tbody>
                                  </table>
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


</script>