@extends('dashboard.templates.index')

@section('title', 'Configurações')

@section('links')

<a href="{{ route('configs.create') }}" class="btn btn-success">Nova</a>

@endsection
