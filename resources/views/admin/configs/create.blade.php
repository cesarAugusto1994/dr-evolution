@extends('dashboard.templates.edit')

@section('title', 'Editar Configuração')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <form role="form" method="post" action="{{ route('configs.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome">
                @if ($errors->has('nome'))
    							<span class="help-block">
    								<strong>{{ $errors->first('nome') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                <label for="nome">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao">
                @if ($errors->has('descricao'))
    							<span class="help-block">
    								<strong>{{ $errors->first('descricao') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
                <label for="tipo_pessoa_id">Tipo</label>
                <select class="form-control" id="tipo_id" name="tipo_id" placeholder="Tipo">
                  @foreach(\App\Models\Config\Tipo::all() as $item)
                      <option value="{{ $item->id }}">{{ $item->nome }}</option>
                  @endforeach
                </select>
                @if ($errors->has('tipo_id'))
    							<span class="help-block">
    								<strong>{{ $errors->first('tipo_id') }}</strong>
    							</span>
    						@endif
              </div>

              <div class="form-group valores" id="config-1">
                <label for="cidade">Valor</label>
                <input type="text" class="form-control" id="valor" name="valor" value="">
              </div>
              <div class="checkbox valores" id="config-2">
                <label>
                  <input type="checkbox" name="ativo" value="1"> Habilitado
                </label>
              </div>
              <div class="form-group valores" id="config-3">
                <label for="exampleInputFile">Valor</label>
                <input type="file" class="form-control" id="valor" name="valor"/>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="ativo" value="1" checked> Ativo
                </label>
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

@section('js')

  <script>

    function habilitarValor() {

      $('.valores').hide();

      var tipo = $("#tipo_id").val();

      $("#config-"+tipo).show();

    }

    $(document).ready(function() {

      habilitarValor();

      $("#tipo_id").change(function() {
        habilitarValor();
      });

    });

  </script>

@stop
