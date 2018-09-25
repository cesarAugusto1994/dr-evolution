<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Okipa\LaravelBootstrapTableList\TableList;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Extra;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $table = app(TableList::class)
           ->setModel(Extra::class)
           ->setRoutes([
               'index'      => ['alias' => 'extras.index', 'parameters' => []],
               'edit'       => ['alias' => 'extras.edit', 'parameters' => []],
               'destroy'    => ['alias' => 'extras.destroy', 'parameters' => []],
           ])
           ->addQueryInstructions(function ($query) {
                $query->select('extras.*')
                    ->where('extras.empresa_id', \Auth::user()->empresa_id);
            });
         // we add some columns to the table list
         $table->addColumn('nome')
           ->setTitle('Nome')
           ->isSortable()
           ->isSearchable()
           ->useForDestroyConfirmation();

        return view('user.extras.index', compact('table'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.extras.create');
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

        $data['empresa_id'] = $user->empresa_id;

        Extra::create($data);

        return redirect()->route('extras.index');
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
        $extra = Extra::findOrFail($id);
        return view('user.extras.edit', compact('extra'));
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
        $extra = Extra::findOrFail($id);
        $extra->update($data);

        return redirect()->route('extras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Extra::findOrFail($id);
        $registro->delete();

        flash('Removido com sucesso!')->success()->important();

        return redirect()->route('extras.index');
    }
}
