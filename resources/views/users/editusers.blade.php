@extends('layouts.fo')

@section('content')

    <h1>O meu perfil</h1>

    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name"
                value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
            <div class="form-text">O email não pode ser alterado.</div>
        </div>

        <div class="mb-3">
            <p class="mb-1">Foto atual:</p>
            <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" class="photo-preview">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Nova foto (opcional)</label>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-guardar">Guardar</button>
        <a href="{{ route('dashboard.home') }}" class="btn btn-outline-light">Cancelar</a>
    </form>

@endsection
