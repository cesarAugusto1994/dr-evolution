@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>Empresas</h1>
@stop

@section('content')

    <div class="row">

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Opções</h3>
          </div>
          <div class="box-body">

              <a href="{{ route('companies.create') }}" class="btn btn-sm btn-success"><i class="fa fa-add"></i> Adicionar Empresa</a>

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
                  <th>Logo</th>
                  <th>NIF</th>
                  <th>Cidade</th>
                  <th>Endereço</th>
                  <th>Telefone</th>
                  <th>Celular</th>
                  <th>Ativo</th>
                  <th>Cadastro</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                @forelse($empresas as $empresa)
                  <tr>
                    <td># {{ $empresa->id }}</td>
                    <td>{{ $empresa->nome }}</td>
                    <td>{{ $empresa->email }}</td>
                    <td><img class="img" alt="" src="asset({{ $empresa->logo }})"></td>
                    <td>{{ $empresa->nif }}</td>
                    <td>{{ $empresa->cidade }}</td>
                    <td>{{ $empresa->endereco }}</td>
                    <td>{{ $empresa->telefone }}</td>
                    <td>{{ $empresa->celular }}</td>
                    <td><span class="badge {{ $empresa->ativo ? 'bg-teal' : 'bg-red' }} ">{{ $empresa->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                    <td>{{ $empresa->created_at }}</td>
                    <td>
                      <a href="{{ route('users.index', ['empresa' => $empresa->id]) }}" title="Usuários"><i class="fa fa-users"></i></a>
                      <a href="{{ route('companies.edit', $empresa->id) }}"><i class="fa fa-edit"></i></a>
                      <a class="btnRemoveItem" data-route="{{ route('companies.destroy', $empresa->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="11" class="text-center">Nenhuma Empresa cadastrarda até o momento!</td>
                  </tr>
                @endforelse
              </tbody>
          </table>
          </div>
          <div class="box-footer clearfix">
            {{ $empresas->links() }}
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
