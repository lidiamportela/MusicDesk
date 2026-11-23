@extends('layouts.fo')

@section('content')

    <h1>Bandas</h1>


    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @auth
        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                <a href="{{ route('bands.create') }}" class="btn btn-adicionar mb-3">+ Nova banda</a>
        @endif
     @endauth


    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Nº de álbuns</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bands as $band)
                <tr>
                    <td>
                        @if ($band->photo)
                            <img src="{{ asset('storage/' . $band->photo) }}" alt="{{ $band->name }}" class="band-photo">
                        @endif
                    </td>
                    <td>{{ $band->name }}</td>
                    <td>{{ $band->albums_count }}</td>

                    <td>
                    <a href="{{ route('bands.albums', $band) }}" class="btn btn-sm btn-albuns">Ver álbuns</a>

               @auth
                    <a href="{{ route('bands.edit', $band) }}" class="btn btn-sm btn-editar">Editar</a>

                    @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                        <form action="{{ route('bands.destroy', $band) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apagar esta banda e os seus álbuns?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-apagar">Apagar</button>
                        </form>
                    @endif
                @endauth
            </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Ainda não há bandas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
