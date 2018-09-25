@extends('dashboard.templates.index')

@section('title', 'Produtos')

@section('links')

<a href="{{ route('products.create') }}" class="btn btn-success">Novo</a>

@endsection
