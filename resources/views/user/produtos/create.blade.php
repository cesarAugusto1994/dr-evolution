@extends('dashboard.templates.create')

@section('title', 'Novo Produto')

@section('content')

<div class="row">

  <div class="col-md-12">
      <div class="card-box">

        <form role="form" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">

          {{ csrf_field() }}

          <ul class="nav nav-tabs tabs-bordered nav-justified">
              <li class="nav-item">
                  <a href="#info-b2" data-toggle="tab" aria-expanded="false" class="nav-link active">
                      Informações
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#detalhes-b2" data-toggle="tab" aria-expanded="true" class="nav-link">
                      Detalhes
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#valores-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                      Valores
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#estoque-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                      Estoque
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#imagens-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                      Imagens
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#fornecedores-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                      Fornecedres
                  </a>
              </li>
              <li class="nav-item">
                  <button class="btn btn-success btn-block waves-effect waves-light w-md" type="submit">Salvar</button>
              </li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane active" id="info-b2">

                <div class="panel panel-default panel-fill">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informações do Produto</h3>
                    </div>
                    <div class="panel-body">

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">
                              <label for="nome">Nome do Produto</label>
                              <input type="text" name="nome" id="nome" class="form-control" required>
                          </div>

                        </div>
                        <div class="col-md-4">

                          <div class="form-group">
                              <label for="codigo">Código</label>
                              <input type="text" pattern="\d*" name="codigo" id="codigo" class="form-control" required>
                          </div>

                        </div>
                        <div class="col-md-4">

                          <div class="form-group">
                              <label for="codigo_barras">Código de Barras</label>
                              <input type="text" name="codigo_barras" id="codigo_barras" class="form-control">
                          </div>

                        </div>
                        <div class="col-md-12">

                          <div class="form-group">
                              <label for="grupo_id">Grupo</label>

                              <select class="form-control select2" id="grupo_id" name="grupo_id" required>
                                <option value="">Nenhum</option>
                                @foreach(\App\Models\Produto\Grupo::all() as $item)
                                    <option value="{{ $item->id }}" {{ old('grupo_id') == $item->id ? 'selected' : '' }}>{{ $item->nome }}</option>
                                @endforeach
                              </select>

                          </div>

                        </div>
                        <div class="col-md-12">

                          <div class="form-group">
                              <label for="AboutMe">Descrição</label>
                              <textarea style="height: 125px" name="descricao" id="descricao" class="form-control"></textarea>
                          </div>

                        </div>

                      </div>

                    </div>
                </div>

              </div>
              <div class="tab-pane" id="detalhes-b2">

                <div class="row">

                  <div class="col-md-4">

                    <div class="row">

                      <div class="col-md-12">

                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Dimenssões</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="peso">Peso (kg)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> kg</span>
                                        </div>
                                        <input type="text" name="peso" id="peso" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="largura">Largura (m)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> Mt</span>
                                        </div>
                                        <input type="text" pattern="" name="largura" id="largura" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="altura">Altura (m)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> Mt</span>
                                        </div>
                                        <input type="text" name="altura" id="altura" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comprimento">Comprimento (m)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> Mt</span>
                                        </div>
                                        <input type="text" name="comprimento" id="comprimento" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                      </div>

                      <div class="col-md-12">

                        <div class="panel panel-default panel-fill">
                          <div class="panel-heading">
                              <h3 class="panel-title">Detalhes</h3>
                          </div>
                          <div class="panel-body">
                              <div class="form-group">
                                  <input type="checkbox" name="ativo" id="ativo" checked>
                                  <label for="ativo">Produto Ativo</label>
                              </div>
                              <div class="form-group">
                                  <label for="codigo">Comissão (%)</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"> %</span>
                                      </div>
                                      <input type="text" name="comissao" id="comissao" class="form-control">
                                  </div>
                              </div>
                          </div>
                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="col-md-8">

                    <div class="panel panel-default panel-fill">
                        <div class="panel-heading">
                            <h3 class="panel-title">Campos Extras</h3>
                        </div>
                        <div class="panel-body">

                            @foreach(\App\Models\Extra::all() as $extra)
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> {{ $extra->nome }}</span>
                                    </div>
                                    <input type="text" id="{{ str_slug($extra->nome) }}" name="{{ str_slug($extra->nome) }}" class="form-control">
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                  </div>

                </div>

              </div>
              <div class="tab-pane" id="valores-b2">

                <div class="row">

                  <div class="col-md-4">

                    <div class="row">

                      <div class="col-md-12">

                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Valores</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="FullName">Valor de Custo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> R$</span>
                                        </div>
                                        <input type="text" name="custo" id="custo" class="form-control money" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="despesas">Outras despesas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> R$</span>
                                        </div>
                                        <input type="text" name="despesas" id="despesas" class="form-control money">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="valor_final">Valor Final</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> R$</span>
                                            </div>
                                            <input type="text" name="valor_final" id="valor_final" class="form-control" readonly>
                                        </div>
                                    </div>
                            </div>
                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="col-md-8">

                    <div class="panel panel-default panel-fill">
                        <div class="panel-heading">
                            <h3 class="panel-title">calculo Valor Venda</h3>
                        </div>
                        <div class="panel-body">



                        </div>
                    </div>

                  </div>

                </div>

              </div>
              <div class="tab-pane" id="estoque-b2">

                <div class="panel panel-default panel-fill">
                    <div class="panel-heading">
                        <h3 class="panel-title">Estoque</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="estoque_minimo">Estoque mínimo</label>
                            <input type="text" name="estoque_minimo" id="estoque_minimo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="estoque_maximo">Estoque máximo</label>
                            <input type="text" pattern="" name="estoque_maximo" id="estoque_maximo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="estoque_atual">Estoque atual</label>
                            <input type="text" name="estoque_atual" id="estoque_atual" class="form-control">
                        </div>
                    </div>
                </div>

              </div>
              <div class="tab-pane" id="imagens-b2">

                <div class="panel panel-default panel-fill">
                    <div class="panel-heading">
                        <h3 class="panel-title">Adicionar Imagens</h3>
                    </div>
                    <div class="panel-body">
                        <input type="file" name="imagens[]" multiple class="filestyle"  data-placeholder="Sem Arquivos" data-text="Adicionar Imagens" data-buttonname="btn-default" id="filestyle-5" tabindex="-1">
                    </div>
                </div>

              </div>

              <div class="tab-pane" id="fornecedores-b2">

                  <div class="form-group">
                    <label>Fornecedores</label>
                    <select style="width:150px" class="form-control select2" multiple id="select-fornecedor" name="fornecedores[]" data-url="{{ route('fornecedores') }}"></select>
                  </div>

              </div>
          </div>

          <button class="btn btn-success btn-block waves-effect waves-light w-md" type="submit">Salvar</button>

        </form>
      </div>
  </div>

</div>

@stop

@section('js')

  <script>

    $("#grupo_id").select2();

    $('#select-fornecedor').select2({
        ajax: {
          type: "GET",
          url: $('#select-fornecedor').data('url'),
          data: function (params) {
            var query = {
              search: params.term,
              type: 'public'
            }

            return query;
          },
          processResults: function (data) {
              return {
                  results: $.map(JSON.parse(data), function (item) {
                      return {
                          text: item.nome,
                          id: item.id
                      }
                  })
              };
          }
        },
        placeholder: 'Selecione um Fornecedor',
        minimumInputLength: 1,
        width: '100%'
    });

  </script>

@stop
