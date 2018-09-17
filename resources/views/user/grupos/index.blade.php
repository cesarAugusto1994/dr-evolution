@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1>Grupos</h1>
@stop

@section('content')

    <div class="row">

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Opções</h3>
          </div>
          <div class="box-body">

              <a href="{{ route('groups.create') }}" class="btn btn-sm btn-success"><i class="fa fa-add"></i> Adicionar Grupo</a>

          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Listagem</h3>
            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Cadastro</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                @forelse($grupos as $grupo)
                  <tr>
                    <td>{{ $grupo->id }}</td>
                    <td>{{ $grupo->nome }}</td>
                    <td>{{ $grupo->created_at }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('groups.edit', $grupo->id) }}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btnRemoveItem" data-route="{{ route('groups.destroy', $grupo->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="13" class="text-center">Nenhuma Empresa cadastrarda até o momento!</td>
                  </tr>
                @endforelse
              </tbody>
          </table>
          </div>
          <div class="box-footer clearfix">
            {{ $grupos->links() }}
          </div>
        </div>

      </div>

    </div>

@stop
