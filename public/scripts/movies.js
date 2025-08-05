document.addEventListener("DOMContentLoaded", function () {
    const campoBusca = document.getElementById("campoBusca");
// const tbody = document.querySelector("table tbody");

campoBusca.addEventListener("focus", () => {
    campoBusca.placeholder = "";
});

campoBusca.addEventListener("blur", () => {
    campoBusca.placeholder = "Pesquisar";
});

    const botaoFixo = document.getElementById("botao-fixo");
    const modal = document.getElementById("modal-novo-item");
    const modalTitulo = document.getElementById("modalTitulo");
    const cancelar = document.getElementById("cancelarModal");
    const form = document.getElementById("formNovoFilme");
    const tbody = document.querySelector("table tbody");
    const mainSection = document.querySelector("main section");

    let editandoIndex = null;

    // Função para atualizar o estado da lista (mostrar/esconder tabela e mensagem)
    function atualizarEstadoLista() {
        const tabela = document.querySelector("table");
        const msgExistente = document.getElementById("msgSemFilmes");

        if (tbody.children.length === 0) {
            // Esconde a tabela
            tabela.style.display = "none";

            // Se mensagem não existe, cria
            if (!msgExistente) {
                const msg = document.createElement("p");
                msg.id = "msgSemFilmes";
                msg.textContent = "Nenhum filme cadastrado";
                msg.style.textAlign = "center";
                msg.style.fontSize = "1.5rem";
                msg.style.marginTop = "2rem";
                mainSection.appendChild(msg);
            }
        } else {
            // Se tem filmes, mostra tabela
            tabela.style.display = "table";

            // Remove mensagem se existir
            if (msgExistente) {
                msgExistente.remove();
            }
        }
    }

    // Abrir modal para novo filme
    botaoFixo.addEventListener("click", () => {
        editandoIndex = null;
        form.reset();
        modalTitulo.textContent = "Novo Filme";
        modal.style.display = "flex";
    });

    // Fechar modal
    cancelar.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Submeter formulário
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const dados = Array.from(form.elements).reduce((acc, el) => {
            if (el.name) acc[el.name] = el.value;
            return acc;
        }, {});

        if (editandoIndex !== null) {
            // Modo edição: atualizar linha
            const linha = tbody.children[editandoIndex];
            const celulas = linha.querySelectorAll("td");
            celulas[0].textContent = dados.titulo;
            celulas[1].textContent = dados.descricao;
            celulas[2].textContent = dados.diretor;
            celulas[3].textContent = dados.genero;
            celulas[4].textContent = dados.ano;
            celulas[5].textContent = dados.duracao;
            celulas[6].textContent = dados.nota;
        } else {
            // Modo novo: adicionar nova linha
            const novaLinha = document.createElement("tr");
            novaLinha.innerHTML = `
                <td>${dados.titulo}</td>
                <td>${dados.descricao}</td>
                <td>${dados.diretor}</td>
                <td>${dados.genero}</td>
                <td>${dados.ano}</td>
                <td>${dados.duracao}</td>
                <td>${dados.nota}</td>
                <td class="btn-option">
                    <button class="btn-edit" title="Editar">
                        <i class="em em-pencil2" style="transform: scaleX(-1);"></i>
                    </button>
                    <button class="btn-delete" title="Apagar">
                        <i class="em em-x" style="transform: scaleX(-1);"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(novaLinha);

            // Se tabela estava escondida, mostra de novo e remove mensagem
            atualizarEstadoLista();
        }

        // Atualiza eventos e fecha modal
        adicionarEventosEdicao();
        modal.style.display = "none";
        form.reset();
    });

    // Clicar fora do modal para fechar
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Adicionar eventos aos botões de editar e apagar
    function adicionarEventosEdicao() {
        // Editar
        document.querySelectorAll(".btn-edit").forEach((btn, index) => {
            btn.onclick = () => {
                editandoIndex = index;

                const linha = tbody.children[index];
                const celulas = linha.querySelectorAll("td");

                form.titulo.value = celulas[0].textContent;
                form.descricao.value = celulas[1].textContent;
                form.diretor.value = celulas[2].textContent;
                form.genero.value = celulas[3].textContent;
                form.ano.value = celulas[4].textContent;
                form.duracao.value = celulas[5].textContent;
                form.nota.value = celulas[6].textContent;

                modalTitulo.textContent = "Editar Filme";
                modal.style.display = "flex";
            };
        });

        // Apagar
        document.querySelectorAll(".btn-delete").forEach((btn, index) => {
            btn.onclick = () => {
                const linha = tbody.children[index];
                const titulo = linha.children[0].textContent;

                const confirmar = confirm(`Deseja apagar o filme "${titulo}"?`);
                if (confirmar) {
                    tbody.removeChild(linha);
                    atualizarEstadoLista();
                    // Reaplica eventos para os botões, já que índice mudou
                    adicionarEventosEdicao();
                }
            };
        });
    }

    // Inicializa eventos e estado da lista
    adicionarEventosEdicao();
    atualizarEstadoLista();

    // Pega parâmetros da URL para mostrar usuário logado
    const params = new URLSearchParams(window.location.search);
    const nome = params.get('name'); // 'name' é o nome do input do formulário

    if(nome) {
        const liUsuario = document.getElementById('usuarioLogado');
        // liUsuario.textContent = `Usuário logado:   ${nome}`;
        // liUsuario.style.fontWeight = 'bold';
        // liUsuario.style.padding = '0 1rem';
        // liUsuario.style.alignSelf = 'center'; // para alinhar verticalmente no menu

        liUsuario.textContent = `Olá ${nome}`; // Note que entre "logado" e ":" tem um espaço não quebrável (alt+0160)
        liUsuario.style.margin = '1rem';
liUsuario.style.fontWeight = 'bold';
liUsuario.style.padding = '0 1rem';

    }

});
