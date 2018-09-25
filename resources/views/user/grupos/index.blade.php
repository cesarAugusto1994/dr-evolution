@extends('dashboard.templates.index')

@section('title', 'Grupos')

@section('links')

<a href="{{ route('groups.create') }}" class="btn btn-success">Novo</a>

@endsection
