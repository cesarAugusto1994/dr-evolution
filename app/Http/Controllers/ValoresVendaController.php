<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto\ValorVenda;
use Illuminate\Support\Facades\Validator;

class ValoresVendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valores = ValorVenda::paginate();

        return view('user.valores-venda.index', compact('valores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.valores-venda.create');
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
            'nome' => 'required|string|max:255|unique:valores_venda',
            'porcentagem' => 'required',
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;
        $data['porcentagem'] = floatval($data['porcentagem']);

        $user = \Auth::user();
        $data['empresa_id'] = $user->empresa_id;

        ValorVenda::create($data);

        flash('Valor de venda adicionado com sucesso!')->success()->important();

        return redirect()->route('values.index');
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
        $valor = ValorVenda::uuid($id);
        return view('user.valores-venda.edit', compact('valor'));
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

      $valor = ValorVenda::uuid($id);

      $validator = Validator::make($data, [
          'nome' => 'required|string|max:255|unique:valores_venda,nome,'.$valor->id,
          'porcentagem' => 'required',
      ]);

      if($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }

      $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;
      $data['porcentagem'] = floatval($data['porcentagem']);

      $valor->update($data);

      flash('Os dados do valor de venda foram atualizados com sucesso!')->success()->important();

      return redirect()->route('values.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $registro = ValorVenda::findOrFail($id);
            $registro->delete();

            return response()->json([
              'code' => 201,
              'message' => 'Removido com sucesso!'
            ]);

        } catch(Exception $e) {
            return response()->json([
              'code' => 501,
              'message' => $e->getMessage()
            ]);
        }
    }
}
