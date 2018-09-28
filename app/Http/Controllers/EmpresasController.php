<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Okipa\LaravelBootstrapTableList\TableList;
use App\Models\Empresa;
use App\User;
use jeremykenedy\LaravelRoles\Models\Role;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::paginate();

        return view('admin.empresas.index', compact('table', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.empresas.create');
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
            'nome' => 'required|string|max:255|unique:empresas',
            'email' => 'required|string|email|max:255|unique:empresas',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $data['logo'] = $request->logo->store('images');
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $empresa = Empresa::create($data);

        $data['name'] = 'Admin '. $empresa->nome;
        $data['empresa_id'] = $empresa->id;
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        $userRole = Role::where('name', '=', 'User')->first();
        $user->attachRole($userRole);

        flash('Empresa adicionada com sucesso!')->success()->important();

        return redirect()->route('companies.index');
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
        $empresa = Empresa::findOrFail($id);
        return view('admin.empresas.edit', compact('empresa'));
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

        $empresa = Empresa::findOrFail($id);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255|unique:empresas,nome,'.$empresa->id,
            'email' => 'required|string|email|max:255|unique:empresas,email,'.$empresa->id,
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $data['logo'] = $request->logo->path();
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $empresa->update($data);

        flash('Os dados da Empresa foram atualizados com sucesso!')->success()->important();

        if($request->has('return')) {
          return redirect($request->get('return'));
        }

        return redirect()->route('companies.index');
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
            $registro = Empresa::findOrFail($id);
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

    public function configsEmpresa(Request $request)
    {
        $user = $request->user();

        $empresa = $user->empresa;

        return view('user.empresa.edit', compact('empresa'));
    }

}
