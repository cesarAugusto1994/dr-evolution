@extends('dashboard.templates.edit')

@section('title', 'Editar Campo Extra')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <form role="form" method="post" action="{{ route('extras.update',$extra->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">

              <div class="row">

                <div class="col-md-12">

                  <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $extra->nome }}">
                    @if ($errors->has('nome'))
        							<span class="help-block">
        								<strong>{{ $errors->first('nome') }}</strong>
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
