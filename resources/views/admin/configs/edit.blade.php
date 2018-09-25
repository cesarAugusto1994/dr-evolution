@extends('dashboard.templates.edit')

@section('title', 'Editar Configuração')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <form role="form" method="post" action="{{ route('configs.update', $config->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $config->nome }}">
              </div>
              <div class="form-group">
                <label for="email">Slug</label>
                <input type="text" class="form-control" disabled value="{{ $config->slug }}">
              </div>

              <div class="form-group">
                <label for="nome">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $config->descricao }}">
              </div>

              <div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
                <label for="tipo_pessoa_id">Tipo</label>
                <select class="form-control" id="tipo_id" name="tipo_id" placeholder="Tipo">
                  @foreach(\App\Models\Config\Tipo::all() as $item)
                      <option value="{{ $item->id }}" {{ $config->tipo->id == $item->id ? 'selected' : '' }}>{{ $item->nome }}</option>
                  @endforeach
                </select>
                @if ($errors->has('tipo_id'))
    							<span class="help-block">
    								<strong>{{ $errors->first('tipo_id') }}</strong>
    							</span>
    						@endif
              </div>

              @if($config->tipo->id == 1)
                <div class="form-group">
                  <label for="cidade">Valor</label>
                  <input type="text" class="form-control" id="valor" name="valor" value="{{ $config->valor }}">
                </div>
              @elseif($config->tipo->id == 2)
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ativo" value="1" {{ $config->valor ? 'checked' : '' }}> Habilitado
                  </label>
                </div>
              @elseif($config->tipo->id == 3)
                <div class="form-group">
                  <label for="exampleInputFile">Valor</label>
                  <input type="file" class="form-control filestyle" data-size="md" data-buttontext="Selecione um comprovante" data-buttonname="btn-default" id="valor" name="valor"/>
                </div>
              @elseif($config->tipo->id == 4)

              @endif

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="ativo" value="1" {{ $config->ativo ? 'checked' : '' }}> Ativo
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
