@extends('layouts.fo')

@section('content')

    <h1>Novo álbum de {{ $band->name }}</h1>

    <form method="POST" action="{{ route('albums.store', $band) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome do álbum</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Data de lançamento</label>
            <input type="date" name="release_date" class="form-control" id="release_date"
                value="{{ old('release_date') }}" required>
            @error('release_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Imagem</label>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-guardar">Guardar</button>
        <a href="{{ route('bands.albums', $band) }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>

@endsection
