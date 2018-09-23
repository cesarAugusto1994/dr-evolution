@extends('dashboard.templates.edit')

@section('title', 'Editar Fornecedor')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

        <form role="form" method="post" action="{{ route('vendors.update', $fornecedor->uuid) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $fornecedor->nome }}" placeholder="Nome">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $fornecedor->email }}" placeholder="Email">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('tipo_pessoa_id') ? ' has-error' : '' }}">
                    <label for="tipo_pessoa_id">Tipo Pessoa</label>
                    <select class="form-control" id="tipo_pessoa_id" name="tipo_pessoa_id" placeholder="Tipo Pessoa">
                      @foreach(\App\Models\Pessoa\Tipo::all() as $item)
                          <option value="{{ $item->id }}" {{ $fornecedor->tipo->id == $item->id ? 'selected' : '' }}>{{ $item->nome }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('tipo_pessoa_id'))
        							<span class="help-block">
        								<strong>{{ $errors->first('tipo_pessoa_id') }}</strong>
        							</span>
        						@endif
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nif">NIF</label>
                    <input type="text" class="form-control" id="nif" name="nif" value="{{ $fornecedor->nif }}" placeholder="NIF">
                  </div>
                </div>



                <div class="col-md-4">
                  <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $fornecedor->cidade }}" placeholder="Cidade">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $fornecedor->endereco }}" placeholder="Endereço">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $fornecedor->telefone }}" placeholder="Telefone">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" value="{{ $fornecedor->celular }}" placeholder="Celular">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="celular">Limite Dívida</label>
                    <input type="text" class="form-control money" id="celular" name="limite_divida" value="{{ number_format($fornecedor->limite_divida*100, 2) }}" placeholder="Limite Dívida">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="avatar">Logo</label>
                    <input type="file" class="form-control filestyle" data-size="md" data-buttontext="Selecione um comprovante" data-buttonname="btn-default" id="avatar" name="avatar"/>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ativo" value="1" {{ $fornecedor->ativo ? 'checked' : '' }}> Ativo
                    </label>
                  </div>
                </div>
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>

        </div>
    </div>
</div>

@stop
