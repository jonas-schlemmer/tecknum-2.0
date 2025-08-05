@extends('layout')

@section('title', 'Editar Filme')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            color: #1d4e89;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        input[type="text"],
        input[type="number"] {
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            width: 100%;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            gap: 1rem;
        }

        .buttons button,
        .buttons a {
            flex: 1;
            padding: 0.75rem;
            background-color: #1d4e89;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .buttons a {
            background-color: #1d4e89;
        }

        .buttons button:hover,
        .buttons a:hover {
            background-color: #163f6d;
        }
    </style>

    <div class="container">
        <h1>Editar Filme</h1>

        <form action="{{ route('filmes.update', $filme->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" id="titulo" name="titulo" placeholder="Título"
                   value="{{ old('titulo', $filme->titulo) }}" required />

            <input type="text" id="descricao" name="descricao" placeholder="Descrição"
                   value="{{ old('descricao', $filme->descricao) }}" required />

            <input type="text" id="diretor" name="diretor" placeholder="Diretor"
                   value="{{ old('diretor', $filme->diretor) }}" required />

            <input type="text" id="genero" name="genero" placeholder="Gênero"
                   value="{{ old('genero', $filme->genero) }}" required />

            <input type="number" id="ano" name="ano" placeholder="Ano"
                   value="{{ old('ano', $filme->ano) }}" required />

            <input type="text" id="duracao" name="duracao" placeholder="Duração"
                   value="{{ old('duracao', $filme->duracao) }}" required />

            <input type="number" id="nota" name="nota" placeholder="Nota"
                   step="0.1" min="0" max="10" value="{{ old('nota', $filme->nota) }}" required />

            <div class="buttons">
                <button type="submit">Salvar</button>
                <a href="{{ route('filmes.index') }}">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
