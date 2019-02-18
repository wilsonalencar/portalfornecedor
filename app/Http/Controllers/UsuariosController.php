<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\PerfilUsuario;
use App\Models\Fornecedor;
use App\Models\PermissaoEmpresas;
use Auth;
use Hash;
use DB;

class UsuariosController extends Controller
{
	public $msg = array();

	public function Login(Request $request)
	{
		$this->Authenticate($request);
	}

	private function Authenticate(Request $request)
	{   
        $input = $request->all();
        $user = Usuarios::where('email', $request->input('email'))->where('status', 'A')->first();

        if (!empty($user)) {
           if(Hash::check($request->input('password'), $user->senha)){
            
                /*$Usuarios = new Usuarios;
                $privilegios = $Usuarios->loadPrivilegios($user->id, true);*/
                
                unset($user->senha);

                $request->session()->put( [
                        'Session'           => $user
                        /*'Privilegios'       => $privilegios*/
                    ]
                );
                return redirect('index');
           }
        } 
	        
	    return false;
	}

    public function create(Request $request)
    {
        $empresas = $this->montaSelect();
        $perfis = PerfilUsuario::All();

        if (!empty($request->all())) {
        
            if (!$this->validation($request->all())) {
                $success = false;
                return view('usuarios.create', compact('empresas','perfis', 'success'))->with('msg', $this->msg);
            }      

            //cria usuario
            $input = $request->all();
    
            if (!empty($request->input('cnpj_cpf'))) {
                $input['id_fornecedor'] = $this->findFornecedor($request->input('cnpj_cpf'));
            }
    
            $input['password'] = Hash::make('ADMIN123');
            $input['usuario'] = Auth::user()->email;
            $input['data_criacao'] = date('Y-m-d H:i:s');
            $input['data_alteracao'] = date('Y-m-d H:i:s');
            $usuario = Usuarios::create($input);


            //acesso de empresas

            if (!empty($input['id_empresa'])) {
                if (!isset($input['id_fornecedor'])) {
                    foreach ($input['id_empresa'] as $key => $empresaid) {
                        $acesso[$key]['id_usuario'] = $usuario->usuarioid;
                        $acesso[$key]['id_empresa'] = $empresaid;    
                    }
                } else {
                    $fornecedor = Fornecedor::findOrFail($input['id_fornecedor']);
                    $acesso[0]['id_usuario'] = $usuario->usuarioid;
                    $acesso[0]['id_empresa'] = $fornecedor->empresaid;
                }
            }

            foreach ($acesso as $x => $single_acesso) {
                PermissaoEmpresas::Create($single_acesso);
            }

            //cria usuário ou edita no plataforma
            $Usuarios = New Usuarios;
            $Usuarios->CreateUserInPlataforma($request->all());

            $success = 'true'; 
            $this->msg[] = 'Usuário cadastrado com sucesso';

            return view('usuarios.create', compact('empresas','perfis', 'success'))->with('msg', $this->msg);
        }

        return view('usuarios.create', compact('empresas','perfis'));
    }

    private function findFornecedor($cnpj)
    {
        $fornecedor = Fornecedor::where('cnpj_cpf', $this->numero($cnpj))->first();
        return $fornecedor->id;
    }

    public function numero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    public function montaSelect()
    {
        $user = Usuarios::FindorFail(Auth::User()->usuarioid);
        $empresas_user_query = "SELECT id_empresa FROM permissaoempresas where id_usuario =".$user->usuarioid;
        $empresas_user = DB::select($empresas_user_query);

        $empresas_user_string = ''; 

        if (!empty($empresas_user)) {
            foreach ($empresas_user as $x => $empresaid) {
                $empresas_user_string .= $empresaid->id_empresa.',';
            }
        }
        
        $empresas_user_string = substr($empresas_user_string, 0,-1);
        $query = "SELECT razao_social, id FROM agenda.empresas where id in(".$empresas_user_string.")";

        $empresas = DB::select($query);
        $empresasArray = array();
        $i = 0;
        foreach($empresas as $key => $empresa) {
            $empresasArray[$i]['id'] = $empresa->id;
            $empresasArray[$i]['razao_social'] = $empresa->razao_social;
            $i ++;
        }
        return $empresasArray;
    }

    private function validation($input, $edit = false)
    {
        $input['cnpj_cpf'] = $this->numero($input['cnpj_cpf']);

        $status = true;
        if (!$edit) {
            if (!empty($input['email'])) {
                $usuario = Usuarios::Where('email', $input['email'])->first();
            }
            if (!empty($usuario)) {
                $this->msg[] = 'Usuário Já Cadastrado';
                $status = false;
            }
        }

        if (empty($input['nome'])) {
            $this->msg[] = 'Favor Informar o Nome do Usuário';
            $status = false;
        }

        if (empty($input['email'])) {
            $this->msg[] = 'Favor Informar o Email';
            $status = false;
        }

        if (empty($input['id_perfilusuario'])) {
            $this->msg[] = 'Favor Informar o Perfil do Usuário';
            $status = false;
        }

        if (empty($input['id_empresa']) && $input['id_perfilusuario'] != 4) {
            $this->msg[] = 'Favor Selecionar a Empresa';
            $status = false;
        }

        if ($input['id_perfilusuario'] == 4) {
            if (empty($input['cnpj_cpf'])) {
                $this->msg[] = 'Favor preencher o CNPJ/CPF';
                $status = false;
            } else {
                $fornecedor = Fornecedor::where('cnpj_cpf', $input['cnpj_cpf'])->first();
                if (empty($fornecedor)) {
                    $this->msg[] = 'Fornecedor não cadastrado.';
                    $status = false;   
                }
            }
        }

        if (!$status) {
            return false;
        }

        return true;
    }

    public function listar()
    {
        $table = array();
        $usuario = Usuarios::Find(Auth::user()->usuarioid);
        //if ($usuario->perfil->id == 2) {
        if (2 == 2) {
            $empresas_user_query = "SELECT id_empresa FROM permissaoempresas where id_usuario =".$usuario->usuarioid;
            $empresas_user = DB::select($empresas_user_query);
            if (!empty($empresas_user)) {
                $table = $this->listarToGerente($empresas_user);
            }
        } else {
            $table = Usuarios::All();
        }

        return view('usuarios.listar')->with('table', $table);
    }

    public function listarToGerente($ids)
    {
        $userID = array();

        foreach ($ids as $x => $empresa) {
            $userID = PermissaoEmpresas::Where('id_empresa', $empresa->id_empresa)->get();
        }

        $usuarios_ids = array();
        if (!empty($userID)) {
            foreach ($userID as $x => $single_usuario) {
                $usuarios_ids[] = $single_usuario->id_usuario; 
            }
        }

        $table = Usuarios::whereIn('usuarioid', $usuarios_ids)->get();
        return $table;
    }

    public function editar($id, Request $request)
    {
        $input = $request->all();

        $empresas = $this->montaSelect();
        $perfis = PerfilUsuario::All();

        $usuario = Usuarios::findOrFail($id);
        if (!empty($input)) {
            if (!$this->validation($input, true)) {
                $success = false;

                return view('usuarios.editar', compact('empresas','perfis', 'success', 'usuario'))->with('msg', $this->msg);
            }

            PermissaoEmpresas::Where('id_usuario', $usuario->usuarioid)->delete();
            
            if ($input['id_perfilusuario'] == 4) {
                $fornecedor = Fornecedor::Where('cnpj_cpf', $input['cnpj_cpf'])->first();
                $acesso[0]['id_usuario'] = $usuario->usuarioid;
                $acesso[0]['id_empresa'] = $fornecedor->empresaid;
            } else {
            foreach ($input['id_empresa'] as $key => $value) {
                    $acesso[$key]['id_usuario'] = $usuario->usuarioid;
                    $acesso[$key]['id_empresa'] = $value;
                }
            }

            foreach ($acesso as $x => $single_acesso) {
                PermissaoEmpresas::Create($single_acesso);
            }

            $usuario->fill($input);
            $usuario->data_alteracao = date('Y-m-d H:i:s');
            $usuario->save();


            $Usuarios = New Usuarios;
            $Usuarios->CreateUserInPlataforma($request->all());

            $success = true;
            $this->msg[] = 'Usuário atualizado com sucesso';

            return view('usuarios.editar', compact('empresas','perfis', 'success', 'usuario'))->with('msg', $this->msg);
        }

        return view('usuarios.editar', compact('empresas','perfis', 'success', 'usuario'));
    }

    public function destroy($id)
    { 
        if (!empty($id)) {
            $success = true;
            
            $usuario = Usuarios::findOrFail($id);

            $Usuarios = New Usuarios;
            $Usuarios->DeleteUserInPlatform($usuario->email);

            Usuarios::destroy($id);
            $table = Usuarios::all();

            return view('usuarios.listar', compact('table', 'success'))->with('msg', 'Usuário excluído com sucesso.');
        }
    }
}
