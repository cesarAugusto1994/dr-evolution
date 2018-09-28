@extends('adminlte::page')

@section('title', 'Empresa >> Usuários')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('users.create') }}" class="btn btn-success">Novo</a>
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
                      <th>#</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Empresa</th>
                      <th>Provilégios</th>
                      <th>Ativo</th>
                      <th>Cadastro</th>
                      <th>Opções</th>
                  </tr>
                  </thead>

                  <tbody>
                    @forelse($users as $user)
                      <tr>
                        <td># {{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->empresa->nome }}</td>
                        <td>{{ $user->roles->first()->name ?? '' }}</td>
                        <td><span class="badge {{ $user->ativo ? 'bg-teal' : 'bg-red' }} ">{{ $user->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-danger btn-sm btnRemoveItem" data-route="{{ route('users.destroy', $user->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="11" class="text-center">Nenhum Usuário cadastrardo até o momento!</td>
                      </tr>
                    @endforelse

                    {{ $users->links() }}

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
