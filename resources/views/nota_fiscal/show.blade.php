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
    		 <div class="row">
    		 <div class="col-lg-12">
    		 <div class="card">
                <div class="card-content">
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
                    <form class="col-md-12" action="{{ action('NotaFiscalController@create') }}" method="post" name="cad_notafiscal" id="form" style="display:block;">
                        <input type="hidden" name="_token" value="{!! csrf_token(); !!}"> 
                        <input type="hidden" name="perfilusuario" value="{!! Auth::user()->id_perfilusuario; !!}" onload="checkPerfil(this.value)"> 
                      <div class="row">
                        <div class="col-md-4">
                          <label for="cnpj_cpf">CNPJ</label>
                          <input type="text" id="cnpj_cpf" name="cnpj_cpf" value="" placeholder="Informe um CNPJ" maxlength="18" onkeypress="mask(this,val_cnpj)"  onblur="mask(this,val_cnpj)" class="validate">
                        </div>
                      <div class="row">
                        <div class="input-field col s1"></div>
                        <div class="input-field col s1">
                          <br>
                            <input type="submit" value="gerar" id="submit" class="waves-effect waves-light btn">
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
  
function checkPerfil(value){
  if (value == 4) {
      $('#form').css('display', 'none');
  } else {
      $('#form').css('display', 'block');    
  }
}


</script>