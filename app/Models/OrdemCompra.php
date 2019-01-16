<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use DB;

class OrdemCompra extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'ordemcompra';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'empresaid',
        'estabid',
        'fornecedorid',
        'ordemcompra'
    ];


    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor','fornecedorid');
    }

    public function estabelecimento($id, $mask = false)
    {
        $query = "SELECT A.cnpj FROM agenda.estabelecimentos A WHERE A.id =".$id;
        $retorno = DB::Select($query);

        if (!$mask) {
            return $this->maskCNPJ($retorno[0]->cnpj);
        } else {
            return $retorno[0]->cnpj;
        }
    }

    private function maskCNPJ($cnpj)
    {
        if (strlen($cnpj) == 14) {
            return $this->mask($cnpj, '##.###.###/####-##');
        }
    }

    private function mask($val, $mask)
    {
         $maskared = '';
         $k = 0;
         for($i = 0; $i<=strlen($mask)-1; $i++)
         {
         if($mask[$i] == '#')
         {
         if(isset($val[$k]))
         $maskared .= $val[$k++];
         }
         else
         {
         if(isset($mask[$i]))
         $maskared .= $mask[$i];
         }
         }
         return $maskared;
    }

}
