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
        $user = \Auth::user();
        $extras = Extra::where('empresa_id', $user->empresa_id)->paginate();

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

        return view('user.extras.index', compact('extras', 'table'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
