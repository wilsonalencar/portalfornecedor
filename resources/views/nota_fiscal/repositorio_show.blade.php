@include('layouts.master')
    <style type="text/css">
      table, th, td {
         border: 1px solid black;
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
                  <button class="btn btn-danger" onclick="javascript:demoFromHTML()">PDF</button>
                  <br />
                  <br />
                    <table id="tab_customers" class="table table-striped" >
                      <thead >
                        <tr>
                          <td colspan="6"></td>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td colspan="4" align="center">
                              <br />
                              <p style="font-size: 24px" align="center"><?php echo $notafiscal->fornecedor->razao_social; ?></p>
                              <p style="font-size: 12px" align="center"><?php echo $notafiscal->fornecedor->nome_fantasia.' - '.$notafiscal->fornecedor->endereco.' - '.$notafiscal->fornecedor->id; ?></p>
                            </td>
                            <td colspan="2">
                              <p style="font-size: 14px" align="center">NOTA FISCAL DE SERVIÇO</p>
                              <p style="font-size: 8px"  align="center">Imposto sobre serviço de qualquer natureza</p>
                              <p style="font-size: 11px" align="center">MOD : 4</p>
                              <p style="font-size: 11px" align="center">Validade <?php echo $notafiscal->data_lancamento; ?></p>
                              <p style="font-size: 20px" align="center"><b>Nº <?php echo $notafiscal->serie; ?></b></p>
                            </td>
                          </tr>
                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="6">CNPJ/CPF - <?php echo $notafiscal->empresa()->cnpj; ?></td>
                          </tr>
                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="6"><?php echo $notafiscal->empresa()->razao_social; ?></td>
                          </tr>

                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><?php echo $notafiscal->empresa()->nome; ?></td>
                            <td colspan="2"><?php echo $notafiscal->empresa()->uf; ?></td>
                          </tr>

                          <tr class="pulalinha">
                            <td colspan="6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3"><?php echo $notafiscal->empresa()->endereco; ?></td>
                            <td colspan="1"><?php echo $notafiscal->empresa()->insc_municipal; ?></td>
                            <td colspan="2">Data Emissão : <?php echo $notafiscal->data_emissao ?></td>
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
                              <th colspan="1">{{ $item->unidade }}</th>
                              <th colspan="1">{{ $item->quantidade }}</th>
                              <th colspan="2">{{ $item->descricao }}</th>
                              <th colspan="1">R$ {{ $item->valor_unitario_item }}</th>
                              <th colspan="1">R$ {{ $item->valor_total_item }}</th>
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
                            <td colspan="2">R$ {{ $notafiscal->valor_total_bruto }}</td>
                          </tr>
                          <tr>
                            <td colspan="1">II</td>
                            <td colspan="3">RETENÇÃO DO ISS NA FONTE</td>
                            <td colspan="2">R$ {{ $notafiscal->vlr_iss }}</td>
                          </tr>
                          <tr>
                            <td colspan="1">III</td>
                            <td colspan="3">OUTRAS RETENÇÕES</td>
                            <td colspan="2">R$ {{ $notafiscal->vlr_outros }}</td>
                          </tr>
                          <tr>
                            <td colspan="1" >IV</td>
                            <td colspan="3" >VALOR A PAGAR</td>
                            <td colspan="2" >R$ {{ $notafiscal->valor_total_liquido }}</td>
                          </tr>

                      </tbody>
                    </table>
                  </div>

                  <div class="clearBoth"></div>
            </div>
      </div>



<script type="text/javascript">
        function demoFromHTML() {
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = $('#customers')[0];

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('fiscal.pdf');
            }
            , margins);
        }
    </script>
