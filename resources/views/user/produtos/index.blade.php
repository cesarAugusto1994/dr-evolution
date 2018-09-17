@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')

    <div class="row">

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Opções</h3>
          </div>
          <div class="box-body">

              <a href="{{ route('products.create') }}" class="btn btn-sm btn-success"><i class="fa fa-add"></i> Adicionar Produto</a>

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
                  <th>Email</th>
                  <th>Tipo</th>
                  <th>Avatar</th>
                  <th>NIF</th>
                  <th>Cidade</th>
                  <th>Endereço</th>
                  <th>Telefone</th>
                  <th>Celular</th>
                  <th>Limite Dívida</th>
                  <th>Ativo</th>
                  <th>Cadastro</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                @forelse($produtos as $produto)
                  <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->email }}</td>
                    <td>{{ $produto->tipo->nome }}</td>
                    <td><img class="img" alt="" src="{{ route('logo', ['logo' => $produto->avatar]) }}"></td>
                    <td>{{ $produto->nif }}</td>
                    <td>{{ $produto->cidade }}</td>
                    <td>{{ $produto->endereco }}</td>
                    <td>{{ $produto->telefone }}</td>
                    <td>{{ $produto->celular }}</td>
                    <td>{{ number_format($produto->limite_divida*100, 2) }}</td>
                    <td><span class="badge {{ $produto->ativo ? 'bg-teal' : 'bg-red' }} ">{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                    <td>{{ $produto->created_at }}</td>
                    <td>

                      <a class="btn btn-primary" href="{{ route('clients.edit', $produto->uuid) }}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btnRemoveItem" data-route="{{ route('clients.destroy', $produto->id) }}"><i class="fa fa-trash"></i></a>
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
            {{ $produtos->links() }}
          </div>
        </div>

      </div>

    </div>

@stop
