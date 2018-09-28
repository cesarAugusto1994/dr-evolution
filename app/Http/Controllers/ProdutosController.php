<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produto,Fornecedor,Extra};
use App\Models\Produto\{Imagem,Precificacao};
use Illuminate\Support\Facades\Validator;
use Okipa\LaravelBootstrapTableList\TableList;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $produtos = Produto::where('empresa_id',$user->empresa_id)->paginate();

        return view('user.produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255|unique:produtos',
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $data['user_id'] = \Auth::user()->id;
        $data['empresa_id'] = \Auth::user()->empresa_id;

        $produto = Produto::create($data);

        $data['custo'] = str_replace([',','.'],['',''],$data['custo']);

        if(empty($data['custo'])) {
          $data['custo'] = 0.00;
        }

        $data['despesas'] = str_replace([',','.'],['',''],$data['despesas']);

        if(empty($data['despesas'])) {
          $data['despesas'] = 0.00;
        }

        $valorFinal = array_sum([$data['custo'],$data['despesas']]);

        $precificacao = [
          'custo' => $data['custo']/100,
          'despesas' => $data['despesas']/100,
          'outras_despesas' => 0,
          'custo_final' => $valorFinal/100,
          'produto_id' => $produto->id,
        ];

        Precificacao::create($precificacao);

        if($request->hasfile('imagens'))
        {
            foreach($request->file('imagens') as $image)
            {
                $name=$image->getClientOriginalName();

                $path = $image->store('produtos');

                Imagem::create([
                  'produto_id' => $produto->id,
                  'link' => $path,
                  'descricao' => $name
                ]);
            }
        }

        if($request->has('fornecedores')) {

          foreach ($data['fornecedores'] as $key => $item) {
              $fornecedor = Fornecedor::findOrFail($item);

              \App\Models\Produto\Fornecedor::create([
                'fornecedor_id' => $fornecedor->id,
                'produto_id' => $produto->id
              ]);
          }

        }

        flash('Produto adicionado com sucesso!')->success()->important();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('user.produtos.edit',compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $user = \Auth::user();

        $produto = Produto::findOrFail($id);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255|unique:produtos,nome,'.$produto->id,
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $produto->update($data);

        $extras = Extra::where('empresa_id',$user->empresa_id)->get();

        foreach ($extras as $key => $item) {

            if(isset($data[strtolower($item->nome)])) {

              $extra = \App\Models\Produto\Extra::where('extra_id',$item->id)->get();

              if($extra->isNotEmpty()) {

                  $extra = $extra->first();

                  $extra->update([
                      'valor' => $data[strtolower($item->nome)],
                      'extra_id' => $item->id,
                      'produto_id' => $produto->id
                  ]);

              } else {

                \App\Models\Produto\Extra::create([
                    'valor' => $data[strtolower($item->nome)],
                    'extra_id' => $item->id,
                    'produto_id' => $produto->id
                ]);

              }

            }

        }

        $data['custo'] = str_replace([',','.'],['',''],$data['custo']);

        if(empty($data['custo'])) {
          $data['custo'] = 0.00;
        }

        $data['despesas'] = str_replace([',','.'],['',''],$data['despesas']);

        if(empty($data['despesas'])) {
          $data['despesas'] = 0.00;
        }

        $valorFinal = array_sum([$data['custo'],$data['despesas']]);

        $despesas = Precificacao::where('produto_id', $produto->id)->get();

        $precificacao = [
          'custo' => $data['custo']/100,
          'despesas' => $data['despesas']/100,
          'outras_despesas' => 0,
          'custo_final' => $valorFinal/100,
          'produto_id' => $produto->id,
        ];

        if($despesas->isEmpty()) {

          Precificacao::create($precificacao);

        } else {

          $produto->precificacao->update($precificacao);

        }

        if($request->hasfile('imagens'))
        {
            foreach($request->file('imagens') as $image)
            {
                $name = $image->getClientOriginalName();

                $path = $image->store('produtos');

                Imagem::create([
                  'produto_id' => $produto->id,
                  'link' => $path,
                  'descricao' => $name
                ]);
            }
        }

        if($request->has('fornecedores')) {

          foreach ($data['fornecedores'] as $key => $item) {
              $fornecedor = Fornecedor::findOrFail($item);

              \App\Models\Produto\Fornecedor::create([
                'fornecedor_id' => $fornecedor->id,
                'produto_id' => $produto->id
              ]);
          }

        }

        flash('Produto adicionado com sucesso!')->success()->important();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Produto::findOrFail($id);
        $registro->delete();

        flash('Removido com sucesso!')->success()->important();

        return redirect()->route('products.index');
    }

    public function fornecedorRemove($id)
    {
        $fornecedor = \App\Models\Produto\Fornecedor::findOrFail($id);
        $fornecedor->delete();

        flash('Fornecedor removido com sucesso!')->success()->important();

        return redirect()->back();
    }

    public function imagemRemove($id)
    {
        $imagem = \App\Models\Produto\Imagem::findOrFail($id);
        $imagem->delete();

        return response()->json([
          'code' => 200,
          'message' => 'Imagem removida com sucesso.'
        ]);

        flash('Imagem removida com sucesso!')->success()->important();

        return redirect()->back();
    }
}
