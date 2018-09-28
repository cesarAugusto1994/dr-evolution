@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('clients.create') }}" class="btn btn-success">Novo</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h6 class="m-t-0">Lista</h6>
            <div class="table-responsive">
              <table class="table table-hover mails m-0 table table-actions-bar">
                  <thead>
                  <tr>
                      <th>Nome</th>

                      <th>Email</th>
                      <th>Endereço</th>
                      <th>Celular</th>
                      <th>Telefone</th>

                      <th style="width:150px">#</th>
                  </tr>
                  </thead>

                  <tbody>
                    @forelse($clientes as $cliente)
                      <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->endereco }}</td>
                        <td>{{ $cliente->celular }}</td>
                        <td>{{ $cliente->telefone }}</td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('clients.edit', $cliente->id) }}"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-danger btn-sm btnRemoveItem" data-route="{{ route('clients.destroy', $cliente->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="11" class="text-center">Nenhum valor cadastrardo até o momento!</td>
                      </tr>
                    @endforelse

                    {{ $clientes->links() }}

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
