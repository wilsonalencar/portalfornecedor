<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Portal do Fornecedor</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{{ URL::to('/') }}/assets/materialize/css/materialize.min.css" media="screen,projection" />
	<link href="{{ URL::to('/') }}/assets/css/bootstrap.css" rel="stylesheet" />
	<link href="{{ URL::to('/') }}/assets/css/font-awesome.css" rel="stylesheet" />
	<link href="{{ URL::to('/') }}/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<link href="{{ URL::to('/') }}/assets/css/custom-styles.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	<link rel="stylesheet" href="{{ URL::to('/') }}/assets/js/Lightweight-Chart/cssCharts.css"> 

	<!-- DataTables CSS -->
	<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/datatables-tabletools/2.1.5/css/TableTools.min.css">
	<link rel="stylesheet" href="cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">
</head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default top-navbar" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand waves-effect waves-dark" href="{!! route('forcelogout') !!}">
                        <img src="/assets/img/bravo-icon.png">
                    </a>
    				
    		<div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
                </div>

                <ul class="nav navbar-top-links navbar-right"> 
    				  <li><a class="dropdown-button waves-effect waves-dark active-menu" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b></b> <i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
            </nav>
    		<!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <li><a href="{!! route('forcelogout') !!}"><i class="fa fa-sign-in fa-fw"></i> Plataforma</a>
        </li>
    </ul>
    <ul id="dropdown2" class="dropdown-content w250">
      <li>
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
    </ul>
    <ul id="dropdown3" class="dropdown-content dropdown-tasks w250">
    <li>
    		<a href="#">
    			<div>
    				<p>
    					<strong>Task 1</strong>
    					<span class="pull-right text-muted">60% Complete</span>
    				</p>
    				<div class="progress progress-striped active">
    					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
    						<span class="sr-only">60% Complete (success)</span>
    					</div>
    				</div>
    			</div>
    		</a>
    	</li>
    	<li class="divider"></li>
    	<li>
    		<a href="#">
    			<div>
    				<p>
    					<strong>Task 2</strong>
    					<span class="pull-right text-muted">28% Complete</span>
    				</p>
    				<div class="progress progress-striped active">
    					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width: 28%">
    						<span class="sr-only">28% Complete</span>
    					</div>
    				</div>
    			</div>
    		</a>
    	</li>
    	<li class="divider"></li>
    	<li>
    		<a href="#">
    			<div>
    				<p>
    					<strong>Task 3</strong>
    					<span class="pull-right text-muted">60% Complete</span>
    				</p>
    				<div class="progress progress-striped active">
    					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
    						<span class="sr-only">60% Complete (warning)</span>
    					</div>
    				</div>
    			</div>
    		</a>
    	</li>
    	<li class="divider"></li>
    	<li>
    		<a href="#">
    			<div>
    				<p>
    					<strong>Task 4</strong>
    					<span class="pull-right text-muted">85% Complete</span>
    				</p>
    				<div class="progress progress-striped active">
    					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
    						<span class="sr-only">85% Complete (danger)</span>
    					</div>
    				</div>
    			</div>
    		</a>
    	</li>
    	<li class="divider"></li>
    	<li>
    </ul>   
    <ul id="dropdown4" class="dropdown-content dropdown-tasks w250 taskList">
      <li>
                                    <div>
                                        <strong>John Doe</strong>
                                        <span class="pull-right text-muted">
                                            <em>Today</em>
                                        </span>
                                    </div>
                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since an kwilnw...</p>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the...</p>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
    </ul>  
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu waves-effect waves-dark" href="/"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <?php if (Auth::User()->perfil->hasRole('usuarios')) { ?> 
                        <li>
                            <a class="waves-effect waves-dark active-menu" href="#"><i class="fa fa-user"></i> Usuários<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a class="active-menu" href="{{ action('UsuariosController@create') }}"> Adicionar</a>
                                </li>
                                <li>
                                    <a class="active-menu" href="{{ action('UsuariosController@listar') }}"> Consultar</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?> 
                        <?php if (Auth::User()->perfil->hasRole('fornecedor') && session()->has('seid')) { ?> 
                        <li>
                            <a class="active-menu waves-effect waves-dark" href="index.php"><i class="fa fa-group"></i> Fornecedor<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a class="active-menu" href="{{ action('FornecedoresController@create') }}"> Adicionar</a>
                                </li>
                                <li>
                                    <a class="active-menu" href="{{ action('FornecedoresController@listar') }}"> Consultar</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?> 
                        <?php if (Auth::User()->perfil->hasRole('ordem_de_compra') && session()->has('seid')) { ?> 
                        <li>
                            <a class="active-menu waves-effect waves-dark" href="{{ action('OrdemCompraController@create') }}"><i class="fa fa-money"></i> Ordem de Compra</a>
                        </li>
                        <?php } ?> 
                        <?php if (Auth::User()->perfil->hasRole('nota_fiscal_de_servico') && session()->has('seid')) { ?> 
                        <li>
                            <a class="active-menu waves-effect waves-dark" href="{{ action('NotaFiscalController@create') }}"><i class="fa fa-barcode"></i> Nota Fiscal de Serviço<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a class="active-menu" href="{{ action('NotaFiscalController@listar') }}"> Consultar</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?> 
                        <?php if (Auth::User()->perfil->hasRole('repositorio') && session()->has('seid')) { ?> 
                        <li>
                            <a class="active-menu waves-effect waves-dark" href="index.php"><i class="fa fa-bars"></i> Repositório</a>
                        </li>
                        <?php } ?> 
                        <?php if (Auth::User()->perfil->hasRole('exportar_dados') && session()->has('seid')) { ?> 
                        <li>
                            <a class="active-menu waves-effect waves-dark" href="index.php"><i class="fa fa-download"></i> Exportar Dados</a>
                        </li>
                        <?php } ?> 
                    </ul>
                </div>     
            </nav>