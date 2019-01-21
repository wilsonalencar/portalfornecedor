<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = env('DB_DATABASE1').'municipios';
    protected $primaryKey = 'codigo';
    //public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
        'nome',
        'uf'
    ];

}
