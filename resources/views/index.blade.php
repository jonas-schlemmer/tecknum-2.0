

@extends('layout')

@section('title', 'tecknum')

@section('content')
    <main>
        <a href="{{ url('/') }}">
            <div id="logo">
                <img src="{{ asset('images/logo.png') }}" alt="tecknum logo">
                <p>tecknum</p>
            </div>
        </a>

        <form action="{{ url('/filmes') }}" method="GET">
            <label for="name">Usuário</label><br>
            <input type="text" id="name" name="name" required>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Acessar">
        </form>

        <p id="no-account">Não possui uma conta?
            <a href="{{ url('/register') }}">
                <b>Cadastre-se</b>
            </a>
        </p>
    </main>
@endsection
