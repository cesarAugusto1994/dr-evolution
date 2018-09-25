@extends('dashboard.templates.create')

@section('title', 'Grupos')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

        <form role="form" method="post" action="{{ route('groups.store') }}">
            {{ csrf_field() }}
            <div class="box-body">

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ old('nome') }}" required>
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
              <button type="submit" class="btn btn-success">Salvar</button>
            </div>
          </form>

        </div>
    </div>
</div>


@stop
