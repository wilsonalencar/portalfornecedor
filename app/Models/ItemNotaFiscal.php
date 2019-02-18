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
        'alq_iss',
        'vlr_iss',
        'alq_irrf',
        'vlr_irrf',
        'alq_outros',
        'vlr_outros',
        'alq_inss',
        'vlr_inss'
    ];

    public function notafiscal()
    {
        return $this->belongsTo('App\Models\NotaFiscal','notafiscal_id');
    }
}
