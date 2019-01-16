<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Hash;
use DB;

class Usuarios extends Authenticatable
{
	protected $primaryKey = 'usuarioid';
    protected $table = 'usuarios';
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'usuarioid',
        'nome',
        'email',
        'id_perfilusuario',
        'password',
        'reset_senha',
        'usuario',
        'data_criacao',
        'data_alteracao',
        'status'
    ];

    public function CreateUserInPlataforma($input)
    {
        $usuario = DB::Select('select * from plataforma.plataformausuario where plataformausuario.email= "'.$input['email'].'" limit 1');
        if (!empty($usuario)) {
            $this->AlterUserInPlatform($input, $usuario[0]->email);
        } else {
            $this->InsertUserInPlatform($input);
        }
    }   

    private function InsertUserInPlatform($input)
    {
        DB::TABLE('plataforma.plataformausuario')->insert([
            'nome' => $input['nome'],
            'email' => $input['email'],
            'id_perfilusuario' => 7,
            'id_responsabilidade' => 0,
            'senha' => base64_encode('ADMIN123'),
            'reset_senha' => 'S',
            'usuario' => Auth::User()->email,
            'status' => 'A',
            'data_cadastro' => date('Y-m-d H:i:s')
        ]);
    }

    private function AlterUserInPlatform($input, $email)
    {
        if ($input['reset_senha'] == 'S') {
            DB::TABLE('plataforma.plataformausuario')->where('email', $email)
            ->update([
                'nome' => $input['nome'],
                'email' => $input['email'],
                'id_responsabilidade' => 0,
                'reset_senha' => $input['reset_senha'],
                'senha' => base64_encode('ADMIN123'),
                'status' => $input['status'],
                'usuario' => Auth::User()->email,
                'data_alteracao' => date('Y-m-d H:i:s')
            ]);
        } else {
            DB::TABLE('plataforma.plataformausuario')->where('email', $email)
            ->update([
                'nome' => $input['nome'],
                'email' => $input['email'],
                'status' => $input['status'],
                'usuario' => Auth::User()->email,
                'data_alteracao' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function DeleteUserInPlatform($email)
    {
        DB::TABLE('plataforma.plataformausuario')->where('email', $email)->delete();
    }

    public function perfil()
    {
        return $this->belongsTo('App\Models\PerfilUsuario','id_perfilusuario');
    }
}
