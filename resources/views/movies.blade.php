@extends('layout')

@section('title', 'tecknum | Recomendados')

@section('content')
<link rel="stylesheet" href="{{ asset('css/movies.css') }}">

<header>
    <div id="logo">
        <img src="{{ asset('images/logo.png') }}" alt="tecknum logo">
        <p>Recomendados</p>
    </div>

    <div class="search-bar">
        <input type="text" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Pesquisar"/>
    </div>

    <nav>
        <ul>
            <li id="usuarioLogado"></li>
            <li><a href="{{ url('/') }}">Sair</a></li>
        </ul>
    </nav>
</header>

<main>
    <section>
        <table>
            <thead id="barra-thead">
                <tr>
                    <th>TÍTULO</th>
                    <th>DESCRIÇÃO</th>
                    <th>DIRETOR</th>
                    <th>GÊNERO</th>
                    <th>ANO</th>
                    <th>DURAÇÃO</th>
                    <th>NOTA</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody id="filmesTable">
                @foreach($filmes as $filme)
                <tr>
                    <td>{{ $filme->titulo }}</td>
                    <td>{{ $filme->descricao }}</td>
                    <td>{{ $filme->diretor }}</td>
                    <td>{{ $filme->genero }}</td>
                    <td>{{ $filme->ano }}</td>
                    <td>{{ $filme->duracao }}</td>
                    <td>{{ $filme->nota }}</td>
                    <td class="btn-option">
                        <a href="{{ route('filmes.edit', $filme->id) }}" class="btn-edit" title="Editar">✏️</a>
                        <form action="{{ route('filmes.destroy', $filme->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" title="Apagar" type="submit">❌</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</main>

<button id="botao-fixo">+</button>

<div id="modal-novo-item" class="modal">
    <div class="modal-conteudo">
        <h2 id="modalTitulo">Novo Filme</h2>

        <form id="formNovoFilme" action="{{ route('filmes.store') }}" method="POST">
            @csrf
            <input type="text" name="titulo" placeholder="Título" required />
            <input type="text" name="descricao" placeholder="Descrição" required />
            <input type="text" name="diretor" placeholder="Diretor" required />
            <input type="text" name="genero" placeholder="Gênero" required />
            <input type="number" name="ano" placeholder="Ano" required />
            <input type="text" name="duracao" placeholder="Duração (ex: 120 min)" required />
            <input type="number" name="nota" placeholder="Nota (ex: 8.5)" step="0.1" min="0" max="10" required />
            <div class="modal-botoes">
                <button type="submit">Salvar</button>
                <button type="button" id="cancelarModal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    const botaoFixo = document.getElementById('botao-fixo');
    const modal = document.getElementById('modal-novo-item');
    const btnCancelar = document.getElementById('cancelarModal');
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('filmesTable');

    botaoFixo.addEventListener('click', () => {
        modal.classList.add('show');
    });

    btnCancelar.addEventListener('click', () => {
        modal.classList.remove('show');
    });

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        const rows = tableBody.getElementsByTagName('tr');

        for (let row of rows) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        }
    });
</script>
@endsection
