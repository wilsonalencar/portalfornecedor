<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class PagesController extends Controller
{
   	public function home(Request $request, $empresaID=false)
    { 
        if (!Auth::guest()) {
            $user = Usuarios::findOrFail(Auth::user()->usuarioid);

            if (!empty($_GET['empresa_selecionada'])) {
                $key = $_GET['empresa_selecionada'];
                $s = DB::select("Select COUNT(1) as ct FROM permissaoempresas where id_usuario = ".Auth::user()->usuarioid." AND id_empresa = ". $key . "");
                if (!$s[0]->ct) {
                    echo "Você não tem acesso a empresa informada.<br/><br/><a href='home'>VOLTAR</a>";
                    exit;
                }

                $request->session()->put('seid', $key);

                // $Grupo_Empresa = new GrupoEmpresasController;
                // $emp = $Grupo_Empresa->getEmpresas($key, true);
                
                // $request->session()->put('seidLogo', $emp);


                return view('principal.index');
            } else {
                $user = Usuarios::findOrFail(Auth::user()->usuarioid);

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

                foreach($empresas as $key => $empresa) {

                    $s = DB::select("SELECT 
                                COUNT(1) as ct 
                            FROM
                                permissaoempresas A
                            INNER JOIN 
                                usuarios B on A.id_usuario = B.usuarioid
                            WHERE 
                                B.usuarioid = '".Auth::user()->usuarioid."'
                            AND
                                A.id_empresa = ".$empresa->id."
                        ");
                    
                    if ($s[0]->ct) {
                        $empresasArray[$empresa->id] = $empresa->razao_social;
                    }
                }

                return view('principal.selecionarempresa')->with('empresas', $empresasArray);
            }

            if (!session()->get('seid') || isset($_GET['selecionar_empresa'])) {
                $user = Usuarios::findOrFail(Auth::user()->usuarioid);

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

                foreach($empresas as $key => $empresa) {

                    $s = DB::select("SELECT 
                                COUNT(1) as ct 
                            FROM
                                permissaoempresas A
                            INNER JOIN 
                                usuarios B on A.id_usuario = B.usuarioid
                            WHERE 
                                B.usuarioid = '".Auth::user()->usuarioid."'
                            AND
                                A.id_empresa = ".$empresa->id."
                        ");
                    
                    if ($s[0]->ct) {
                        $empresasArray[$empresa->id] = $empresa->razao_social;
                    }
                }

                return view('principal.selecionarempresa')->with('empresas', $empresasArray);
            }
        }      
    }

    public function forcelogout()
    {
        Session::forget('seid');
        Session::forget('seidLogo');
        return response()->redirectTo('http://dev.platform');
    }
}