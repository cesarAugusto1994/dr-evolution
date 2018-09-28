@extends('adminlte::page')

@section('title', 'Configurações')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('configs.create') }}" class="btn btn-success">Novo</a>
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
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Ativo</th>
                      <th>#</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach($configs as $config)

                      <tr>
                          <td>{{ $config->nome }}</td>
                          <td>{{ $config->descricao }}</td>
                          <td>{{ $config->valor }}</td>
                          <td>{{ $config->ativo ? 'Ativo' : 'Inativo' }}</td>
                          <td>
                              <a href="{{ route('configs.edit', $config->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                          </td>
                      </tr>
                    @endforeach

                    {{ $configs->links() }}

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
