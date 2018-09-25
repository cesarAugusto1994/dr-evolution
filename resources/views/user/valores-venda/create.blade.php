@extends('dashboard.templates.create')

@section('title', 'Novo Valor de Venda')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

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
              <button type="submit" class="btn btn-success">Salvar</button>
            </div>
          </form>

        </div>
    </div>
</div>

@stop
