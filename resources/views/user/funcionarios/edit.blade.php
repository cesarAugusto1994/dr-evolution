@extends('dashboard.templates.edit')

@section('title', 'Editar Funcionário')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

          <form role="form" method="post" action="{{ route('employees.update', $funcionario->uuid) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $funcionario->nome }}" placeholder="Nome">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $funcionario->email }}" placeholder="Email">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">
                    <label for="sexo">Sexo</label>
                    <select class="form-control" id="sexo" name="sexo" placeholder="Sexo">
                      <option value="M" {{ $funcionario->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                      <option value="F" {{ $funcionario->sexo == 'F' ? 'selected' : '' }}>Feminino</option>
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
                    <input type="text" class="form-control percent" id="comissao" name="comissao" placeholder="Comissão" value="{{ $funcionario->comissao }}">
                    @if ($errors->has('comissao'))
        							<span class="help-block">
        								<strong>{{ $errors->first('comissao') }}</strong>
        							</span>
        						@endif
                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nif">NIF</label>
                    <input type="text" class="form-control" id="nif" name="nif" value="{{ $funcionario->nif }}" placeholder="NIF">
                  </div>
                </div>

                <div class="col-md-4">

                  <div class="form-group{{ $errors->has('nascimento') ? ' has-error' : '' }}">
                    <label for="nascimento">Nascimento</label>
                    <input type="text" class="form-control date" id="nascimento" name="nascimento" placeholder="Nascimento" value="{{ $funcionario->nascimento ? $funcionario->nascimento->format('d/m/Y') : '' }}">
                    @if ($errors->has('nascimento'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nascimento') }}</strong>
                      </span>
                    @endif
                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $funcionario->cidade }}" placeholder="Cidade">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $funcionario->endereco }}" placeholder="Endereço">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $funcionario->telefone }}" placeholder="Telefone">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" value="{{ $funcionario->celular }}" placeholder="Celular">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="avatar">Logo</label>
                    <input type="file" class="form-control filestyle" data-size="md" data-buttontext="Selecione um comprovante" data-buttonname="btn-default" id="avatar" name="avatar"/>
                  </div>
                </div>

                <div class="col-md-12">

                  <div class="form-group{{ $errors->has('observacoes') ? ' has-error' : '' }}">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" placeholder="Observações">{{ $funcionario->observacoes }}</textarea>
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
                      <input type="checkbox" name="ativo" value="1" {{ $funcionario->ativo ? 'checked' : '' }}> Ativo
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
