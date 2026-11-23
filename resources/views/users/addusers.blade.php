@extends('layouts.fo')

@section('content')

    <h1>Adicionar utilizador</h1>

    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input required type="text" name="name" class="form-control" id="name">
        </div>

        @error('name')
            <p>Nome inválido</p>
        @enderror

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input required type="email" name="email" class="form-control" id="email">
        </div>

        @error('email')
            <p>Email inválido</p>
        @enderror

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input required type="password" name="password" class="form-control" id="password">
        </div>

        @error('password')
            <p>Password inválida</p>
        @enderror

        <div class="mb-3">
            <label for="photo" class="form-label">Foto (opcional)</label>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
        </div>

    @error('photo')
        <p>Foto inválida</p>
    @enderror
        <button type="submit" class="btn btn-primary">Registar</button>
    </form>

@endsection
