@extends('adminlte::page')

@section('title', 'Empresas')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('companies.create') }}" class="btn btn-success">Novo</a>
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
                      <th>Logo</th>
                      <th>NIF</th>
                      <th>cambio</th>
                      <th>Cidade</th>
                      <th>Endereco</th>
                      <th>Telefolne</th>
                      <th>Celular</th>
                      <th>Cadastro</th>
                      <th>#</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach($empresas as $empresa)

                      <tr>
                          <td>{{ $empresa->nome }}</td>
                          <td>{{ $empresa->email }}</td>
                          <td>{{ $empresa->logo }}</td>
                          <td>{{ $empresa->nif }}</td>
                          <td>{{ $empresa->cambio }}</td>
                          <td>{{ $empresa->cidade }}</td>
                          <td>{{ $empresa->endereco }}</td>
                          <td>{{ $empresa->telefone }}</td>
                          <td>{{ $empresa->celular }}</td>
                          <td>{{ $empresa->created_at }}</td>
                          <td>
                              <a href="{{ route('companies.edit', $empresa->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                              <a href="{{ route('users.index', ['empresa'=>$empresa->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-users"></i></a>
                          </td>

                      </tr>
                    @endforeach

                    {{ $empresas->links() }}

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
