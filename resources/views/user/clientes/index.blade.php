@extends('dashboard.templates.index')

@section('title', 'Clientes')

@section('links')

<a href="{{ route('clients.create') }}" class="btn btn-success">Novo</a>

@endsection
