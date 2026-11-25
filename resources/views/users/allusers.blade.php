@extends('layouts.fo')

@section('content')

    <h1>Lista de utilizadores</h1>
    <a href="{{ route('users.add') }}" class="btn btn-light mb-3">
    Adicionar utilizador
    </a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('users.all') }}" method="GET" class="mb-3 d-flex gap-2">
        <input
            type="text"
            name="search"
            class="form-control w-25"
            placeholder="Pesquisar utilizador..."
            value="{{ request('search') }}"
        >

        <button class="btn btn-secondary" type="submit">Procurar</button>
    </form>

    <table class="table users-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>
                        <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" class="photo-table">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
