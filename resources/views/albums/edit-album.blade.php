@extends('layouts.fo')

@section('content')

    <h1>Editar álbum</h1>

    <form method="POST" action="{{ route('albums.update', $album) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome do álbum</label>
            <input type="text" name="name" class="form-control" id="name"
                value="{{ old('name', $album->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Data de lançamento</label>
            <input type="date" name="release_date" class="form-control" id="release_date"
                value="{{ old('release_date', $album->release_date->format('Y-m-d')) }}" required>
            @error('release_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @if ($album->photo)
            <div class="mb-3">
                <p class="mb-1">Imagem atual:</p>
                <img src="{{ asset('storage/' . $album->photo) }}" alt="{{ $album->name }}" class="photo-preview">
            </div>
        @endif

        <div class="mb-3">
            <label for="photo" class="form-label">Nova imagem (opcional)</label>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="preview_url" class="form-label">Preview (YouTube ou Spotify)</label>

            <input
                type="url"
                name="preview_url"
                id="preview_url"
                class="form-control"
                value="{{ old('preview_url', $album->preview_url) }}"
                placeholder="https://www.youtube.com/watch?v=..."
            >

        <div class="form-text">
            Introduz o endereço de um vídeo, álbum ou faixa.
        </div>

            @error('preview_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-guardar">Guardar</button>
        <a href="{{ route('bands.albums', $album->band_id) }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>

@endsection
