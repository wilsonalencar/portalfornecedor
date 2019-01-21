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
        $id = DB::table('notafiscal')->orderby('nota_fiscal', 'desc')->orderby('serie', 'desc')->first();

        if (!empty($id)) {
            $last = DB::table('notafiscal')->orderby('nota_fiscal', 'desc')->first();
            return $last->nota_fiscal+000.001;
        } else {
            return '000.001 ';
        }
    }

    public function getNextSerie()
    {
        $id = DB::table('notafiscal')->orderby('nota_fiscal', 'desc')->orderby('serie', 'desc')->first();

        if (!empty($id) && $id->nota_fiscal == 999.999) {
            $last = DB::table('notafiscal')->orderby('serie', 'desc')->first();

            return $last->serie+1;
        } else {
            return '1';
        }
    }

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor','fornecedorid');
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
