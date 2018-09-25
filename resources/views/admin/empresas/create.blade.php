@extends('dashboard.templates.create')

@section('title', 'Nova Empresa')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <form role="form" method="post" action="{{ route('companies.store') }}" enctype="multipart/form-data">
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

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
        							<span class="help-block">
        								<strong>{{ $errors->first('email') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('tipo_pessoa_id') ? ' has-error' : '' }}">
                    <label for="tipo_pessoa_id">Tipo Pessoa</label>
                    <select class="form-control" id="tipo_pessoa_id" name="tipo_pessoa_id" placeholder="Tipo Pessoa">
                      @foreach(\App\Models\Pessoa\Tipo::all() as $item)
                          <option value="{{ $item->id }}" {{ old('tipo_pessoa_id') == $item->id ? 'selected' : '' }}>{{ $item->nome }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('tipo_pessoa_id'))
        							<span class="help-block">
        								<strong>{{ $errors->first('tipo_pessoa_id') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('nif') ? ' has-error' : '' }}">
                    <label for="nif">NIF</label>
                    <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF" value="{{ old('nif') }}">
                    @if ($errors->has('nif'))
        							<span class="help-block">
        								<strong>{{ $errors->first('nif') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                    <label for="exampleInputFile">Logo</label>
                    <input type="file" class="form-control filestyle" data-size="md" data-buttontext="Selecione um comprovante" data-buttonname="btn-default" id="logo" name="logo"/>
                    @if ($errors->has('logo'))
        							<span class="help-block">
        								<strong>{{ $errors->first('logo') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="{{ old('cidade') }}">
                    @if ($errors->has('cidade'))
        							<span class="help-block">
        								<strong>{{ $errors->first('cidade') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{ old('endereco') }}">
                    @if ($errors->has('endereco'))
        							<span class="help-block">
        								<strong>{{ $errors->first('endereco') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
                    @if ($errors->has('telefone'))
        							<span class="help-block">
        								<strong>{{ $errors->first('telefone') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="{{ old('celular') }}">
                    @if ($errors->has('celular'))
        							<span class="help-block">
        								<strong>{{ $errors->first('celular') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ativo" checked value="1"> Ativo
                    </label>
                  </div>

                </div>


              </div>

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="email">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="{{ trans('adminlte::adminlte.password') }}"
                    value="{{ old('password') }}">
                    @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="{{ trans('adminlte::adminlte.retype_password') }}" value="{{ old('password_confirmation') }}">
                    @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
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


@stop
