<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Models\Usuarios;
use App\Models\OrdemCompra;
use Auth;
use DB;

class OrdemCompraController extends Controller
{
	public $msg = array();

    public function findOrdem($ordemcompra, $estabid = false)
    {
        $ordem_compra = OrdemCompra::where('ordemcompra', $ordemcompra)->where('estabid', $estabid)->first();
        
        if (!empty($ordem_compra)) {
            $value_ordem = 'callbackOrdemCompra("existente")';
            return $value_ordem;
        }else{
           $value_ordem = 'callbackOrdemCompra("nao_existente")'; 
           return $value_ordem;
        }
    }

    public function find($cnpj)
    {
        $sql = "SELECT A.id, A.cnpj, A.razao_social, A.cod_municipio from agenda.estabelecimentos A INNER JOIN agenda.empresas B on B.id = A.empresa_id WHERE B.id = '".session()->get('seid')."' AND A.cnpj = '".$cnpj."'";

        $fornecedor = DB::select($sql);

        if (empty($fornecedor)) {
            $array['id'] = 0;
            $dados = 'callbackAgenda('.json_encode($array).')';
            $dados = str_replace('[', '', $dados);
            $dados = str_replace(']', '', $dados);
            return $dados;
        }

        $array['id'] = $fornecedor[0]->id;
        $array['cnpj_cpf'] = $this->maskCNPJ($fornecedor[0]->cnpj);
        $array['razao_social'] = $fornecedor[0]->razao_social;
        $array['municipio_agenda'] = $this->loadMunicipio($fornecedor[0]->cod_municipio, 'municipio');
        $array['uf_agenda'] = $this->loadMunicipio($fornecedor[0]->cod_municipio, 'uf');
        $dados = 'callbackAgenda('.json_encode($array).')';
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

    public function create(Request $request)
    {
        $table = OrdemCompra::where('empresaid', session()->get('seid'))->get();
        $fornecedores = Fornecedor::where('empresaid', session()->get('seid'))->orderby('nome_fantasia', 'asc')->get();
        $query = "SELECT nome, codigo FROM agenda.municipios";
        $municipios = DB::select($query);
        
        if (!empty($request->all())) {
            if (!$this->validation($request->all())) {
                $success = false;
                return view('ordem_compra.index', compact('fornecedores', 'success', 'table'))->with('msg', $this->msg);
            }            

            $input = $request->all();
            $input['empresaid'] = session()->get('seid');
     
            if ($input['id']) {
                $ordemcompra = OrdemCompra::findOrFail($input['id']);
                $ordemcompra->fill($input);
                $ordemcompra->save();
                $table = OrdemCompra::where('empresaid', session()->get('seid'))->get();

                $success = true;
                $this->msg[] = 'Ordem de compra editada com sucesso';
                return view('ordem_compra.index', compact('fornecedores', 'success', 'table'))->with('msg', $this->msg);
            }

            OrdemCompra::create($input);
            $table = OrdemCompra::where('empresaid', session()->get('seid'))->get();
            
            $success = true;
            $this->msg[] = 'Ordem de compra cadastrada com sucesso';
            return view('ordem_compra.index', compact('fornecedores', 'success', 'table'))->with('msg', $this->msg);
        }
        return view('ordem_compra.index', compact('table', 'fornecedores'));
    }

    private function validation($input)
    {
        $status = true;

        if (empty($input['ordemcompra'])) {
            $this->msg[] = 'Favor Informar o Número da Ordem de Compra';
            $status = false;
        }

        if (empty($input['estabid'])) {
            $this->msg[] = 'Favor Informar o CNPJ de um estabelecimento existente';
            $status = false;
        }

        if (empty($input['fornecedorid'])) {
            $this->msg[] = 'Favor Selecionar o Fornecedor';
            $status = false;
        }

        if ($status) {
            $ordem_compra = OrdemCompra::Where('ordemcompra', $input['ordemcompra'])->where('fornecedorid', $input['fornecedorid']);
            if ($input['id']) {
                $ordem_compra = $ordem_compra->where('id', '<>', $input['id']); 
            }
            $ordem_compra = $ordem_compra->first();

            if (!empty($ordem_compra)) {
                $this->msg[] = 'Ordem de Compra Já Cadastrada';
                $status = false;
            }   
        }

        if (!$status) {
            return false;
        }

        return true;
    }

    public function destroy($id)
    { 
        $success = true;
        if (!empty($id)) {
            OrdemCompra::destroy($id);
        }
        $this->msg[] = 'Ordem de Compra excluída com sucesso.';
        $table = OrdemCompra::where('empresaid', session()->get('seid'))->get();
        $fornecedores = Fornecedor::where('empresaid', session()->get('seid'))->get();
        return view('ordem_compra.index', compact('table', 'success', 'fornecedores'))->with('msg', $this->msg);
    }
}
