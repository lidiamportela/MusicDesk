@extends('layouts.fo')

@section('content')

    <div class="home-page text-center">
        <div class="home-content">
            <h1>Bem-vindo ao MusicDesk!</h1>
            <p>O espaço dedicado à música, bandas e álbuns.</p>

            <a href="{{ route('bands.index-band') }}" class="btn btn-adicionar">
                Explorar bandas
            </a>
        </div>
    </div>

@endsection
