@extends('adminlte::page')

@section('title', 'Configurações da Empresa')

@section('content_header')
    <h1>Configurações da Empresa</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Informações</h3>
      </div>
      <div class="box-body">

        <form role="form" method="post" action="{{ route('companies.update', $empresa->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <input type="hidden" name="return" value="{{ route('config_empresa') }}"/>
            <div class="box-body">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $empresa->nome }}" placeholder="Nome">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $empresa->email }}" placeholder="Email">
              </div>

              <div class="form-group{{ $errors->has('tipo_pessoa_id') ? ' has-error' : '' }}">
                <label for="tipo_pessoa_id">Tipo Pessoa</label>
                <select class="form-control" id="tipo_pessoa_id" name="tipo_pessoa_id" placeholder="Tipo Pessoa">
                  @foreach(\App\Models\Pessoa\Tipo::all() as $item)
                      <option value="{{ $item->id }}" {{ $empresa->tipo->id == $item->id ? 'selected' : '' }}>{{ $item->nome }}</option>
                  @endforeach
                </select>
                @if ($errors->has('tipo_pessoa_id'))
    							<span class="help-block">
    								<strong>{{ $errors->first('tipo_pessoa_id') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group">
                <label for="nif">NIF</label>
                <input type="text" class="form-control" id="nif" name="nif" value="{{ $empresa->nif }}" placeholder="NIF">
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Logo</label>
                <input type="file" id="logo" name="logo"/>
              </div>

              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $empresa->cidade }}" placeholder="Cidade">
              </div>

              <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $empresa->endereco }}" placeholder="Endereço">
              </div>

              <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $empresa->telefone }}" placeholder="Telefone">
              </div>

              <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="{{ $empresa->celular }}" placeholder="Celular">
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="ativo" value="1" {{ $empresa->ativo ? 'checked' : '' }}> Ativo
                </label>
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>

      </div>
    </div>
  </div>

</div>

@stop
