@extends('adminlte::page')

@section('title', 'Funcionários')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('employees.create') }}" class="btn btn-success">Novo</a>
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
                    @forelse($funcionarios as $funcionario)
                      <tr>
                        <td>{{ $funcionario->nome }}</td>
                        <td><img style="width:42px" alt="" src="{{ route('image', ['link'=>$funcionario->avatar]) }}"/></td>
                        <td>{{ $funcionario->email }}</td>
                        <td>{{ $funcionario->endereco }}</td>
                        <td>{{ $funcionario->celular }}</td>
                        <td>{{ $funcionario->telefone }}</td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('employees.edit', $funcionario->id) }}"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-danger btn-sm btnRemoveItem" data-route="{{ route('employees.destroy', $funcionario->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="11" class="text-center">Nenhum valor cadastrardo até o momento!</td>
                      </tr>
                    @endforelse

                    {{ $funcionarios->links() }}

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
