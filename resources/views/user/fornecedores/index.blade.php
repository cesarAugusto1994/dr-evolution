@extends('dashboard.templates.index')

@section('title', 'Fornecedores')

@section('links')

<a href="{{ route('vendors.create') }}" class="btn btn-success">Novo</a>

@endsection
