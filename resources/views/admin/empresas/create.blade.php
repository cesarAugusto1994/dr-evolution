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
        <h3 class="box-title">Nova Empresa</h3>
      </div>
      <div class="box-body">

        <form role="form" method="post" action="{{ route('companies.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ old('nome') }}">
                @if ($errors->has('nome'))
    							<span class="help-block">
    								<strong>{{ $errors->first('nome') }}</strong>
    							</span>
    						@endif
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email'))
    							<span class="help-block">
    								<strong>{{ $errors->first('email') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('nif') ? ' has-error' : '' }}">
                <label for="nif">NIF</label>
                <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF" value="{{ old('nif') }}">
                @if ($errors->has('nif'))
    							<span class="help-block">
    								<strong>{{ $errors->first('nif') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                <label for="exampleInputFile">Logo</label>
                <input type="file" id="logo" name="logo"/>
                @if ($errors->has('logo'))
    							<span class="help-block">
    								<strong>{{ $errors->first('logo') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="{{ old('cidade') }}">
                @if ($errors->has('cidade'))
    							<span class="help-block">
    								<strong>{{ $errors->first('cidade') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{ old('endereco') }}">
                @if ($errors->has('endereco'))
    							<span class="help-block">
    								<strong>{{ $errors->first('endereco') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
                @if ($errors->has('telefone'))
    							<span class="help-block">
    								<strong>{{ $errors->first('telefone') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="{{ old('celular') }}">
                @if ($errors->has('celular'))
    							<span class="help-block">
    								<strong>{{ $errors->first('celular') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="ativo" value="1"> Ativo
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
