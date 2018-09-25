@extends('dashboard.templates.index')

@section('title', 'Valores Venda')

@section('links')

<a href="{{ route('values.create') }}" class="btn btn-success">Novo</a>

@endsection
