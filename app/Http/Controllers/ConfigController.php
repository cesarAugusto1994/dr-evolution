<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Okipa\LaravelBootstrapTableList\TableList;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $table = app(TableList::class)
         ->setModel(Config::class)
         ->setRoutes([
             'index'      => ['alias' => 'configs.index', 'parameters' => []],
             'edit'       => ['alias' => 'configs.edit', 'parameters' => []],
         ]);

      $table->addColumn('nome')
       ->setTitle('Nome')
       ->isSortable()
       ->isSearchable()
       ->useForDestroyConfirmation();

       $table->addColumn('slug')
        ->setTitle('Slug')
        ->isSearchable()
        ->useForDestroyConfirmation();

      $table->addColumn('descricao')
       ->setTitle('Descrição')
       ->isSearchable()
       ->useForDestroyConfirmation();

       $table->addColumn('valor')
        ->setTitle('Valor')
        ->useForDestroyConfirmation();

      $table->addColumn('ativo')
       ->setTitle('Ativo')
       ->isCustomValue(function ($entity, $column) {
          return $entity->ativo ? 'Ativo' : 'Inativo';
       });

      return view('admin.configs.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.configs.create');
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
          'nome' => 'required|string|max:255|unique:configs',
      ]);

      if($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }

      if($data['tipo_id'] == 2) {
            $data['valor'] = !empty($data['valor']) ? (boolean)$data['valor'] : false;
      } elseif($data['tipo_id'] == 3) {
          if ($request->hasFile('valor') && $request->file('valor')->isValid()) {
              $data['valor'] = $request->valor->store('configs');
          }
      }

      $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

      $data['slug'] = str_slug($data['nome']);

      $config = Config::create($data);

      flash('A Configuração foi adicionada com sucesso!')->success()->important();

      return redirect()->route('configs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = Config::findOrFail($id);

        return view('admin.configs.edit', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $config = Config::findOrFail($id);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:255|unique:configs,nome,'.$config->id,
        ]);

        if($validator->fails()) {
          return back()->withErrors($validator)->withInput();
        }

        if($config->tipo->id == 2) {
              $data['valor'] = !empty($data['valor']) ? (boolean)$data['valor'] : false;
        } elseif($config->tipo->id == 3) {
            if ($request->hasFile('valor') && $request->file('valor')->isValid()) {
                $data['valor'] = $request->valor->store('configs');
            }
        }

        $data['ativo'] = !empty($data['ativo']) ? (boolean)$data['ativo'] : false;

        $data['slug'] = str_slug($data['nome']);

        $config->update($data);

        flash('A Configuração foi atualizada com sucesso!')->success()->important();

        return redirect()->route('configs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
