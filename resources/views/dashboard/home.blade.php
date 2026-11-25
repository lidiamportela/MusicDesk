@extends('layouts.fo')

@section('content')

    <h1>Dashboard</h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <h5>Olá, {{ Auth::user()->name }}</h5>

    @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)        <div class="alert alert-success" role="alert">
            Conta de Administrador
        </div>
    @else
        <div class="alert alert-info" role="alert">
            Conta de Utilizador
        </div>
    @endif

    <a href="{{ route('users.edit', Auth::id()) }}" class="btn btn-light">
        Editar perfil
    </a>

    @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
        <a href="{{ route('users.all') }}" class="btn btn-light">
            Ver utilizadores
        </a>
    @endif

@endsection
