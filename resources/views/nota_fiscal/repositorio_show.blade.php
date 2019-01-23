@include('layouts.master')
    <style type="text/css">
      table, th, td {
         border: 1px solid black;
       }

       .item {
         border: 0px solid black;
       }

    </style>
    <div id="page-wrapper" >
		  <div class="header"> 
            <h1 class="page-header">
                 Nota Fiscal de Serviços
            </h1>
					<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li class="active">Nota Fiscal de Serviços</li>
					</ol> 
                  
      </div>
         <div id="page-inner"> 
         <div class="row">
         <div class="col-lg-12">
         <div class="card">
                <div class="card-action">
                  <div class="row">
                  <div class="col-md-12" id="customers">  
                  <button class="btn btn-danger" onclick="printDiv('pdf')">PDF</button>
                  <?php if (file_exists(public_path().'/nota_fiscal/'.$notafiscal->id.'.pdf')) { ?>
                      <a href="{{ route('notafiscal.download', $notafiscal->id) }}" class="btn btn-success">Download Arquivo</a>
                  <?php   } ?>
                  <br />
                  <br />
                  <div id="pdf">
                    <table id="dataTables-example" class="table table-striped" >
                      <thead >
                        <tr>
                          <th colspan="6" style="display: none"></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td colspan="4" align="center">
                              <br />
                              <p style="font-size: 24px" align="center"><b><?php echo $notafiscal->fornecedor->razao_social; ?></b></p>
                              <p style="font-size: 12px" align="center"><?php echo $notafiscal->fornecedor->nome_fantasia.' -  '.$notafiscal->fornecedor->endereco.' -  '.$notafiscal->fornecedor->id; ?></p>
                            </td>
                            <td colspan="2">
                              <p style="font-size: 14px" align="center"><b>NOTA FISCAL DE SERVIÇO</b></p>
                              <p style="font-size: 8px"  align="center">Imposto sobre serviço de qualquer natureza</p>
                              <p style="font-size: 11px" align="center">MOD : 4</p>
                              <p style="font-size: 11px" align="center">Validade : {{ date("d/m/Y", strtotime($notafiscal->data_lancamento)) }}</p>
                              <p style="font-size: 20px" align="center"><b>Nº <?php echo $notafiscal->serie; ?></b></p>
                            </td>
                          </tr>
                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="6"><b>Cnpj/Cpf</b> -  <?php echo $notafiscal->empresa()->cnpj; ?></td>
                          </tr>
                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="6"><b>Tomador de Serviço</b> -  <?php echo $notafiscal->empresa()->razao_social; ?></td>
                          </tr>

                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><b>Cidade</b> -  <?php echo $notafiscal->empresa()->nome; ?></td>
                            <td colspan="2"><b>UF</b> -  <?php echo $notafiscal->empresa()->uf; ?></td>
                          </tr>

                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3"><b>Endereço</b> -  <?php echo $notafiscal->empresa()->endereco; ?></td>
                            <td colspan="1"><b>Insc. Mun.</b> - <?php echo $notafiscal->empresa()->insc_municipal; ?></td>
                            <td colspan="2"><b>Data Emissão</b> -  {{ date("d/m/Y", strtotime($notafiscal->data_emissao)) }}</td>
                          </tr>

                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <th colspan="1"><b>Unid.</b></th>
                            <th colspan="1"><b>Quant.</b></th>
                            <th colspan="2"><b>Descrição dos serviços</b></th>
                            <th colspan="1"><b>P. Unit</b></th>
                            <th colspan="1"><b>Total</b></th>
                          </tr>
                          @foreach($notafiscal->itens as $item)
                            <tr>
                              <td colspan="1" class="item">{{ $item->unidade }}</td>
                              <td colspan="1" class="item">{{ $item->quantidade }}</td>
                              <td colspan="2" class="item">{{ $item->descricao }}</td>
                              <td colspan="1" class="item">R$ {{ number_format($item->valor_unitario_item, 2, ',', '.') }}</td>
                              <td colspan="1" class="item">R$ {{ number_format($item->valor_total_item, 2, ',', '.') }}</td>
                            </tr>
                          @endforeach

                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td colspan="1">I</td>
                            <td colspan="3">VALOR TOTAL DOS SERVIÇOS</td>
                            <td colspan="2">R$ {{ number_format($notafiscal->valor_total_bruto, 2, ',', '.') }}</td>
                          </tr>
                          <tr>
                            <td colspan="1">II</td>
                            <td colspan="3">RETENÇÃO DO ISS NA FONTE</td>
                            <td colspan="2">R$ {{ number_format($notafiscal->valor_iss, 2, ',', '.') }} </td>
                          </tr>
                          <tr>
                            <td colspan="1">III</td>
                            <td colspan="3">OUTRAS RETENÇÕES</td>
                            <td colspan="2">R$ {{ number_format($notafiscal->vlr_outros, 2, ',', '.') }}</td>
                          </tr>
                          <tr>
                            <td colspan="1" >IV</td>
                            <td colspan="3" >VALOR A PAGAR</td>
                            <td colspan="2" >R$ {{ number_format($notafiscal->valor_total_liquido, 2, ',', '.') }}</td>
                          </tr>

                      </tbody>
                    </table>
                  </div>
                  <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
                  </div>
                  <div class="clearBoth"></div>
            </div>
      </div>



<script type="text/javascript">

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

</script>
