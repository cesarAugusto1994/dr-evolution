@extends('adminlte::page')

@section('title', 'Funcionários')

@section('content_header')
    <h1>Funcionários</h1>
@stop

@section('content')

    <div class="row">

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Opções</h3>
          </div>
          <div class="box-body">

              <a href="{{ route('employees.create') }}" class="btn btn-sm btn-success"><i class="fa fa-add"></i> Adicionar Funcionário</a>

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
                  <th>Sexo</th>
                  <th>Email</th>
                  <th>Nascimento</th>
                  <th>Comissão</th>
                  <th>Avatar</th>
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
                @forelse($funcionarios as $funcionario)
                  <tr>
                    <td>{{ $funcionario->id }}</td>
                    <td>{{ $funcionario->nome }}</td>
                    <td>{{ $funcionario->sexo == 'M' ? 'Masculino' : 'Feminino' }}</td>
                    <td>{{ $funcionario->email }}</td>
                    <td>{{ $funcionario->nascimento ? $funcionario->nascimento->format('d/m/Y') : '' }}</td>
                    <td>{{ $funcionario->comissao }} %</td>
                    <td><img class="img" alt="" src="{{ route('logo', ['logo' => $funcionario->avatar]) }}"></td>
                    <td>{{ $funcionario->nif }}</td>
                    <td>{{ $funcionario->cidade }}</td>
                    <td>{{ $funcionario->endereco }}</td>
                    <td>{{ $funcionario->telefone }}</td>
                    <td>{{ $funcionario->celular }}</td>
                    <td><span class="badge {{ $funcionario->ativo ? 'bg-teal' : 'bg-red' }} ">{{ $funcionario->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                    <td>{{ $funcionario->created_at }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('employees.edit', $funcionario->uuid) }}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btnRemoveItem" data-route="{{ route('employees.destroy', $funcionario->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="15" class="text-center">Nenhum funcionário cadastrardo até o momento!</td>
                  </tr>
                @endforelse
              </tbody>
          </table>
          </div>
          <div class="box-footer clearfix">
            {{ $funcionarios->links() }}
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
