<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Okipa\LaravelBootstrapTableList\TableList;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Cliente;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = app(TableList::class)
           ->setModel(Cliente::class)
           ->setRoutes([
               'index'      => ['alias' => 'clients.index', 'parameters' => []],
               'edit'       => ['alias' => 'clients.edit', 'parameters' => []],
               'destroy'    => ['alias' => 'clients.destroy', 'parameters' => []],
           ])
           ->addQueryInstructions(function ($query) {

              $user = \Auth::user();

              $query->select('clientes.*')
                  ->where('clientes.empresa_id', $user->empresa_id);
          });
         // we add some columns to the table list
         $table->addColumn('nome')
           ->setTitle('Nome')
           ->isSortable()
           ->isSearchable()
           ->useForDestroyConfirmation();
         $table->addColumn('email')
           ->setTitle('Email')
           ->isSortable()
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

        return view('user.clientes.index', compact('clientes','table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.clientes.create');
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
            'nome' => 'required|string|max:255|unique:clientes',
            'email' => 'required|string|email|max:255|unique:clientes',
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $data['avatar'] = $request->avatar->store('avatar');
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $data['empresa_id'] = \Auth::user()->empresa_id;

        $data['limite_divida'] = floatval($data['limite_divida']);

        Cliente::create($data);

        flash('Cliente adicionado com sucesso!')->success()->important();

        return redirect()->route('clients.index');
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
        $cliente = Cliente::findOrFail($id);
        return view('user.clientes.edit', compact('cliente'));
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

        $cliente = Cliente::uuid($id);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255|unique:clientes,nome,'.$cliente->id,
            'email' => 'required|string|email|max:255|unique:clientes,email,'.$cliente->id,
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $data['avatar'] = $request->avatar->path();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $data['limite_divida'] = floatval($data['limite_divida']);

        $cliente->update($data);

        flash('Os dados do cliente foram atualizados com sucesso!')->success()->important();

        if($request->has('return')) {
          return redirect($request->get('return'));
        }

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Cliente::findOrFail($id);
        $registro->delete();

        flash('Removido com sucesso!')->success()->important();

        return redirect()->route('clients.index');
    }
}
