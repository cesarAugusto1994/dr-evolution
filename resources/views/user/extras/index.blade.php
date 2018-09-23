@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1>Grupos</h1>
@stop

@section('content')

    <div class="row">

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Opções</h3>
          </div>
          <div class="box-body">

              <a href="{{ route('extras.create') }}" class="btn btn-sm btn-success"><i class="fa fa-add"></i> Adicionar Grupo</a>

          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Listagem</h3>

          <div class="box-body">
            {{ $table }}
          </table>
          </div>
          <div class="box-footer clearfix">

          </div>
        </div>

      </div>

    </div>

@stop
