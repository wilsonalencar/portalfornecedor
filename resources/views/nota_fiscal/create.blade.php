@include('layouts.master')
    
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
         <form id="form" action="{{ action('NotaFiscalController@store') }}" method="post" name="cad_notafiscal">
         <div class="row">
         <div class="col-lg-12">
         <div class="card">
                <div class="row">
                    <br>
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
                <div class="card-action">
                  <br>
                  <div class="row">
                    <br>
                    <div class="col-md-6" align="center">
                      <h4>
                        <strong>
                          <?php echo $fornecedor->razao_social; ?><br>
                          <small>
                            @if (!empty($municipios))
                              <?php echo "(".$fornecedor->endereco.", ".$fornecedor->complemento.", ".$municipios->nome." - ".$municipios->uf." - Insc. Municipal: ".$fornecedor->insc_municipal.")"; ?>
                            @else
                              <?php echo "(".$fornecedor->endereco.", ".$fornecedor->complemento.", '-' '-' - Insc. Municipal: ".$fornecedor->insc_municipal.")"; ?>
                            @endif
                          </small>
                        </strong>
                      </h4>
                    </div>
                    <div class="col-md-6" align="center">
                      <h4>
                        <strong>
                          NOTA FISCAL DE SERVIÇOS<br>
                        </strong>
                        <small>
                          Imposto sobre serviços de qualquer natureza<br>
                        </small>
                      </h4>
                      <br>
                      MOD.4<br>
                        <br>
                        <div class="col-md-3">
                          <p></p>
                        </div>
                        <div class="col-md-3">
                          <label>VALIDADE: </label>
                          <input type="date" id="validade" name="data_lancamento" maxlength="8" value="" class="obrigatorio_data_lancamento">
                        </div>
                        <div class="col-md-4">
                          <label>Nº ORDEM DE COMPRA: </label>
                          <input type="number" id="ordemcompra" name="ordemcompra" maxlength="8" value="" onblur="buscaOrdemCompra(this.value)">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="card-content">
                      <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token(); !!}"> 
                        <input type="hidden" name="fornecedorid" value="{{ $fornecedor->id }}">
                        <input type="hidden" id="perfilusuario" name="perfilusuario" value="{{ Auth::user()->id_perfilusuario }}">
                        <div class="col-md-2">
                        <label for="nota_fiscal">Número Nota Fiscal</label>
                          <input type="text" placeholder="{!! @$next !!}" readonly="true">
                        </div>
                        <input type="hidden" name="nota_fiscal" value="{!! @$next !!}">
                        <div class="col-md-1">
                        <label for="serie">Série</label>
                          <input type="text" placeholder="{!! @$nextSerie !!}" readonly="true">
                        </div>
                        <input type="hidden" name="serie" value="{!! @$nextSerie !!}">
                        <div class="col-md-1">
                          <p></p>
                        </div>
                        <div class="col-md-3">
                        <label for="cnpj_cpf">CNPJ/CPF</label>
                          <input type="text" id="cnpj_cpf" name="cnpj_cpf" value="" maxlength="18" onkeypress="mask(this,val_cnpj)" class="validate" onblur="buscaEstabelecimentoAgenda(this.value)">
                          <input type="hidden" name="estabid" value="">
                        </div>
                        <div class="col-md-11" align="left">
                        <label for="razao_social">Tomador do Serviço</label>
                          <input id="razao_social" type="text" maxlength="20" value="" readonly="true">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-10">
                        <label for="endereco">Endereço</label>
                          <input type="text" id="endereco" maxlength="255" value="" readonly="true">
                        </div>
                        <div class="col-md-1">
                          <label for="num_endereco">Número</label>
                          <input type="text" id="num_endereco" maxlength="255" value="" readonly="true">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="cidade">Cidade</label>
                          <input type="text" id="cidade" maxlength="255" value="" readonly="true">
                        </div>
                        <div class="col-md-3">
                          <label for="estado">Estado</label>
                          <input type="text" id="estado" maxlength="2" value="" readonly="true">
                        </div>
                        <div class="col-md-3">
                          <label for="insc_municipal">Inscrição Municipal</label>
                          <input type="text" id="insc_municipal" maxlength="255" value="" readonly="true">
                        </div>
                        <div class="col-md-2">
                        <label for="data_emissao">Data de Emissão</label>
                          <input type="date" name="data_emissao" class="validate obrigatorio_data_emissao" maxlength="8" value="">
                        </div>
                      </div>
                      <div id="servicos">
                          <div class="row" id="0">
                            <div class="col-md-1">
                              <label for="unidade">Unidade</label>
                              <input type="text" id="unidade[0]" name="servicos[0][unidade]" class="validate obrigatorio_unidade" maxlength="255" value="">
                            </div>
                            <div class="col-md-1">
                            <label for="quantidade">Quantidade</label>
                              <input type="text" id="quantidade[0]" name="servicos[0][quantidade]" class="validate obrigatorio_quantidade" maxlength="255" value="" onblur="calcular(0, 1)">
                            </div>
                            <div class="col-md-4">
                              <label for="descricao">Descrição</label>
                              <input type="text" id="descricao[0]" name="servicos[0][descricao]" class="validate obrigatorio_descricao" maxlength="255" value="">
                            </div>
                            <div class="col-md-2">
                              <label for="p_unit">P.UNIT</label>
                              <input type="text" id="p_unit[0]" name="servicos[0][valor_unitario_item]" class="validate obrigatorio_p_unit" maxlength="255" value="" onblur="calcular(0, 2)">
                            </div>
                            <div class="col-md-2">
                              <label for="total">Total</label>
                              <input type="text" id="total[0]" class="validate totais" name="servicos[0][valor_total_item]" maxlength="255" value="" readonly="true">
                            </div>
                            <div class="col-md-1">
                              <br>
                                <a href=# style=color:green id="add">[ adicionar ]</a>
                            </div>
                          </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-md-2">
                            <label for="total">Valor Total dos Serviços</label>
                            <input type="text" id="valor_total" name="valor_total_bruto" maxlength="255" value="" readonly="true">
                        </div>
                        <div class="col-md-1">
                          <p></p>
                        </div>
                        <div class="col-md-2">
                            <label for="valor_iss">Retenção do ISS Na Fonte</label>
                            <input type="text" id="valor_iss" name="vlr_iss" maxlength="255" value="" readonly="true">
                            <input type="hidden" id="valor_irrf" name="vlr_irrf" value="">
                        </div>
                        <div class="col-md-1">
                          <p></p>
                        </div>
                        <div class="col-md-2">
                            <label for="vlr_outros">Outras Retenções</label>
                            <input type="text" id="valor_outras_ret" name="vlr_outros" maxlength="255" value="" readonly="true">
                        </div>
                        <div class="col-md-1">
                          <p></p>
                        </div>
                        <div class="col-md-2">
                            <label for="total">Valor a Pagar</label>
                            <input type="text" id="valor_total_geral" name="valor_total_liquido" maxlength="255" value="" readonly="true">
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-11">
                            <label for="observacao">Observação</label>
                            <textarea id="observacao"  class="form-control" type="text" name="observacao" maxlength="255"></textarea>
                        </div>
                      </div>
                      <div class="row">
                      <div class="input-field col s1">
                        </div>

                        <div class="input-field col s2">
                            <a href="#"  class="waves-effect waves-light btn">Voltar</a>
                        </div>
                        <div class="input-field col s1">
                            <input type="submit" value="salvar" id="submit" class="waves-effect waves-light btn">
                        </div>
                      </div>

                  <div class="clearBoth"></div>
                  </div>
                  </div>
                  </div>
            </div>
      </div>
      </form>
<script>

$i = 1;

$("#add").click(function(){

   $servicos = $("#servicos");
   $container = '<div class="row" id="'+$i+'">' 

               +'<div class="col-md-1">'
                  +'<label for="unidade">Unidade</label>'
                  +'<input type="text" id="unidade['+$i+']" name="servicos['+$i+'][unidade]" class="validate" maxlength="255" value="">'
                +'</div>'

                +'<div class="col-md-1">'
                  +'<label for="quantidade">Quantidade</label>'
                  +'<input type="text" id="quantidade['+$i+']" onblur="calcular('+$i+', 1)" name="servicos['+$i+'][quantidade]" class="validate" maxlength="255" value="">'
                +'</div>'

                +'<div class="col-md-4">'
                  +'<label for="descricao">Descrição</label>'
                  +'<input type="text" id="descricao['+$i+']" name="servicos['+$i+'][descricao]" class="validate" maxlength="255" value="">'
                +'</div>'

                +'<div class="col-md-2">'
                  +'<label for="p_unit">P.UNIT</label>'
                  +'<input type="text" id="p_unit['+$i+']" onblur="calcular('+$i+', 2)" name="servicos['+$i+'][valor_unitario_item]" class="validate" maxlength="255" value="" >'
                +'</div>'

                +'<div class="col-md-2">'
                  +'<label for="total">Total</label>'
                  +'<input type="text" id="total['+$i+']" class="totais" name="servicos['+$i+'][valor_total_item]" maxlength="255" value="" readonly="true">'
                +'</div>'

                +'<div class="col-md-1">'
                  +'<a href=# style=color:red onclick=removeLinha('+$i+')>[ remover ]</a>'
                +'</div>'

            +'</div>';

       $servicos.append($container);
       $i++;
});

function removeLinha(id)
{
   $('#'+id).remove();
}

function calcular(id, parametro) {

    if (parametro == 1) {
        var quantidade = document.getElementById('quantidade['+id+']').value;        

        var new_id = 'p_unit['+id+']';
        if (document.getElementById(new_id) == null) {
          var p_unitario = 0;    
        } else {
          var p_unitario = document.getElementById(new_id).value;    
        }
    }

    if (parametro == 2) {
        var p_unitario = document.getElementById('p_unit['+id+']').value;
          
        var new_id = 'quantidade['+id+']';
        if (document.getElementById(new_id) == null) {
          var quantidade = 0;
        } else {
          var quantidade = document.getElementById(new_id).value;
        }
    }

    document.getElementById('total['+id+']').value = (quantidade*p_unitario).toFixed(2);
    Soma();
    ISS();
}

function Soma(){
  var soma = 0;
  $('.totais').each(function(){
    var valorItem = parseFloat($(this).val());

    if(!isNaN(valorItem))
      soma += parseFloat(valorItem);
  });

  var valor_iss = soma*0.02;
  var valor_irrf = soma*0.015;
  var valor_pis = soma*0.0465;
  var total_outras_ret = valor_irrf + valor_pis;
  var total_iss = soma-valor_iss;

  var valor_total_geral = soma-valor_iss-total_outras_ret;

  $('#valor_total').val((soma).toFixed(2));
  $('#valor_iss').val((valor_iss).toFixed(2));
  $('#valor_irrf').val((valor_irrf).toFixed(2));
  $('#valor_outras_ret').val((total_outras_ret).toFixed(2));
  $('#valor_total_geral').val((valor_total_geral).toFixed(2));
}

function buscaOrdemCompra(res)
{
  if (res != '') {
    var script = document.createElement('script');
    script.src = 'http://'+window.location.hostname+'/busca_ordem_compra/'+res;
    document.body.appendChild(script);
  }
}

function buscaEstabelecimentoAgenda(res)
{
    var cnpj = res.replace('.', "");
    cnpj = cnpj.replace(".", "");
    cnpj = cnpj.replace("/", "");
    cnpj = cnpj.replace("-", "");

    if (isNaN(cnpj)) {   
      $("#razao_social").val('');
      $("#endereco").val('');
      $("#num_endereco").val('');
      $("#cidade").val('');
      $("#estado").val('');
      $("#insc_municipal").val('');
      return false;
    } 
    
    var script = document.createElement('script');
    script.src = 'http://'+window.location.hostname+'/busca_estabelecimento_agenda/'+cnpj;
    document.body.appendChild(script);
}

function callbackOrdemCompra(existente) {  

   if (existente == 'nao_existente') {
      alert('Ordem De Compra Não Existente');
      $("#ordemcompra").val('');
      return false;
   }
   return true;
}

function callbackAgenda(conteudo) {  

   if (conteudo.id > 0) { 
      $("#razao_social").val(conteudo.razao_social);
      $("#endereco").val(conteudo.endereco);
      $("#num_endereco").val(conteudo.num_endereco);
      $("#cidade").val(conteudo.nome);
      $("#estado").val(conteudo.uf);
      $("#insc_municipal").val(conteudo.insc_municipal);
   } else {
      alert('CNPJ não encontrado');  
      $("#razao_social").val('');
      $("#endereco").val('');
      $("#num_endereco").val('');
      $("#cidade").val('');
      $("#estado").val('');
      $("#insc_municipal").val('');
   }
}

$("#form").submit(function() {
    if($("#cnpj_cpf").val()== null || $("#cnpj_cpf").val() ==""){
        alert('Informar CNPJ/CPF');      
        return false;
    }

    if($(".obrigatorio_data_emissao").val()== null || $(".obrigatorio_data_emissao").val() ==""){
        alert('Informar Data de Emissão');      
        return false;
    }

    if($(".obrigatorio_data_lancamento").val()== null || $(".obrigatorio_data_lancamento").val() ==""){
        alert('Informar Data de Validade');      
        return false;
    }

    if($("#ordemcompra").val()== null || $("#ordemcompra").val() ==""){
        alert('Informar Número da Ordem de Compra');      
        return false;
    }

    if($(".obrigatorio_unidade").val()== null || $(".obrigatorio_unidade").val() ==""){
        alert('Informar Unidade');      
        return false;
    }

    if($(".obrigatorio_quantidade").val()== null || $(".obrigatorio_quantidade").val() ==""){
        alert('Informar a Quantidade');
        return false;
    }

    if($(".obrigatorio_descricao").val()== null || $(".obrigatorio_descricao").val() ==""){
        alert('Informar a Descrição');      
        return false;
    }

    if($(".obrigatorio_p_unit").val()== null || $(".obrigatorio_p_unit").val() ==""){
        alert('Informar o Preço Unitário');      
        return false;
    }
});

</script>