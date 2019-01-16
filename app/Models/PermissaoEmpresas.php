<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class PermissaoEmpresas extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'permissaoempresas';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario',
        'id_empresa'
    ];

}
