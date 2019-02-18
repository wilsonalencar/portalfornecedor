@include('layouts.master')

<div id="page-wrapper">
<div class="header"> 
            <h1 class="page-header">
                Exportação de dados.
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
            <div class="card-content">
                <div class="table-responsive">
                Exportação de Notas Fiscais
                  <table class="table table-striped table-bordered table-hover" id="dataTables">
                      <thead>
                          <tr>
                              <th>Empresa</th>
                              <th>Estabelecimento</th>
                              <th>Nota Fiscal</th>
                              <th>Série</th>
                              <th>Fornecedor</th>
                              <th>Ordem Compra</th>
                              <th>Data de Emissão</th>
                              <th>Data Lançamento</th>
                              <th>Observação</th>
                              <th>Valor Bruto</th>
                              <th>Valor Líquido</th>
                              <th>Valor ISS</th>
                              <th>Valor IRRF</th>
                              <th>Valor Outros</th>
                              <th>Valor INSS</th>
                            
                          </tr>
                      </thead>
                      <tbody>
                        @if (!empty($table))
                           @foreach ($table as $key => $value)
                                  <tr class="odd gradeX">
                                    <td><?php echo $value->real_empresa()->razao_social;?></td>
                                    <td><?php echo $value->empresa()->razao_social;?></td>
                                    <td><?php echo $value->nota_fiscal;?></td>
                                    <td><?php echo $value->serie;?></td>
                                    <td><?php echo $value->fornecedor->nome_fantasia;?></td>
                                    <td><?php echo $value->ordemcompra->ordemcompra;?></td>
                                    <td>{{ date("d/m/Y", strtotime($value->data_emissao)) }}</td>
                                    <td>{{ date("d/m/Y", strtotime($value->data_lancamento)) }}</td>
                                    <td><?php echo $value->observacao;?></td>
                                    <td>R$ <?php echo number_format($value->valor_total_bruto, 2, ',', '.');?></td>
                                    <td>R$ <?php echo number_format($value->valor_total_liquido, 2, ',', '.');?></td>
                                    <td>R$ <?php echo number_format($value->vlr_iss, 2, ',', '.');?></td>
                                    <td>R$ <?php echo number_format($value->vlr_irrf, 2, ',', '.');?></td>
                                    <td>R$ <?php echo number_format($value->vlr_outros, 2, ',', '.');?></td>
                                    <td>R$ <?php echo number_format($value->vlr_inss, 2, ',', '.');?></td>
                                  </tr>
                          @endforeach
                        @endif
                       </tbody>
                    </table>
                </div>  
            </div>
            <hr />
            <div class="card-content">
                <div class="table-responsive">
                Exportação de Itens de Notas Fiscais
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                          <tr>
                              <th>Nota Fiscal</th>
                              <th>Unidade</th>
                              <th>Quantidade</th>
                              <th>Descrição</th>
                              <th>Valor Unitário</th>
                              <th>Valor Total</th>
                              <th>Alq. ISS</th>
                              <th>Vlr. ISS</th>
                              <th>Alq. IRRF</th>
                              <th>Vlr. IRRF</th>
                              <th>Alq. Outros</th>
                              <th>Vlr. Outros</th>
                              <th>Alq. INSS</th>
                              <th>Vlr. INSS</th>
                          </tr>
                      </thead>
                      <tbody>
                        @if (!empty($itens))
                           @foreach ($itens as $id => $all_itens)
                              @foreach($all_itens as $item)
                                  <tr class="odd gradeX">
                                    <td><?php echo $item->notafiscal->nota_fiscal;?></td>
                                    <td><?php echo $item->unidade;?></td>
                                    <td><?php echo $item->quantidade;?></td>
                                    <td><?php echo $item->descricao;?></td>
                                    <td>R$ <?php echo number_format($item->valor_unitario_item, 2, ',', '.');?></td>
                                    <td>R$ <?php echo number_format($item->valor_total_item, 2, ',', '.');?></td>
                                    <td><?php echo $item->alq_iss; ?></td>
                                    <td>R$ <?php echo number_format($item->vlr_iss, 2, ',', '.');?></td>
                                    <td><?php echo $item->alq_irrf; ?></td>
                                    <td>R$ <?php echo number_format($item->vlr_irrf, 2, ',', '.');?></td>
                                    <td><?php echo $item->alq_outros; ?></td>
                                    <td>R$ <?php echo number_format($item->vlr_outros, 2, ',', '.');?></td>
                                    <td><?php echo $item->alq_inss; ?></td>
                                    <td>R$ <?php echo number_format($item->vlr_inss, 2, ',', '.');?></td>
                                  </tr>
                            @endforeach
                          @endforeach
                        @endif
                       </tbody>
                    </table>
                </div>  
            </div>
        </div>

<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable( {
        "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
        dom: 'B',
        ordering: false,
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    } );

    $('#dataTables').DataTable( {
          "language": {
            "sProcessing":    "Procesando...",
            "sLengthMenu":    "Mostrar _MENU_ registros",
            "sZeroRecords":   "No se encontraron resultados",
            "sEmptyTable":    "Ningún dato disponible en esta tabla",
            "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":   "",
            "sSearch":        "Buscar:",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        dom: 'B',
        ordering: false,
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    } );
} );


window.onload = function(){
document.getElementById("sideNav").click();
}


</script>