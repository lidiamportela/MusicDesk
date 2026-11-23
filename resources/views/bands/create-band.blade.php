@extends('layouts.fo')

@section('content')

    <h1>Nova banda</h1>

    <form method="POST" action="{{ route('bands.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-guardar">Guardar</button>
        <a href="{{ route('bands.index-band') }}" class="btn btn-outline-light">Cancelar</a>
    </form>

@endsection
