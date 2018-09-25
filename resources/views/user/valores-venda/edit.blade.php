@extends('dashboard.templates.create')

@section('title', 'Editar Valor de Venda')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

          <form role="form" method="post" action="{{ route('values.update', $valor->uuid) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $valor->nome }}" placeholder="Nome">
                  </div>
                </div>


                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('porcentagem') ? ' has-error' : '' }}">
                    <label for="porcentagem">Percentagem</label>
                    <input type="text" class="form-control percent" id="porcentagem" name="porcentagem" placeholder="Percentagem" value="{{ $valor->porcentagem }}">
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
                      <input type="checkbox" name="ativo" value="1" {{ $valor->ativo ? 'checked' : '' }}> Ativo
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
