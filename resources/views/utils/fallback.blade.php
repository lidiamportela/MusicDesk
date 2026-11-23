@extends('layouts.fo')

@section('content')

    <div class="fallback-page text-center">

        <div class="fallback-content">
            <h1>Erro 404</h1>

            <h2>Oops! Parece que te perdeste...</h2>

            <p>
                A página que procuras não existe ou foi movida.
            </p>

            <a href="{{ route('home') }}" class="btn btn-light">
                Voltar à página inicial
            </a>
        </div>

    </div>

@endsection
