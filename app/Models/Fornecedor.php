<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use App\Models\OrdemCompra;
use App\Models\Usuarios;
use App\Models\NotaFiscal;

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

    public static function CheckToDelete($id)
    {
        $verify_1 = NotaFiscal::Where('fornecedorid', $id)->get()->toarray();
        $verify_2 = Usuarios::Where('id_fornecedor', $id)->get()->toarray();
        $verify_3 = OrdemCompra::Where('fornecedorid', $id)->get()->toarray();

        if (!empty($verify_3) || !empty($verify_2) || !empty($verify_1)) {
            return false;
        }
        return true;
    }

    /*pubic fcuntion itens()
    {
        return has many com o id_notafiscal que está na outra tabela.
        
    }*/

}
