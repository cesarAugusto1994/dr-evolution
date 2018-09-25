@extends('dashboard.templates.index')

@section('title', 'Empresas')

@section('links')

<a href="{{ route('companies.create') }}" class="btn btn-success">Novo</a>

@endsection
