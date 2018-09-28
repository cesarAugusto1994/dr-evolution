@extends('adminlte::page')

@section('title', 'Produtos')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('products.create') }}" class="btn btn-success">Novo</a>
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
                      <th>Titulo</th>
                      <th>Código</th>
                      <th>Código de Barras</th>
                      <th>Grupo</th>
                      <th>Venda</th>
                      <th>Cadastro</th>
                      <th>#</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach($produtos as $produto)

                      <tr>
                          <td>
                              {{ $produto->nome }}
                          </td>

                          <td>
                              {{ $produto->codigo }}
                          </td>

                          <td>
                              <a href="#" class="text-muted">{{ $produto->codigo_barras }}</a>
                          </td>

                          <td>
                              {{ $produto->grupo->nome }}
                          </td>

                          <td>
                              <b><a class="text-dark"><b>{{ number_format($produto->precificacao->custo_final, 2, ',', '.') }}</b></a> </b>
                          </td>

                          <td>
                              {{ $produto->created_at }}
                          </td>

                          <td>
                              <a href="{{ route('products.edit', $produto->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                          </td>

                      </tr>
                    @endforeach

                    {{ $produtos->links() }}

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
