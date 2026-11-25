@extends('layouts.fo')

@section('content')

    <h1>Álbuns de {{ $band->name }}</h1>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <a href="{{ route('bands.index-band') }}" class="btn btn-voltar mb-3">← Voltar às bandas</a>

    <div class="d-flex justify-content-between align-items-center mb-3">
        @auth
            @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                <a href="{{ route('albums.create', $band) }}" class="btn btn-adicionar">+ Novo álbum</a>
            @endif
        @endauth

        <details class="d-inline-block">
            <summary class="btn btn-secondary">
                Exportar
            </summary>

            <div class="dropdown-menu show">
                <a class="dropdown-item" href="{{ route('bands.export.pdf', $band) }}">PDF</a>
                <a class="dropdown-item" href="{{ route('bands.export.csv', $band) }}">CSV</a>
                <a class="dropdown-item" href="{{ route('bands.export.json', $band) }}">JSON</a>
            </div>
        </details>
    </div>

    <form action="{{ route('bands.albums', $band) }}" method="GET" class="mb-3">
        <input
            type="text"
            name="search"
            placeholder="Pesquisar álbum..."
            value="{{ request('search') }}"
            class="form-control"
        >

        <button class="btn btn-secondary mt-2" type="submit">Procurar</button>
    </form>

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome do álbum</th>
                <th>Data de lançamento</th>
                <th>Preview</th>
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
                        @if ($album->embedUrl())
                            <iframe
                                src="{{ $album->embedUrl() }}"
                                width="250"
                                height="152"
                                style="border: 0; border-radius: 8px;"
                                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                loading="lazy"
                                title="Preview de {{ $album->name }}">
                            </iframe>
                        @else
                            <span>Sem preview</span>
                        @endif
                    </td>

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
                    <td colspan="5">
                        @if (request('search'))
                            Não foram encontrados álbuns.
                        @else
                            Esta banda ainda não tem álbuns.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
