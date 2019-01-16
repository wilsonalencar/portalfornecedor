<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class PermissaoAcesso extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'permissaoacesso';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id_perfil',
        'id_funcionalidade'
    ];
}
