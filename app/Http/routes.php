<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




		
			$prefixo = '/portalfornecedor';			
			Route::get($prefixo.'/', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
			Route::get($prefixo.'/login', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
			Route::post($prefixo.'/login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@login']);
			Route::post($prefixo.'/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

			Route::get($prefixo.'/forcelogout', array('as'=>'forcelogout', 'uses'=>'PagesController@forcelogout'));
			Route::get($prefixo.'/forcelogoutall', array('as'=>'forcelogoutall', 'uses'=>'PagesController@forcelogoutall'));

		

		Route::group(['middleware' => ['auth']], function() {
			$prefixo = '/portalfornecedor';
			
			Route::get($prefixo.'/teste', function () { return view('nota_fiscal.show'); });
			Route::get($prefixo.'/', [ 'as' => 'home', 'uses' => 'PagesController@home' ]);
			Route::get($prefixo.'/home', 'HomeController@index')->name('home');
			
			Route::get($prefixo.'/usuarios', array('as'=>'usuario.listar', 'uses'=>'UsuariosController@listar'));
			Route::get($prefixo.'/usuario/create', 'UsuariosController@create');
			Route::post($prefixo.'/usuario/create', 'UsuariosController@create');
			Route::get($prefixo.'/usuarios/edit/{id}', array('as'=>'usuario.editar', 'uses'=>'UsuariosController@editar'));
			Route::post($prefixo.'/usuarios/edit/{id}', array('as'=>'usuario.editar', 'uses'=>'UsuariosController@editar'));
			Route::get($prefixo.'/usuarios/delete/{id}', array('as'=>'usuario.excluir', 'uses'=>'UsuariosController@destroy'));

			Route::get($prefixo.'/fornecedores', array('as'=>'fornecedor.listar', 'uses'=>'FornecedoresController@listar'));
			Route::get($prefixo.'/fornecedor/create', 'FornecedoresController@create');
			Route::post($prefixo.'/fornecedor/create', 'FornecedoresController@create');
			Route::get($prefixo.'/fornecedor/edit/{id}', array('as'=>'fornecedor.editar', 'uses'=>'FornecedoresController@editar'));
			Route::post($prefixo.'/fornecedor/edit/{id}', array('as'=>'fornecedor.editar', 'uses'=>'FornecedoresController@editar'));
			Route::get($prefixo.'/fornecedor/delete/{id}', array('as'=>'fornecedor.excluir', 'uses'=>'FornecedoresController@destroy'));

			Route::get($prefixo.'/busca_fornecedor/{id}', array('as'=>'fornecedor.find', 'uses'=>'FornecedoresController@find'));
			Route::get($prefixo.'/busca_fornecedor_agenda/{cnpj}', array('as'=>'fornecedor_agenda.find', 'uses'=>'OrdemCompraController@find'));

			Route::get($prefixo.'/busca_estabelecimento_agenda/{cnpj}', array('as'=>'estabelecimento_agenda.find', 'uses'=>'NotaFiscalController@find'));

			Route::get($prefixo.'/busca_ordem_compra/{ordemcompra}/{estabid}', array('as'=>'ordem_compra.find', 'uses'=>'OrdemCompraController@findOrdem'));

			//ordemcompra
			Route::get($prefixo.'/ordemcompra', 'OrdemCompraController@create');
			Route::post($prefixo.'/ordemcompra', 'OrdemCompraController@create');
			Route::get($prefixo.'/ordemcompra/delete/{id}', array('as'=>'ordemcompra.excluir', 'uses'=>'OrdemCompraController@destroy'));

			//notafiscalservico
			Route::get($prefixo.'/notafiscal/repositorio', 'NotaFiscalController@repositorio');
			Route::get($prefixo.'/notafiscal/repositorio/{id}', 'NotaFiscalController@show');
			Route::get($prefixo.'/notafiscal/consulta', array('as'=>'notafiscal.listar', 'uses'=>'NotaFiscalController@listar'));
			Route::get($prefixo.'/notafiscal', 'NotaFiscalController@create');
			Route::get($prefixo.'/notafiscal/create', 'NotaFiscalController@store');
			Route::post($prefixo.'/notafiscal', 'NotaFiscalController@create');
			Route::post($prefixo.'/notafiscal/create', 'NotaFiscalController@store');
			Route::get($prefixo.'/notafiscal/delete/{id}', array('as'=>'notafiscal.excluir', 'uses'=>'NotaFiscalController@destroy'));
			Route::get($prefixo.'/notafiscal/edit/{id}', array('as'=>'notafiscal.editar', 'uses'=>'NotaFiscalController@editar'));
			Route::post($prefixo.'/notafiscal/edit/{id}', array('as'=>'notafiscal.editar', 'uses'=>'NotaFiscalController@editar'));
			
			Route::get($prefixo.'/notafiscal/exportar', array('as'=>'notafiscal.export', 'uses'=>'NotaFiscalController@exportarDados'));

			Route::get($prefixo.'/notafiscal/download/{id}', array('as'=>'notafiscal.download', 'uses'=>'NotaFiscalController@download'));
		});
