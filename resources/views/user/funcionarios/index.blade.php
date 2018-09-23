@extends('dashboard.templates.index')

@section('title', 'Funcionários')

@section('links')

<a href="{{ route('employees.create') }}" class="btn btn-success">Novo</a>

@endsection
