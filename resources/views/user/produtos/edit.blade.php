@extends('dashboard.templates.edit')

@section('title', 'Editar Produto')

@section('content')

<div class="row">

  <div class="col-md-12">
      <div class="card-box">

        <form role="form" method="post" action="{{ route('products.update', $produto->id) }}" enctype="multipart/form-data">

          {{ csrf_field() }}
          {{ method_field('PUT') }}

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
                              <input type="text" name="nome" id="nome" value="{{ $produto->nome }}" class="form-control" required>
                          </div>

                        </div>
                        <div class="col-md-4">

                          <div class="form-group">
                              <label for="codigo">Código</label>
                              <input type="text" pattern="\d*" name="codigo" id="codigo" class="form-control" value="{{ $produto->codigo }}" required>
                          </div>

                        </div>
                        <div class="col-md-4">

                          <div class="form-group">
                              <label for="codigo_barras">Código de Barras</label>
                              <input type="text" name="codigo_barras" id="codigo_barras" class="form-control" value="{{ $produto->codigo_barras }}">
                          </div>

                        </div>
                        <div class="col-md-12">

                          <div class="form-group">
                              <label for="grupo_id">Grupo</label>

                              <select class="form-control select2" id="grupo_id" name="grupo_id" required>
                                <option value="">Nenhum</option>
                                @foreach(\App\Models\Produto\Grupo::all() as $item)
                                    <option value="{{ $item->id }}" {{ $produto->grupo_id == $item->id ? 'selected' : '' }}>{{ $item->nome }}</option>
                                @endforeach
                              </select>

                          </div>

                        </div>
                        <div class="col-md-12">

                          <div class="form-group">
                              <label for="AboutMe">Descrição</label>
                              <textarea style="height: 125px" name="descricao" id="descricao" class="form-control">{{ $produto->descricao }}</textarea>
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
                                        <input type="text" name="peso" id="peso" class="form-control" value="{{ $produto->peso }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="largura">Largura (m)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> Mt</span>
                                        </div>
                                        <input type="text" name="largura" id="largura" class="form-control" value="{{ $produto->largura }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="altura">Altura (m)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> Mt</span>
                                        </div>
                                        <input type="text" name="altura" id="altura" class="form-control" value="{{ $produto->altura }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comprimento">Comprimento (m)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> Mt</span>
                                        </div>
                                        <input type="text" name="comprimento" id="comprimento" class="form-control" value="{{ $produto->comprimento }}">
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
                                  <input type="checkbox" name="ativo" id="ativo" {{ $produto->ativo ? 'checked' : '' }}>
                                  <label for="ativo">Produto Ativo</label>
                              </div>
                              <div class="form-group">
                                  <label for="codigo">Comissão (%)</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"> %</span>
                                      </div>
                                      <input type="text" name="comissao" id="comissao" class="form-control" value="{{ $produto->comissao }}">
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
                                    <input type="text" id="{{ str_slug($extra->nome) }}" name="{{ str_slug($extra->nome) }}"

                                    @foreach($produto->extras as $item)

                                    @if($item->extra_id == $extra->id)
                                      value="{{ $item->valor }}"
                                    @endif

                                    @endforeach

                                    class="form-control">
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
                                        <input type="text" name="custo" id="custo" class="form-control money" required value="{{ number_format($produto->precificacao->custo, 2, '.', ',') }}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="despesas">Outras despesas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> R$</span>
                                        </div>
                                        <input type="text" name="despesas" id="despesas" class="form-control money" value="{{ number_format($produto->precificacao->despesas, 2, '.', ',') }}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="valor_final">Valor Final</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> R$</span>
                                            </div>
                                            <input type="text" name="valor_final" id="valor_final" class="form-control" readonly value="{{ number_format($produto->precificacao->custo_final, 2, '.', ',') }}"/>
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
                            <input type="text" name="estoque_minimo" id="estoque_minimo" class="form-control" value="{{ $produto->estoque_minimo }}">
                        </div>
                        <div class="form-group">
                            <label for="estoque_maximo">Estoque máximo</label>
                            <input type="text" name="estoque_maximo" id="estoque_maximo" class="form-control" value="{{ $produto->estoque_maximo }}">
                        </div>
                        <div class="form-group">
                            <label for="estoque_atual">Estoque atual</label>
                            <input type="text" name="estoque_atual" id="estoque_atual" class="form-control" value="{{ $produto->estoque_atual }}">
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

                <div class="panel panel-default panel-fill">
                    <div class="panel-heading">
                        <h3 class="panel-title">Imagens</h3>
                    </div>
                    <div class="panel-body">

                      <div class="row">

                        @php

                        $imagens = \App\Models\Produto\Imagem::where('produto_id', $produto->id)->get();

                        @endphp

                        @foreach($imagens as $imagem)
                          <div class="col-md-4 card-box-images">
                              <div class="text-center card-box">
                                  <div class="member-card mt-4">
                                      <span class="user-badge bg-success">Destaque</span>
                                      <div class="thumb-xl member-thumb m-b-10 center-page">

                                          <img src="{{ route('image',['link'=>$imagem->link]) }}" class="img-thumbnail" alt="">

                                      </div>

                                      <br/><br/>

                                      <button type="button" class="btn btn-default btn-sm m-t-10">Destacar</button>
                                      <button type="button" class="btn btn-danger btn-sm m-t-10 btnRemoveItem" data-route="{{ route('produto_imagem_remove', $imagem->id) }}"><i class="fa fa-trash"></i></button>
                                  </div>
                              </div>
                          </div>
                        @endforeach

                      </div>

                    </div>
                </div>

              </div>

              <div class="tab-pane" id="fornecedores-b2">

                  <div class="panel panel-default panel-fill">
                      <div class="panel-heading">
                        <h3 class="panel-title">Fornecedores</h3>
                      </div>
                      <div class="panel-body">

                          <div class="form-group">
                            <label>Fornecedores</label>
                            <select style="width:150px" class="form-control select2" multiple id="select-fornecedor" name="fornecedores[]" data-url="{{ route('fornecedores') }}"></select>
                          </div>

                      </div>
                  </div>

                  <div class="panel panel-default panel-fill">
                      <div class="panel-heading">
                          <h3 class="panel-title">Listagem</h3>
                      </div>
                      <div class="panel-body">

                        <div class="row">

                          <table class="table table-bordered">

                            <thead>
                              <tr>
                                <th>Nome</th>
                                <th style="width:100px">Opções</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($produto->fornecedores as $item)
                                <tr>
                                  <td>{{ $item->fornecedor->nome }}</td>
                                  <td><a class="btn btn-danger btn-sm" href="{{ route('produto_fornecedor_remove', $item->fornecedor->id) }}"><i class="fa fa-trash"></i></a></td>
                                </tr>
                              @endforeach
                            </tbody>

                          </table>

                        </div>

                      </div>
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
