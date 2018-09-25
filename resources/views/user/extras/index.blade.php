@extends('dashboard.templates.index')

@section('title', 'Campos Extras')

@section('links')

<a href="{{ route('extras.create') }}" class="btn btn-success">Novo</a>

@endsection
