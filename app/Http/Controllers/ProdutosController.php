<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
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
        $table = app(TableList::class)
           ->setModel(Produto::class)
           ->setRoutes([
               'index'      => ['alias' => 'products.index', 'parameters' => []],
               'edit'       => ['alias' => 'products.edit', 'parameters' => []],
               'destroy'    => ['alias' => 'products.destroy', 'parameters' => []],
           ])
           ->addQueryInstructions(function ($query) {

              $user = \Auth::user();

              $query->select('produtos.*')
                  ->where('produtos.empresa_id', $user->empresa_id);
          });
         // we add some columns to the table list
         $table->addColumn('nome')
           ->setTitle('Nome')
           ->isSortable()
           ->isSearchable()
           ->useForDestroyConfirmation();


        return view('user.produtos.index', compact('table'));
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

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $data['avatar'] = $request->avatar->store('avatar');
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $data['user_id'] = \Auth::user()->id;
        $data['empresa_id'] = \Auth::user()->empresa_id;

        Produto::create($data);

        flash('Produto adicionado com sucesso!')->success()->important();

        return redirect()->route('products.index');
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
        $registro = Produto::findOrFail($id);
        $registro->delete();

        flash('Removido com sucesso!')->success()->important();

        return redirect()->route('extras.index');
    }
}
