@extends('adminlte::page')

@section('title', 'Empresa >> Editar Usuário')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <form role="form" method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Nome</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" value="{{ old('name') }}">
                  @if ($errors->has('name'))
      							<span class="help-block">
      								<strong>{{ $errors->first('name') }}</strong>
      							</span>
      						@endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" value="{{ old('email') }}">
                  @if ($errors->has('email'))
      							<span class="help-block">
      								<strong>{{ $errors->first('email') }}</strong>
      							</span>
      						@endif
                </div>

                <div class="form-group{{ $errors->has('empresa_id') ? ' has-error' : '' }}">
                  <label for="telefone">Empresa</label>
                  <select class="form-control" id="empresa_id" name="empresa_id">
                    <option></option>
                    @foreach($empresas as $empresa)
                    <option value="{{ $empresa->id }}" {{ $user->empresa->id == $empresa->id ? 'selected' : '' }}>{{ $empresa->nome }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('empresa_id'))
      							<span class="help-block">
      								<strong>{{ $errors->first('empresa_id') }}</strong>
      							</span>
      						@endif
                </div>

                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                  <label for="telefone">Privilégios</label>
                  <select class="form-control" id="role_id" name="role_id">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->hasOneRole([$role->name]) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('role_id'))
      							<span class="help-block">
      								<strong>{{ $errors->first('role_id') }}</strong>
      							</span>
      						@endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="cidade">Senha</label>
                  <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                  @if ($errors->has('password'))
      							<span class="help-block">
      								<strong>{{ $errors->first('password') }}</strong>
      							</span>
      						@endif
                </div>

                <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                  <label for="endereco">Confirmar Senha</label>
                  <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="{{ old('password_confirm') }}">
                  @if ($errors->has('password_confirm'))
      							<span class="help-block">
      								<strong>{{ $errors->first('password_confirm') }}</strong>
      							</span>
      						@endif
                </div>


                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ativo" value="1" {{ $user->ativo ? 'checked' : '' }}> Ativo
                  </label>
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
        </div>
    </div>
</div>

@endsection
