<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto\Grupo;
use Okipa\LaravelBootstrapTableList\TableList;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $table = app(TableList::class)
           ->setModel(Grupo::class)
           ->setRoutes([
               'index'      => ['alias' => 'groups.index', 'parameters' => []],
               'edit'       => ['alias' => 'groups.edit', 'parameters' => []],
               'destroy'    => ['alias' => 'groups.destroy', 'parameters' => []],
           ])
           ->addQueryInstructions(function ($query) {
                $query->select('grupos.*')
                    ->where('grupos.empresa_id', \Auth::user()->empresa_id);
            });
         // we add some columns to the table list
         $table->addColumn('nome')
           ->setTitle('Nome')
           ->isSortable()
           ->isSearchable()
           ->useForDestroyConfirmation();

        return view('user.grupos.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.grupos.create');
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

        $user = \Auth::user();

        $data['user_id']=$user->id;
        $data['empresa_id'] = $user->empresa_id;

        Grupo::create($data);

        return redirect()->route('groups.index');
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
        $user = \Auth::user();
        $grupo = Grupo::findOrFail($id);
        return view('user.grupos.edit', compact('grupo'));
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
        $grupo = Grupo::findOrFail($id);
        $grupo->update($data);

        return redirect()->route('groups.index');
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
            $registro = Grupo::findOrFail($id);
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
