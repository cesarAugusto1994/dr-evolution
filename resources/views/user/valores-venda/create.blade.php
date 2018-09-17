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
        <h3 class="box-title">Novo Fornecedor</h3>
      </div>
      <div class="box-body">

        <form role="form" method="post" action="{{ route('values.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ old('nome') }}">
                    @if ($errors->has('nome'))
        							<span class="help-block">
        								<strong>{{ $errors->first('nome') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('porcentagem') ? ' has-error' : '' }}">
                    <label for="porcentagem">Percentagem</label>
                    <input type="text" class="form-control percent" id="porcentagem" name="porcentagem" placeholder="Percentagem" value="{{ old('porcentagem') }}">
                    @if ($errors->has('porcentagem'))
        							<span class="help-block">
        								<strong>{{ $errors->first('porcentagem') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" checked name="ativo" value="1"> Ativo
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

</div>

@stop
