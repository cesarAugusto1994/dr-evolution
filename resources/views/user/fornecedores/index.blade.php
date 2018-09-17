@extends('adminlte::page')

@section('title', 'Fornecedores')

@section('content_header')
    <h1>Fornecedores</h1>
@stop

@section('content')

    <div class="row">

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Opções</h3>
          </div>
          <div class="box-body">

              <a href="{{ route('vendors.create') }}" class="btn btn-sm btn-success"><i class="fa fa-add"></i> Adicionar Fornecedor</a>

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
                @forelse($fornecedores as $fornecedor)
                  <tr>
                    <td>{{ $fornecedor->id }}</td>
                    <td>{{ $fornecedor->nome }}</td>
                    <td>{{ $fornecedor->email }}</td>
                    <td>{{ $fornecedor->tipo->nome }}</td>
                    <td><img class="img" alt="" src="{{ route('logo', ['logo' => $fornecedor->avatar]) }}"></td>
                    <td>{{ $fornecedor->nif }}</td>
                    <td>{{ $fornecedor->cidade }}</td>
                    <td>{{ $fornecedor->endereco }}</td>
                    <td>{{ $fornecedor->telefone }}</td>
                    <td>{{ $fornecedor->celular }}</td>
                    <td>{{ number_format($fornecedor->limite_divida*100, 2) }}</td>
                    <td><span class="badge {{ $fornecedor->ativo ? 'bg-teal' : 'bg-red' }} ">{{ $fornecedor->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                    <td>{{ $fornecedor->created_at }}</td>
                    <td>

                      <a class="btn btn-primary" href="{{ route('vendors.edit', $fornecedor->uuid) }}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btnRemoveItem" data-route="{{ route('vendors.destroy', $fornecedor->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="14" class="text-center">Nenhuma Empresa cadastrarda até o momento!</td>
                  </tr>
                @endforelse
              </tbody>
          </table>
          </div>
          <div class="box-footer clearfix">
            {{ $fornecedores->links() }}
          </div>
        </div>

      </div>

    </div>

@stop

@section('js')

  <script>

    $(".btnRemoveItem").click(function(e) {
        var self = $(this);

        swal({
          title: 'Remover este item?',
          text: "Não será possível recuperá-lo!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim',
          cancelButtonText: 'Cancelar'
          }).then((result) => {
          if (result.value) {

            e.preventDefault();

            $.ajax({
              headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
              url: self.data('route'),
              type: 'POST',
              dataType: 'json',
              data: {
                _method: 'DELETE'
              }
            }).done(function() {

              self.parents('tr').hide();

              swal(
                'Ok!',
                'O registro fori removido com sucesso.',
                'success'
              )

            });


          }
        });

    });

  </script>

@stop
