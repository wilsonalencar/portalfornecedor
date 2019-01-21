<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Estabelecimento extends Model
{
    protected $table = env('DB_DATABASE1').'estabelecimentos';
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
        'cnpj',
        'razao_social',
        'endereco',
        'num_endereco',
        'insc_estadual',
        'insc_municipal',
        'cod_municipio',
        'data_cadastro',
        'empresa_id',
        'ativo',
        'carga_msaf_entrada',
        'carga_msaf_saida',
        'Id_usuario_entrada',
        'Dt_alteracao_entrada',
        'Id_usuario_saida',
        'Dt_alteracao_saida'
    ];

    /**
     * Get the municipio record associated with the empresa.
     */
    public function municipio()
    {
        return $this->belongsTo('App\Models\Municipio','cod_municipio');
    }
}
