
@extends('layouts.fo')

@section('content')

    <h1>Aqui vamos carregar todos os utilizadores</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('users.all') }}" method="GET">
        <input type="text" name="search">
        <button class="btn btn-secondary" type="submit">Procurar</button>
    </form>

    <h6>Utilizadores da base de dados</h6>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                @auth
                    <th></th>
                    <th></th>
                @endauth
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>


                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
