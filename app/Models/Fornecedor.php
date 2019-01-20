<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Fornecedor extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'fornecedor';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'empresaid',
        'razao_social',
        'nome_fantasia',
        'tipo',
        'cnpj_cpf',
        'insc_estadual',
        'insc_municipal',
        'endereco',
        'complemento',
        'cod_municipio',
        'cep',
        'telefone',
        'contato',
        'email',
        'status',
        'usuario',
        'data_cadastro',
        'data_alteracao'

    ];

    /*pubic fcuntion itens()
    {
        return has many com o id_notafiscal que está na outra tabela.
        
    }*/

}
