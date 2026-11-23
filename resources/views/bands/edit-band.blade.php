@extends('layouts.fo')

@section('content')

    <h1>Editar banda</h1>

    <form method="POST" action="{{ route('bands.update', $band) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name"
                value="{{ old('name', $band->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @if ($band->photo)
            <div class="mb-3">
                <p class="mb-1">Foto atual:</p>
                <img src="{{ asset('storage/' . $band->photo) }}" alt="{{ $band->name }}" class="photo-preview">
            </div>
        @endif

        <div class="mb-3">
            <label for="photo" class="form-label">Nova foto (opcional)</label>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-guardar">Guardar</button>
        <a href="{{ route('bands.index-band') }}" class="btn btn-outline-light">Cancelar</a>
    </form>

@endsection
