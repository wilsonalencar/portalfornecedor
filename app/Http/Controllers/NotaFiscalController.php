<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Models\Usuarios;
use App\Models\OrdemCompra;
use App\Models\NotaFiscal;
use App\Models\ItemNotaFiscal;
use Auth;
use DB;
use Redirect;

class NotaFiscalController extends Controller
{
    public $msg = array();

    public function find($cnpj)
    {
        $cnpj = $this->numero($cnpj);
        $sql = "SELECT A.id, A.razao_social, A.endereco, A.num_endereco, A.cod_municipio, A.insc_municipal, B.nome, B.uf FROM ".env('DB_DATABASE1').".estabelecimentos A LEFT JOIN ".env('DB_DATABASE1').".municipios B ON A.cod_municipio = B.codigo  WHERE A.cnpj = '".$cnpj."'";

        $fornecedor = DB::select($sql); 

        $array = array();

        if (empty($fornecedor)) {
            $array['id'] = 0;
            $dados = 'callbackAgenda('.json_encode($array).')';
            $dados = str_replace('[', '', $dados);
            $dados = str_replace(']', '', $dados);
            return $dados;
        }

        $dados = 'callbackAgenda('.json_encode($fornecedor).')';
        $dados = str_replace('[', '', $dados);
        $dados = str_replace(']', '', $dados);
        return $dados;
    }

    public function store(Request $request)
    {
        if (!empty($request->all())) {
            if (!$this->validation($request->all())) {

                $nota_fiscal = new NotaFiscal;
                $next = $nota_fiscal->getNextNota();
                $nextSerie = $nota_fiscal->getNextSerie();

                $fornecedor = Fornecedor::where('empresaid', session()->get('seid'))->where('id', Auth::user()->id_fornecedor)->get()->first();

                $query = "SELECT nome, uf FROM ".env('DB_DATABASE1').".municipios WHERE municipios.codigo = '".$fornecedor->cod_municipio."'";
                $municipios = DB::select($query);

                if (!empty($municipios)) {
                    $municipios = $municipios[0];
                }

                $success = false;

                return view('nota_fiscal.create', compact('fornecedor', 'municipios', 'next', 'nextSerie', 'success'))->with('msg', $this->msg);
            }   
            
            $input = $request->all();
            $cnpj = str_replace('/', '', $input['cnpj_cpf']);
            $cnpj = str_replace('.', '', $cnpj);
            $cnpj = str_replace('-', '', $cnpj);


            $ordemcompra = OrdemCompra::where('ordemcompra', $input['ordemcompra'])->get();

            $sql = "SELECT A.id FROM ".env('DB_DATABASE1').".estabelecimentos A WHERE A.cnpj = '".$cnpj."'";
            $estabelecimento = DB::select($sql); 

            $input['estabid'] = $estabelecimento[0]->id;
            $input['empresaid'] = session()->get('seid');
            $input['ordemcompraid'] = $ordemcompra[0]->id;   


            $notafiscal = NotaFiscal::create($input);
            $this->saveItemNota($input, $notafiscal->id);

            if (Auth::user()->id_perfilusuario == 4) {

                $nota_fiscal = new NotaFiscal;
                $next = $nota_fiscal->getNextNota();
                $nextSerie = $nota_fiscal->getNextSerie();

                $fornecedor = Fornecedor::where('empresaid', session()->get('seid'))->where('id', Auth::user()->id_fornecedor)->get()->first();

                $query = "SELECT nome, uf FROM ".env('DB_DATABASE1').".municipios WHERE municipios.codigo = '".$fornecedor->cod_municipio."'";
                $municipios = DB::select($query);

                if (!empty($municipios)) {
                    $municipios = $municipios[0];
                }

                $success = true;
                $this->msg[] = 'Nota fiscal cadastrada com sucesso';

                return view('nota_fiscal.create', compact('fornecedor', 'municipios', 'next', 'nextSerie', 'success'))->with('msg', $this->msg);
            }

            $success = true;
            $this->msg[] = 'Nota fiscal cadastrada com sucesso';

            return view('nota_fiscal.show', compact('success'))->with('msg', $this->msg);
        }
        
        return Redirect::action('NotaFiscalController@create');
    }

    public function saveItemNota($dados, $id, $edit = false)
    {
        $item_nota = new ItemNotaFiscal;

        $servicos = $dados['servicos'];
        if ($edit) {
            ItemNotaFiscal::where('notafiscal_id', '=', $id)->delete();
        }

        $item_nota = array();
        foreach ($servicos as $key => $item) {
            $item_nota['alq_irrf'] = 0.015;
            $item_nota['valor_unitario_item'] = $item['valor_unitario_item'];
            $item_nota['valor_total_item'] = $item['valor_total_item'];
            $item_nota['vlr_irrf'] = $item_nota['valor_unitario_item'] * $item_nota['alq_irrf'];
            $item_nota['notafiscal_id'] = $id;
            $item_nota['quantidade'] = $item['quantidade'];
            $item_nota['unidade'] = $item['unidade'];
            $item_nota['descricao'] = $item['descricao'];
            $item_nota['alq_iss'] = 0.02;
            $item_nota['vlr_iss'] = $item_nota['valor_unitario_item'] * $item_nota['alq_iss'];

            $item_nota['vlr_outros'] = 0;

            ItemNotaFiscal::create($item_nota);
        }

        return true;

    }

    public function create(Request $request)
    {
        if (Auth::user()->id_perfilusuario == 4) {

            $nota_fiscal = new NotaFiscal;
            $next = $nota_fiscal->getNextNota();
            $nextSerie = $nota_fiscal->getNextSerie();

            $fornecedor = Fornecedor::where('empresaid', session()->get('seid'))->where('id', Auth::user()->id_fornecedor)->get()->first();

            $query = "SELECT nome, uf FROM ".env('DB_DATABASE1').".municipios WHERE municipios.codigo = '".$fornecedor->cod_municipio."'";
            $municipios = DB::select($query);

            if (!empty($municipios)) {
                $municipios = $municipios[0];
            }

            return view('nota_fiscal.create', compact('fornecedor', 'municipios', 'next', 'nextSerie'));
        }

        if (!empty($request->all())) {

            $nota_fiscal = new NotaFiscal;
            $next = $nota_fiscal->getNextNota();
            $nextSerie = $nota_fiscal->getNextSerie();

            $cnpj_cpf = $this->numero($request->input('cnpj_cpf'));

            $fornecedor = Fornecedor::where('cnpj_cpf', $cnpj_cpf)->where('empresaid', session()->get('seid'))->first();

            if (empty($fornecedor)) {
                $success = false;
                $this->msg[] = 'Fornecedor Inexistente';
                return view('nota_fiscal.show', compact('success'))->with('msg', $this->msg);
            }
            $query = "SELECT nome, uf FROM ".env('DB_DATABASE1').".municipios WHERE municipios.codigo = '".$fornecedor->cod_municipio."'";
            $municipios = DB::select($query);
            if (!empty($municipios)) {
                $municipios = $municipios[0];
            }

            return view('nota_fiscal.create', compact('fornecedor', 'municipios', 'next', 'nextSerie'))->with('msg', $this->msg);
        }

        return view('nota_fiscal.show');
    }

    private function validation($input)
    {
        $status = true;
        if (!$edit) {
            if (!empty($input['nota_fiscal'])) {
                $notafiscal = NotaFiscal::Where('nota_fiscal', $input['nota_fiscal'])->where('serie', $input['serie'])->first();
            }
            if (!empty($notafiscal)) {
                $this->msg[] = 'Nota Fiscal Já Cadastrada';
                $status = false;
            }   
        }

        if ($status) {
            return true;        
        }

        return false;        
    }

    public function numero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    public function listar()
    {
        $table = NotaFiscal::where('empresaid', session()->get('seid'))->get();

        return view('nota_fiscal.listar')->with('table', $table);
    }

    public function repositorio()
    {
        $table = NotaFiscal::where('empresaid', session()->get('seid'));

        if (Auth::user()->id_perfilusuario == 4) {
            $table = $table->where('fornecedorid', Auth::user()->id_fornecedor);
        }
        
        $table = $table->get();

        return view('nota_fiscal.repositorio')->with('table', $table);
    }

    public function show($id)
    {
        $table = NotaFiscal::findOrFail($id);
        return view('nota_fiscal.repositorio_show')->with('notafiscal', $table);
    }

    public function editar($id, Request $request)
    {
        $notafiscal = NotaFiscal::findOrFail($id);

        $fornecedor = Fornecedor::where('id', $notafiscal->fornecedorid)->where('id', Auth::user()->id_fornecedor)->get()->first();

        $query = "SELECT nome, uf FROM ".env('DB_DATABASE1').".municipios WHERE municipios.codigo = '".$fornecedor->cod_municipio."'";
        
        $municipios = DB::select($query);

        if (!empty($municipios)) {
            $municipios = $municipios[0];
        }

        if (!empty($request->all())) {
            
            $input = $request->all();
            $cnpj = str_replace('/', '', $input['cnpj_cpf']);
            $cnpj = str_replace('.', '', $cnpj);
            $cnpj = str_replace('-', '', $cnpj);

            $ordemcompra = OrdemCompra::where('ordemcompra', $input['ordemcompra'])->get();

            $sql = "SELECT A.id FROM ".env('DB_DATABASE1').".estabelecimentos A WHERE A.cnpj = '".$cnpj."'";
            $estabelecimento = DB::select($sql); 

            $input['estabid'] = $estabelecimento[0]->id;
            $input['empresaid'] = session()->get('seid');
            $input['ordemcompraid'] = $ordemcompra[0]->id; 

            $notafiscal->fill($input);
            $notafiscal->save();

            $this->saveItemNota($input, $notafiscal->id, true);

            $success = true;
            $this->msg[] = 'Nota Fiscal atualizada com sucesso';

        }

        return view('nota_fiscal.editar', compact('success','fornecedor', 'municipios', 'notafiscal'))->with('msg', $this->msg);
    }

    public function destroy($id)
    { 
        if (!empty($id)) {
            $success = true;

            $notafiscal = NotaFiscal::where('id', $id)->first();

            if (!empty($notafiscal)) {

                ItemNotaFiscal::where('notafiscal_id', '=', $notafiscal->id)->delete();

                NotaFiscal::destroy($notafiscal->id);
            
            }

            $table = NotaFiscal::all();

            return view('nota_fiscal.listar', compact('table', 'success'))->with('msg', 'Nota Fiscal excluída com sucesso.');
        }
    }
}
