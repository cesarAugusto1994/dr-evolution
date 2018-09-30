@extends('adminlte::page')

@section('title', 'Fornecedores')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('vendors.create') }}" class="btn btn-success">Novo</a>
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
                      <th>Avatar</th>
                      <th>Email</th>
                      <th>Endereço</th>
                      <th>Celular</th>
                      <th>Telefone</th>
                      <th style="width:150px">#</th>
                  </tr>
                  </thead>

                  <tbody>
                    @forelse($fornecedores as $fornecedor)
                      <tr>
                        <td>{{ $fornecedor->nome }}</td>
                        <td><img style="width:42px" alt="" src="{{ route('image', ['link'=>$fornecedor->avatar]) }}"/></td>
                        <td>{{ $fornecedor->email }}</td>
                        <td>{{ $fornecedor->endereco }}</td>
                        <td>{{ $fornecedor->celular }}</td>
                        <td>{{ $fornecedor->telefone }}</td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('vendors.edit', $fornecedor->id) }}"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-danger btn-sm btnRemoveItem" data-route="{{ route('vendors.destroy', $fornecedor->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="11" class="text-center">Nenhum valor cadastrardo até o momento!</td>
                      </tr>
                    @endforelse

                    {{ $fornecedores->links() }}

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
