<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Models\Usuarios;
use Auth;
use DB;

class FornecedoresController extends Controller
{
    public $msg = array();

    public function find($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        $array['id'] = $fornecedor->id;
        $array['municipio'] = $this->loadMunicipio($fornecedor->cod_municipio, 'municipio');
        $array['uf'] = $this->loadMunicipio($fornecedor->cod_municipio, 'uf');
        $array['cnpj_cpf'] = $this->maskCNPJCPF($fornecedor->cnpj_cpf);
        $dados = 'callback('.json_encode($array).')';
        $dados = str_replace('[', '', $dados);
        $dados = str_replace(']', '', $dados);
        return $dados;
    }


    private function loadMunicipio($codigo, $parametro)
    {
        $query = "SELECT nome, uf FROM agenda.municipios WHERE municipios.codigo = '".$codigo."'";
        $municipios = DB::select($query);   

        if ($parametro == 'municipio') {
            if (!empty($municipios[0])) {
                return $municipios[0]->nome;
            } else {
                return '';
            }
        } else {
            if (!empty($municipios[0])) {
                return $municipios[0]->uf;
            } else {
                return '';
            }
        }
    }

    private function maskCNPJCPF($cnpjcpf)
    {
        if (strlen($cnpjcpf) == 11) {
            return $this->mask($cnpjcpf, '###.###.###-##');
        } else {
            return $this->mask($cnpjcpf, '##.###.###/####-##');
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


    public function create(Request $request)
    {
        $query = "SELECT nome, codigo FROM agenda.municipios";
        $municipios = DB::select($query);

        if (!empty($request->all())) {
            if (!$this->validation($request->all())) {
                $success = false;
                return view('fornecedores.create', compact('municipios', 'success'))->with('msg', $this->msg);
            }            

            $input = $request->all();
            
            $empresas_session_query = "SELECT * FROM agenda.empresas where id =".session()->get('seid');
            $empresas_session = DB::select($empresas_session_query);
            $empresa = $empresas_session[0];

            $input['usuario'] = Auth::user()->email;
            $input['empresaid'] = $empresa->id;
            $input['status'] = 'A';
            $input['data_cadastro'] = date('Y-m-d H:i:s');
            $input['data_alteracao'] = date('Y-m-d H:i:s');

            Fornecedor::create($input);
            
            $success = true;
            $this->msg[] = 'Fornecedor cadastrado com sucesso';

            return view('fornecedores.create', compact('municipios', 'success'))->with('msg', $this->msg);
        }
        return view('fornecedores.create')->with('municipios', $municipios);
    }

    private function validation($input, $edit = false)
    {
        $status = true;
        if (!$edit) {
            if (!empty($input['cnpj_cpf'])) {
                $fornecedor = Fornecedor::Where('cnpj_cpf', $input['cnpj_cpf'])->first();
            }
            if (!empty($fornecedor)) {
                $this->msg[] = 'Fornecedor Já Cadastrado';
                $status = false;
            }   
        }

        if (empty($input['razao_social'])) {
            $this->msg[] = 'Favor Informar a Razão Social';
            $status = false;
        }

        if (empty($input['nome_fantasia'])) {
            $this->msg[] = 'Favor Informar o Nome Fantasia';
            $status = false;
        }

        if (empty($input['cnpj_cpf'])) {
            $this->msg[] = 'Favor Informar o CNPJ/CPF';
            $status = false;
        }

        if (empty($input['insc_estadual'])) {
            $this->msg[] = 'Favor Informar a Inscrição Estadual';
            $status = false;
        }

        if (empty($input['insc_municipal'])) {
            $this->msg[] = 'Favor Informar a Inscrição Municipal';
            $status = false;
        }

        if (empty($input['cep'])) {
            $this->msg[] = 'Favor Informar o CEP';
            $status = false;
        }

        if (empty($input['email'])) {
            $this->msg[] = 'Favor Informar o Email';
            $status = false;
        }

        if (!$status) {
            return false;
        }

        return true;
    }

    public function listar()
    {
        $table = Fornecedor::where('empresaid', session()->get('seid'))->get();
        
        return view('fornecedores.listar')->with('table', $table);
    }

    public function editar($id, Request $request)
    {
        $input = $request->all();

        $query = "SELECT nome, codigo FROM agenda.municipios";
        $municipios = DB::select($query);

        $fornecedor = Fornecedor::findOrFail($id);
        if (!empty($input)) {
            if (!$this->validation($input, true)) {
                $success = false;

                return view('fornecedores.editar', compact('municipios','success', 'fornecedor'))->with('msg', $this->msg);
            }

            $fornecedor->fill($input);
            $fornecedor->data_alteracao = date('Y-m-d H:i:s');
            $fornecedor->save();


            $success = true;
            $this->msg[] = 'Fornecedor atualizado com sucesso';

            return view('fornecedores.editar', compact('municipios', 'success', 'fornecedor'))->with('msg', $this->msg);
        }

        return view('fornecedores.editar', compact('municipios','success', 'fornecedor'));
    }

    public function destroy($id)
    { 
        if (!empty($id)) {
            $success = true;
            
            $fornecedor = Fornecedor::findOrFail($id);

            Fornecedor::destroy($id);
            $table = Fornecedor::all();

            return view('fornecedores.listar', compact('table', 'success'))->with('msg', 'Fornecedor excluído com sucesso.');
        }
    }
}
