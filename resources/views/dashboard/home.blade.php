@extends('layouts.fo')

@section('content')

    <h1>BackOffice</h1>

    <h5>Olá, {{ Auth::user()->name }}</h5>

    @if (Auth::user()->email == 'admin@gmail.com')
        <div class="alert alert-success" role="alert">
            Conta de Administrador
        </div>
    @else
        <div class="alert alert-info" role="alert">
            Conta de Utilizador
        </div>
    @endif

@endsection
