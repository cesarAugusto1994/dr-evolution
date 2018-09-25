<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Validator;
use Okipa\LaravelBootstrapTableList\TableList;

class FornecedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = app(TableList::class)
           ->setModel(Fornecedor::class)
           ->setRoutes([
               'index'      => ['alias' => 'vendors.index', 'parameters' => []],
               'edit'       => ['alias' => 'vendors.edit', 'parameters' => []],
               'destroy'    => ['alias' => 'vendors.destroy', 'parameters' => []],
           ])
           ->addQueryInstructions(function ($query) {

              $user = \Auth::user();

              $query->select('fornecedores.*')
                  ->where('fornecedores.empresa_id', $user->empresa_id);
          });
         // we add some columns to the table list
         $table->addColumn('nome')
           ->setTitle('Nome')
           ->isSortable()
           ->isSearchable()
           ->useForDestroyConfirmation();
         $table->addColumn('email')
           ->setTitle('Email')
           ->isSearchable()
           ->useForDestroyConfirmation();
         $table->addColumn('endereco')
           ->setTitle('Endereço')
           ->isSearchable()
           ->useForDestroyConfirmation();
         $table->addColumn('celular')
           ->setTitle('Celular')
           ->isSearchable()
           ->useForDestroyConfirmation();
         $table->addColumn('telefone')
           ->setTitle('Telefone')
           ->isSearchable()
           ->useForDestroyConfirmation();;

        return view('user.fornecedores.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.fornecedores.create');
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
            'nome' => 'required|string|max:255|unique:fornecedores',
            'email' => 'required|string|email|max:255|unique:fornecedores',
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $data['avatar'] = $request->avatar->store('images');
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $user = \Auth::user();

        $data['empresa_id'] = $user->empresa_id;

        $data['limite_divida'] = floatval($data['limite_divida']);

        Fornecedor::create($data);

        flash('Fornecedor adicionado com sucesso!')->success()->important();

        return redirect()->route('vendors.index');
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
        $fornecedor = Fornecedor::findOrFail($id);
        return view('user.fornecedores.edit', compact('fornecedor'));
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

        $fornecedor = Fornecedor::uuid($id);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255|unique:fornecedores,nome,'.$fornecedor->id,
            'email' => 'required|string|email|max:255|unique:fornecedores,email,'.$fornecedor->id,
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $data['avatar'] = $request->avatar->path();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $data['limite_divida'] = floatval($data['limite_divida']);

        $fornecedor->update($data);

        flash('Os dados do fornecedor foram atualizados com sucesso!')->success()->important();

        if($request->has('return')) {
          return redirect($request->get('return'));
        }

        return redirect()->route('vendors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $registro = Fornecedor::findOrFail($id);
      $registro->delete();

      flash('Removido com sucesso!')->success()->important();

      return redirect()->route('vendors.index');
    }

    public function toAjax(Request $request)
    {
        $data = $request->request->all();

        $search = $data['search'];

        $user = \Auth::user();

        $empreendimentos = Fornecedor::where('nome', 'like', "%$search%")
        ->orWhere('id', $search)
        ->where('empresa_id', $user->empresa_id)->get();

        return $empreendimentos->toJson();
    }
}
