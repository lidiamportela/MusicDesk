@extends('layouts.fo')

@section('content')

    <h1>Álbuns de {{ $band->name }}</h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <a href="{{ route('bands.index-band') }}" class="btn btn-voltar mb-3">← Voltar às bandas</a>

    @auth
        @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a href="{{ route('albums.create', $band) }}" class="btn btn-adicionar mb-3">+ Novo álbum</a>
        @endif
    @endauth

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome do álbum</th>
                <th>Data de lançamento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($albums as $album)
                <tr>
                    <td>
                        @if ($album->photo)
                            <img src="{{ asset('storage/' . $album->photo) }}" alt="{{ $album->name }}" class="album-cover">
                        @endif
                    </td>
                    <td>{{ $album->name }}</td>
                    <td>{{ $album->release_date->format('d/m/Y') }}</td>
                    <td>
                       @auth
                            <a href="{{ route('albums.edit', $album) }}" class="btn btn-sm btn-editar">Editar</a>

                            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <form action="{{ route('albums.destroy', $album) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apagar este álbum?')">
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
                    <td colspan="4">Esta banda ainda não tem álbuns.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
