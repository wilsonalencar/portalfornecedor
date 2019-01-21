<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use DB;

class NotaFiscal extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'notafiscal';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'empresaid',
        'estabid',
        'nota_fiscal',
        'serie',
        'fornecedorid',
        'ordemcompraid',
        'data_emissao',
        'data_lancamento',
        'observacao',
        'valor_total_bruto',
        'valor_total_liquido',
        'vlr_iss',
        'vlr_irrf',
        'vlr_outros',
        'vlr_inss'
    ];

    public function getNextNota()
    {
        $register = DB::table('notafiscal')->orderby('serie', 'desc')->orderby('nota_fiscal', 'desc')->first();
        if (!empty($register)) {
            if ($register->nota_fiscal == '9.999') {
                return '0.001';
            }
            return (float)$register->nota_fiscal+0.001;
        } else {
            return '0.001 ';
        }
    }

    public function getNextSerie()
    {
        $register = DB::table('notafiscal')->orderby('serie', 'desc')->orderby('nota_fiscal', 'desc')->first();
        if (!empty($register) && $register->nota_fiscal == '9.999') {
            return $register->serie+1;
        }

        if (!empty($register)) {
            return $register->serie;
        }

        if (empty($register)) {
            return '1';
        }
    }

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor','fornecedorid');
    }

    public function ordemcompra()
    {
        return $this->belongsTo('App\Models\OrdemCompra','ordemcompraid');
    }

    public function empresa()
    {
        $sql = "SELECT A.*, B.* from agenda.estabelecimentos A INNER JOIN agenda.municipios B on B.codigo = A.cod_municipio WHERE A.id = '".$this->estabid."'";

        $array = DB::select($sql);
        return $array[0];
    }

    public function itens()
    {
        return $this->hasMany('App\Models\ItemNotaFiscal', 'notafiscal_id');
    }
}
