@extends('layouts.fo')

@section('content')

    <h1>Dashboard</h1>

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

@endsection
