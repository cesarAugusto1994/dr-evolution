@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1>Grupos</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Grupo</h3>
      </div>
      <div class="box-body">

        <form role="form" method="post" action="{{ route('groups.store') }}">
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

                  <div class="form-group{{ $errors->has('grupo_pai') ? ' has-error' : '' }}">
                    <label for="grupo_pai">Grupo Pai</label>
                    <select class="form-control" id="grupo_pai" name="grupo_pai" placeholder="Grupo">
                      <option value="">Sem Grupo Pai</option>
                      @foreach(\App\Models\Produto\Grupo::all() as $item)
                          
                          <option value="{{ $item->id }}" {{ old('grupo_pai') == $item->id ? 'selected' : '' }}>{{ $item->nome }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('grupo_pai'))
        							<span class="help-block">
        								<strong>{{ $errors->first('grupo_pai') }}</strong>
        							</span>
        						@endif
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
