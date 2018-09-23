@extends('dashboard.templates.create')

@section('title', 'Funcionários')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <form role="form" method="post" action="{{ route('employees.store') }}" enctype="multipart/form-data">
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

                  <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">
                    <label for="tipo_pessoa_id">Sexo</label>
                    <select class="form-control" id="sexo" name="sexo" placeholder="Sexo">
                      <option value="M">Masculino</option>
                      <option value="F">Feminino</option>
                    </select>
                    @if ($errors->has('sexo'))
        							<span class="help-block">
        								<strong>{{ $errors->first('sexo') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('comissao') ? ' has-error' : '' }}">
                    <label for="comissao">Comissão</label>
                    <input type="text" class="form-control percent" id="comissao" name="comissao" placeholder="Comissão" value="{{ old('comissao') }}">
                    @if ($errors->has('comissao'))
        							<span class="help-block">
        								<strong>{{ $errors->first('comissao') }}</strong>
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

                  <div class="form-group{{ $errors->has('nascimento') ? ' has-error' : '' }}">
                    <label for="nascimento">Nascimento</label>
                    <input type="text" class="form-control date" id="nascimento" name="nascimento" placeholder="Nascimento" value="{{ old('nascimento') }}">
                    @if ($errors->has('nascimento'))
        							<span class="help-block">
        								<strong>{{ $errors->first('nascimento') }}</strong>
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

                  <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="avatar">Logo</label>
                    <input type="file" class="form-control filestyle" data-size="md" data-buttontext="Selecione um comprovante" data-buttonname="btn-default" id="avatar" name="avatar"/>
                    @if ($errors->has('avatar'))
        							<span class="help-block">
        								<strong>{{ $errors->first('avatar') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-12">

                  <div class="form-group{{ $errors->has('observacoes') ? ' has-error' : '' }}">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" placeholder="Observações" value="{{ old('observacoes') }}"></textarea>
                    @if ($errors->has('observacoes'))
        							<span class="help-block">
        								<strong>{{ $errors->first('observacoes') }}</strong>
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

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>

        </div>
    </div>
</div>

@stop
