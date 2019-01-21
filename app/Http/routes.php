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
Route::group(['middleware' => ['web']], function() {
	
	Route::get('/', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
	Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@login']);
    Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

	Route::get('/forcelogout', array('as'=>'forcelogout', 'uses'=>'PagesController@forcelogout'));

});

Route::group(['middleware' => ['auth']], function() {
	
	Route::get('/teste', function () { return view('nota_fiscal.show'); });
	Route::get('/', [ 'as' => 'home', 'uses' => 'PagesController@home' ]);
	Route::get('/home', 'HomeController@index')->name('home');
	
	Route::get('/usuarios', array('as'=>'usuario.listar', 'uses'=>'UsuariosController@listar'));
	Route::get('/usuario/create', 'UsuariosController@create');
	Route::post('/usuario/create', 'UsuariosController@create');
	Route::get('/usuarios/edit/{id}', array('as'=>'usuario.editar', 'uses'=>'UsuariosController@editar'));
	Route::post('/usuarios/edit/{id}', array('as'=>'usuario.editar', 'uses'=>'UsuariosController@editar'));
	Route::get('/usuarios/delete/{id}', array('as'=>'usuario.excluir', 'uses'=>'UsuariosController@destroy'));

	Route::get('/fornecedores', array('as'=>'fornecedor.listar', 'uses'=>'FornecedoresController@listar'));
	Route::get('/fornecedor/create', 'FornecedoresController@create');
	Route::post('/fornecedor/create', 'FornecedoresController@create');
	Route::get('/fornecedor/edit/{id}', array('as'=>'fornecedor.editar', 'uses'=>'FornecedoresController@editar'));
	Route::post('/fornecedor/edit/{id}', array('as'=>'fornecedor.editar', 'uses'=>'FornecedoresController@editar'));
	Route::get('/fornecedor/delete/{id}', array('as'=>'fornecedor.excluir', 'uses'=>'FornecedoresController@destroy'));

	Route::get('/busca_fornecedor/{id}', array('as'=>'fornecedor.find', 'uses'=>'FornecedoresController@find'));
	Route::get('/busca_fornecedor_agenda/{cnpj}', array('as'=>'fornecedor_agenda.find', 'uses'=>'OrdemCompraController@find'));

	Route::get('/busca_estabelecimento_agenda/{cnpj}', array('as'=>'estabelecimento_agenda.find', 'uses'=>'NotaFiscalController@find'));

	Route::get('/busca_ordem_compra/{ordemcompra}', array('as'=>'ordem_compra.find', 'uses'=>'OrdemCompraController@findOrdem'));

	//ordemcompra
	Route::get('/ordemcompra', 'OrdemCompraController@create');
	Route::post('/ordemcompra', 'OrdemCompraController@create');
	Route::get('/ordemcompra/delete/{id}', array('as'=>'ordemcompra.excluir', 'uses'=>'OrdemCompraController@destroy'));

	//notafiscalservico
	Route::get('/notafiscal/consulta', array('as'=>'notafiscal.listar', 'uses'=>'NotaFiscalController@listar'));
	Route::get('/notafiscal', 'NotaFiscalController@create');
	Route::get('/notafiscal/create', 'NotaFiscalController@store');
	Route::post('/notafiscal', 'NotaFiscalController@create');
	Route::post('/notafiscal/create', 'NotaFiscalController@store');

});
