@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            @isset($form)
            {!! form($form) !!}
            @endisset

        </div>
    </div>
</div>

@endsection
