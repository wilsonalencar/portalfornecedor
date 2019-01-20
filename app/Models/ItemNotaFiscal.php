<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use DB;

class ItemNotaFiscal extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'itemnotafiscal';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'notafiscal_id',
        'quantidade',
        'unidade',
        'descricao',
        'valor_unitario_item',
        'valor_total_item',
        'aql_iss',
        'vlr_iss',
        'alq_irrf',
        'vlr_irrf',
        'aql_outros',
        'vlr_outros',
        'aql_inss',
        'vlr_inss'
    ];
}
