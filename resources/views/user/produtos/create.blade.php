@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Produto</h3>
      </div>
      <div class="box-body">

        <form class="form-horizontal" role="form" method="post" action="{{ route('clients.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">

              <div class="row">

                <div class="col-md-12">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Informações</a></li>
                      <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Detalhes</a></li>
                      <li><a href="#tab_3" data-toggle="tab">Valores</a></li>

                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">

                        <div class="row">

                          <div class="col-lg-3">
                            <div class="input-group" style="width:100%">
                              <label for="ProdutoNome">Nome do produto</label>
                              <input type="text" class="form-control" required name="nome">
                            </div>
                          </div>

                          <div class="col-lg-2">
                            <div class="input-group">
                              <label for="ProdutoNome">Código</label>
                              <input type="text" class="form-control" required name="codigo">
                            </div>
                          </div>

                          <div class="col-lg-2">
                            <div class="input-group">
                              <label for="ProdutoNome">Código de Barras</label>
                              <input type="text" class="form-control" required name="codigo_barras">
                            </div>
                          </div>

                          <div class="col-lg-2">
                            <div class="input-group">
                              <label for="ProdutoNome">Grupo</label>

                              <select class="form-control" id="grupo_pai" name="grupo_pai" placeholder="Grupo">
                                <option value="">Nenhum</option>
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
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">


                        <div class="row">

                            <div class="col-lg-4">

                                <div class="col-lg-12">
                                  <div class="input-group" style="width:100%">
                                    <label for="ProdutoNome">Nome do produto</label>
                                    <input type="text" class="form-control" required name="nome">
                                  </div>
                                </div>

                                <div class="col-lg-12">
                                  <div class="input-group" style="width:100%">
                                    <label for="ProdutoNome">Código</label>
                                    <input type="text" class="form-control" required name="codigo">
                                  </div>
                                </div>

                                <div class="col-lg-12">
                                  <div class="input-group" style="width:100%">
                                    <label for="ProdutoNome">Código de Barras</label>
                                    <input type="text" class="form-control" required name="codigo_barras">
                                  </div>
                                </div>

                            </div>

                            <div class="col-lg-8">

                                <div class="col-lg-12">
                                  <div class="input-group" style="width:100%">
                                    <label for="ProdutoNome">Descrição do produto</label>
                                    <textarea class="form-control" name="descricao"></textarea>
                                  </div>
                                </div>

                            </div>

                        </div>


                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
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
