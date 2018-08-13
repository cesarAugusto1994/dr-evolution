@extends('adminlte::page')

@section('title', 'Empresa - Usuários')

@section('content_header')
    <h1>Empresa Usuários</h1>
@stop

@section('content')

    <div class="row">

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Opções</h3>
          </div>
          <div class="box-body">
              <a href="{{ route('users.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Adicionar Usuário</a>
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
                      <a href="{{ route('users.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
                      <a class="btnRemoveItem" data-route="{{ route('users.destroy', $user->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="11" class="text-center">Nenhum Usuário cadastrardo até o momento!</td>
                  </tr>
                @endforelse
              </tbody>
          </table>
          </div>
          <div class="box-footer clearfix">
            {{ $users->links() }}
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
