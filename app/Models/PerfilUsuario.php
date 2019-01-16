<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use DB;

class PerfilUsuario extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'perfilusuario';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'status'
    ];

    public function hasRole($funcionalidade)
    {   
        $a = DB::Table('permissaoacesso')
        ->join('funcionalidades', 'funcionalidades.id', '=', 'permissaoacesso.id_funcionalidade')
        ->where('permissaoacesso.id_perfil', $this->id)
        ->where('funcionalidades.status', 'A')
        ->get();
        
        $permissions = array();
        if (!empty($a)) {
            foreach ($a as $x => $single_permission) {
                $name = $this->sanitizeString($single_permission->nome);
                if ($name == $funcionalidade) {
                    return true;
                }
            }
        }

        return false;
    }

    private function sanitizeString($string) {

        $string = strtolower($string);

        // matriz de entrada
        $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

        // matriz de saída
        $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

        // devolver a string
        return str_replace($what, $by, $string);
    }
}
