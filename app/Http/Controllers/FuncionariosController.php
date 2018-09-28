<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;
use Okipa\LaravelBootstrapTableList\TableList;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        $funcionarios = Funcionario::where('empresa_id', $user->empresa_id)->paginate();

        return view('user.funcionarios.index', compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.funcionarios.create');
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
            'nome' => 'required|string|max:255|unique:funcionarios',
            'email' => 'required|string|email|max:255|unique:funcionarios',
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

        if($request->has('nascimento') && !empty($request->get('nascimento'))) {
          $nascimento = \DateTime::createFromFormat('d/m/Y', $request->get('nascimento'));
          $data['nascimento'] = $nascimento;
        }

        $data['comissao'] = floatval($data['comissao']);

        Funcionario::create($data);

        flash('Funcionário adicionado com sucesso!')->success()->important();

        return redirect()->route('employees.index');
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
        $funcionario = Funcionario::findOrFail($id);
        return view('user.funcionarios.edit', compact('funcionario'));
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

        $funcionario = Funcionario::uuid($id);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255|unique:clientes,nome,'.$funcionario->id,
            'email' => 'required|string|email|max:255|unique:clientes,email,'.$funcionario->id,
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $data['avatar'] = $request->avatar->path();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        if($request->has('nascimento') && !empty($request->get('nascimento'))) {
          $nascimento = \DateTime::createFromFormat('d/m/Y', $request->get('nascimento'));
          $data['nascimento'] = $nascimento;
        }

        $data['comissao'] = floatval($data['comissao']);

        $funcionario->update($data);

        flash('Os dados do funcionário foram atualizados com sucesso!')->success()->important();

        if($request->has('return')) {
          return redirect($request->get('return'));
        }

        return redirect()->route('funcionarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Funcionario::findOrFail($id);
        $registro->delete();

        flash('Removido com sucesso!')->success()->important();

        return redirect()->route('employees.index');
    }
}
