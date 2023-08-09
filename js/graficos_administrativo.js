document.addEventListener('DOMContentLoaded', function () {
    fetch('get_estatisticas_mes.php')
        .then(response => response.json())
        .then(data => {
            var mesAnterior = [data.mesAnterior.dadosUsuarios.qtdUsuarios, data.mesAnterior.dadosInscricoes.qtdInscritos, data.mesAnterior.dadosInscricoes.qtdConcluidos, data.mesAnterior.dadosInscricoes.qtdCertificados];
            dashboard2(data.atual, mesAnterior);
            var qtdUsuariosNoUltimoMes = data.atual.dadosInscricoes.qtdInscritos - data.mesAnterior.dadosInscricoes.qtdInscritos;
            criarTotalDeHoras(data.atual.dadosCurso.totalHorasDeCursosEmAndamento, data.atual.dadosCurso.totalHorasDeCursos);
            criarAlunosMatriculadosNosUltimos30dias(qtdUsuariosNoUltimoMes, data.atual.dadosInscricoes.qtdInscritos);
            criarAlunosQueFinalizaramOsCursos(data.atual.dadosInscricoes.qtdConcluidos - data.mesAnterior.dadosInscricoes.qtdConcluidos, qtdUsuariosNoUltimoMes);
            criarIniaciaramOsCursos(data.atual.dadosInscricoes.qtdEmAndamento - data.mesAnterior.dadosInscricoes.qtdEmAndamento, data.atual.dadosInscricoes.qtdConcluidos - data.mesAnterior.dadosInscricoes.qtdConcluidos, qtdUsuariosNoUltimoMes);
        })
        .catch(error => console.error('Erro ao obter os dados da API:', error));
    fetch('get_cursos_em_andamento.php')
        .then(response => response.json())
        .then(data => {
            createRankingTable(data.resultados);
            chartEngajamentoCursosEmAndamento(data.resultados);

        })
        .catch(error => console.error('Erro ao obter os dados da API:', error));
    fetch('get_concluidos.php')
        .then(response => response.json())
        .then(data => {
            createConcluidos(data.resultados)
        })
        .catch(error => console.error('Erro ao obter os dados da API:', error));
    chamadaFinalizados("inicio");
    var xhr = new XMLHttpRequest();
    xhr.open('GET', `get_cursos_em_andamento_paginado.php?quantidade=10&pagina=1`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var resposta = xhr.responseText;
            resposta = JSON.parse(resposta);
            atualizarQuantidadePaginasCursosEmAndamento(resposta.quantidadeResultados, 10, 1);
            createTableFromJSON(resposta.cursosEmAndamento);
        }
    };
    xhr.send();
    chamadaConcluidos(5, 1, "");
});

function dashboard2(data, mesAnterior) {
    function calculatePercentageDiff(currentValue, previousValue) {
        if (previousValue === 0) {
            return "0%";
        }

        const diffPercentage = ((currentValue - previousValue) / previousValue) * 100;
        return diffPercentage.toFixed(0) + "%";
    }

    const usuariosMatriculados = document.getElementById("usuariosMatriculados");
    usuariosMatriculados.textContent = data.dadosUsuarios.qtdUsuarios;
    if (data.dadosUsuarios.qtdUsuarios >= mesAnterior[0]) {
        usuariosMatriculados.parentNode.classList.add("ativo");
        usuariosMatriculados.parentNode.nextElementSibling.classList.add("ativo");
        usuariosMatriculados.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(data.dadosUsuarios.qtdUsuarios, mesAnterior[0]);
        usuariosMatriculados.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
    } else {
        usuariosMatriculados.parentNode.classList.remove("ativo");
        usuariosMatriculados.parentNode.nextElementSibling.classList.remove("ativo");
        usuariosMatriculados.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(mesAnterior[0], data.dadosUsuarios.qtdUsuarios);
        usuariosMatriculados.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
    }

    const usuariosInscritos = document.getElementById("usuariosInscritos");
    usuariosInscritos.textContent = data.dadosInscricoes.qtdInscritos;
    if (data.dadosInscricoes.qtdInscritos >= mesAnterior[1]) {
        usuariosInscritos.parentNode.classList.add("ativo");
        usuariosInscritos.parentNode.nextElementSibling.classList.add("ativo");
        usuariosInscritos.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(data.dadosInscricoes.qtdInscritos, mesAnterior[1]);
        usuariosInscritos.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
    } else {
        usuariosInscritos.parentNode.classList.remove("ativo");
        usuariosInscritos.parentNode.nextElementSibling.classList.remove("ativo");
        usuariosInscritos.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(mesAnterior[1], data.dadosInscricoes.qtdInscritos);
        usuariosInscritos.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
    }

    const conclusoesDeCurso = document.getElementById("conclusoesDeCurso");
    conclusoesDeCurso.textContent = data.dadosInscricoes.qtdConcluidos;
    if (data.dadosInscricoes.qtdConcluidos >= mesAnterior[2]) {
        conclusoesDeCurso.parentNode.classList.add("ativo");
        conclusoesDeCurso.parentNode.nextElementSibling.classList.add("ativo");
        conclusoesDeCurso.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(data.dadosInscricoes.qtdConcluidos, mesAnterior[2]);
        conclusoesDeCurso.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
    } else {
        conclusoesDeCurso.parentNode.classList.remove("ativo");
        conclusoesDeCurso.parentNode.nextElementSibling.classList.remove("ativo");
        conclusoesDeCurso.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(mesAnterior[2], data.dadosInscricoes.qtdConcluidos);
        conclusoesDeCurso.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
    }

    const certificadosEmitidos = document.getElementById("certificadosEmitidos");
    certificadosEmitidos.textContent = data.dadosInscricoes.qtdCertificados;
    if (data.dadosInscricoes.qtdCertificados >= mesAnterior[3]
        ) {
        certificadosEmitidos.parentNode.classList.add("ativo");
        certificadosEmitidos.parentNode.nextElementSibling.classList.add("ativo");
        certificadosEmitidos.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(data.dadosInscricoes.qtdCertificados, mesAnterior[3]);
        certificadosEmitidos.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
    } else {
        certificadosEmitidos.parentNode.classList.remove("ativo");
        certificadosEmitidos.parentNode.nextElementSibling.classList.remove("ativo");
        certificadosEmitidos.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
        const diffPercentage = calculatePercentageDiff(mesAnterior[3], data.dadosInscricoes.qtdCertificados);
        certificadosEmitidos.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
    }
}

function limparTable() {
    var tableBody = document.getElementById('tabelaCursosEmAndamento');

    // Limpa o corpo da tabela
    tableBody.innerHTML = '';
}

function createTableFromJSON(json) {
    var tableBody = document.getElementById('tabelaCursosEmAndamento');

    // Limpa o corpo da tabela
    tableBody.innerHTML = '';

    // Itera sobre os resultados do JSON e cria as linhas da tabela
    json.forEach(function (curso) {
        var row = document.createElement('tr');

        var titleCell = document.createElement('td');
        titleCell.className = 'title_tabela';
        titleCell.textContent = curso.fullname.toUpperCase();
        row.appendChild(titleCell);

        var categoriaCell = document.createElement('td');
        categoriaCell.textContent = curso.categoria;
        row.appendChild(categoriaCell);

        var matriculadosCell = document.createElement('td');
        matriculadosCell.className = 'area_matriculado_tabela';
        matriculadosCell.textContent = curso.qtdMatriculados;
        row.appendChild(matriculadosCell);

        var concluidosCell = document.createElement('td');
        concluidosCell.textContent = curso.qtdConcluidos;
        row.appendChild(concluidosCell);

        var nuncaAcessaramCell = document.createElement('td');
        nuncaAcessaramCell.textContent = curso.qtdNuncaAcessaram;
        row.appendChild(nuncaAcessaramCell);

        var emAndamentoCell = document.createElement('td');
        emAndamentoCell.textContent = curso.qtdEmAndamento;
        row.appendChild(emAndamentoCell);

        var arrumarCell1 = document.createElement('td');
        arrumarCell1.textContent = curso.qtdCertificados;
        row.appendChild(arrumarCell1);

        tableBody.appendChild(row);
    });
}

var campoPesquisaEmAndamento = document.getElementById('curso_em_andamento');


function chamadaCursosEmAndamento(quantidade, pagina, pesquisa) {
    const input = pesquisa.replace(/\s+/g, '_');

    if (input == '') {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `get_cursos_em_andamento_paginado.php?quantidade=${quantidade}&pagina=${pagina}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var resposta = xhr.responseText;
                resposta = JSON.parse(resposta);
                atualizarQuantidadePaginasCursosEmAndamento(resposta.quantidadeResultados, quantidade, pagina);
                limparTable();
                createTableFromJSON(resposta.cursosEmAndamento);
            }
        };
        xhr.send();
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('GET', `get_cursos_em_andamento_by_name.php?name=${input}&quantidade=${quantidade}&pagina=${pagina}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var resposta = xhr.responseText;
            resposta = JSON.parse(resposta);
            atualizarQuantidadePaginasCursosEmAndamento(resposta.quantidadeResultados, quantidade, pagina);
            limparTable();
            createTableFromJSON(resposta.cursosEmAndamento);
        }
    };


    xhr.send();
}

function atualizarQuantidadePaginasCursosEmAndamento(quantidadeResultados, quantidade, pagina) {
    var dropdown = document.getElementById('dropdown-pagina-cursos');
    var dropdownList = document.getElementById('lista-quantidade-paginas');
    var quantidadePaginas = 1;
    // Verifica se a página é válida, caso contrário, define como 1

    // Limpa as opções existentes
    dropdownList.innerHTML = '';

    // Calcula o número total de páginas
    var numPaginas = Math.ceil(quantidadeResultados / quantidade);

    // Atualiza o valor do dropdown para a página atual
    dropdown.textContent = pagina.toString();

    // Cria as opções do dropdown com base no número de páginas
    for (var i = 1; i <= numPaginas; i++) {
        var option = document.createElement('li');
        option.textContent = i.toString();

        // Adiciona uma classe ou estilo para indicar a página atual selecionada
        quantidadePaginas = i;

        option.onclick = function () {
            selectQuantidadePaginaCursosEmAndamento(this);
        };
        dropdownList.appendChild(option);
    }
    if (pagina > quantidadePaginas) {
        dropdown.innerHTML = '1';
        atualizarCursosEmAndamento();
    }
}


function paginarCursos(cursos, quantidade, pagina) {
    const indiceInicial = (pagina - 1) * quantidade;
    const indiceFinal = indiceInicial + quantidade;
    return cursos.slice(indiceInicial, indiceFinal);
}

function atualizarCursosEmAndamento() {
    const quantidade = parseInt(document.getElementById('dropdown-quantidade-cursos-em-andamento').textContent);
    const pagina = parseInt(document.getElementById('dropdown-pagina-cursos').textContent);
    const pesquisa = campoPesquisaEmAndamento.value;
    chamadaCursosEmAndamento(quantidade, pagina, pesquisa);
}

// Adicione eventos aos elementos HTML
campoPesquisaEmAndamento.addEventListener('input', atualizarCursosEmAndamento);

const dropdownQuantidadeCursos = document.getElementById('dropdown-quantidade-cursos-em-andamento');
dropdownQuantidadeCursos.addEventListener('click', atualizarCursosEmAndamento);

const dropdownPaginaCursos = document.getElementById('dropdown-pagina-cursos');
dropdownPaginaCursos.addEventListener('click', atualizarCursosEmAndamento);


function selectQuantidadeCursosEmAndamento(option) {
    const dropdownToggle = document.getElementById('dropdown-quantidade-cursos-em-andamento');
    const selectedOption = option.textContent;

    dropdownToggle.innerHTML = `${(selectedOption)}`;
    atualizarCursosEmAndamento(); // Atualizar cursos quando a quantidade for alterada

}

function selectQuantidadePaginaCursosEmAndamento(option) {
    const dropdownToggle = document.getElementById('dropdown-pagina-cursos');
    const selectedOption = option.textContent;

    dropdownToggle.innerHTML = `${(selectedOption)}`;
    atualizarCursosEmAndamento(); // Atualizar cursos quando a quantidade for alterada

}

// Selecionar o campo de pesquisa
var campoPesquisa = document.getElementById('curso_finalizado');

// Adicionar o event listener ao evento 'input'
campoPesquisa.addEventListener('input', fazerPesquisa);

function fazerPesquisa(event) {

    event.preventDefault(); // Impedir o envio do formulário

    var input = campoPesquisa.value;

    chamadaFinalizados(input);

}

function chamadaFinalizados(input) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_cursos_finalizados.php?name=' + input, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var resposta = xhr.responseText;
            resposta = JSON.parse(resposta);
            var resultado = resposta.cursosFinalizados[0];
            areaConclusao(resultado);
        }
    };

    xhr.send();
}

function areaConclusao(json) {

    // Preencher os campos no HTML com os dados do JSON
    document.getElementById('categoria').textContent = `Categoria: ${json.categoria}`;
    document.getElementById('subCategoria').textContent = json.fullname;
    document.getElementById('dataInicio').textContent = `${formatDate(json.dataInicio)}`;
    document.getElementById('dataFinal').textContent = `${formatDate(json.dataFinal)}`;
    document.getElementById('qtdNuncaAcessaram').textContent = json.qtdNuncaAcessaram;
    document.getElementById('qtdConcluidos').textContent = json.qtdConcluidos;
    document.getElementById('qtdMatriculados').textContent = json.qtdMatriculados;
    document.getElementById('qtdCertificados').textContent = json.qtdCertificados;
    document.getElementById('mediaProgresso').textContent = `${json.mediaProgresso}%`;
}

function createConcluidos(json) {
    var tableBody = document.getElementById('tabelaConcluidos');

    // Limpa o corpo da tabela
    tableBody.innerHTML = '';

    json.forEach(function (conclusao) {
        var row = document.createElement('tr');

        var nomeCurso = document.createElement('td');
        nomeCurso.textContent = conclusao.curso;
        row.appendChild(nomeCurso);

        var nomeUsuario = document.createElement('td');
        nomeUsuario.textContent = conclusao.nome;
        row.appendChild(nomeUsuario);

        var dataConclusao = document.createElement('td');
        dataConclusao.textContent = formatDate(conclusao.dataConclusao);
        row.appendChild(dataConclusao);

        var dataInicio = document.createElement('td');
        dataInicio.textContent = formatDate(conclusao.dataInicio);
        row.appendChild(dataInicio);

        var categoria = document.createElement('td');
        categoria.textContent = conclusao.categoria;
        row.appendChild(categoria);

        tableBody.appendChild(row);
    });
}

var campoPesquisaConcluido = document.getElementById('usuario_concluido');


function chamadaConcluidos(quantidade, pagina, pesquisa) {

    input = pesquisa.replace(/\s+/g, '_');

    if (input == "") {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `get_concluidos.php?quantidade=${quantidade}&pagina=${pagina}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var resposta = xhr.responseText;
                resposta = JSON.parse(resposta);
                atualizarQuantidadePaginasConclusoes(resposta.quantidadeResultados, quantidade, pagina);
                createConcluidos(resposta.usersConcluidos);
            }
        };
        xhr.send();

        return;
    }


    var xhr = new XMLHttpRequest();
    xhr.open('GET', `get_concluidos_by_name.php?name=${input}&quantidade=${quantidade}&pagina=${pagina}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var resposta = xhr.responseText;
            resposta = JSON.parse(resposta);
            atualizarQuantidadePaginasConclusoes(resposta.quantidadeResultados, quantidade, pagina);
            createConcluidos(resposta.usersConcluidos);

        }
    };

    xhr.send();
}

function atualizarQuantidadePaginasConclusoes(quantidadeResultados, quantidade, pagina) {
    var dropdown = document.getElementById('dropdown-pagina-conclusoes');
    var dropdownList = document.getElementById('lista-quantidade-paginas-conclusoes');
    var quantidadePaginas = 1;
    // Verifica se a página é válida, caso contrário, define como 1

    // Limpa as opções existentes
    dropdownList.innerHTML = '';

    // Calcula o número total de páginas
    var numPaginas = Math.ceil(quantidadeResultados / quantidade);

    // Atualiza o valor do dropdown para a página atual
    dropdown.textContent = pagina.toString();

    // Cria as opções do dropdown com base no número de páginas
    for (var i = 1; i <= numPaginas; i++) {
        var option = document.createElement('li');
        option.textContent = i.toString();

        // Adiciona uma classe ou estilo para indicar a página atual selecionada
        quantidadePaginas = i;

        option.onclick = function () {
            selectQuantidadePaginaCursosEmAndamento(this);
        };
        dropdownList.appendChild(option);
    }
    if (pagina > quantidadePaginas) {
        dropdown.innerHTML = '1';
        atualizarConclusoes();
    }
}


function paginarConclusoes(cursos, quantidade, pagina) {
    const indiceInicial = (pagina - 1) * quantidade;
    const indiceFinal = indiceInicial + quantidade;
    return cursos.slice(indiceInicial, indiceFinal);
}

function atualizarConclusoes() {
    const quantidade = parseInt(document.getElementById('dropdown-quantidade-conclusoes').textContent);
    const pagina = parseInt(document.getElementById('dropdown-pagina-conclusoes').textContent);
    const pesquisa = campoPesquisaConcluido.value;
    chamadaConcluidos(quantidade, pagina, pesquisa);
}

// Adicione eventos aos elementos HTML
campoPesquisaConcluido.addEventListener('input', atualizarConclusoes);

const dropdownQuantidadeConclusoes = document.getElementById('dropdown-quantidade-conclusoes');
dropdownQuantidadeCursos.addEventListener('click', atualizarConclusoes);

const dropdownPaginaConclusoes = document.getElementById('dropdown-pagina-conclusoes');
dropdownPaginaCursos.addEventListener('click', atualizarConclusoes);

function selectQuantidadeConclusao(option) {
    const dropdownToggle = document.getElementById('dropdown-quantidade-conclusoes');
    const selectedOption = option.textContent;

    dropdownToggle.innerHTML = `${(selectedOption)}`;

    atualizarConclusoes();
}

function selectQuantidadePaginaConclusao(option) {
    const dropdownToggle = document.getElementById('dropdown-pagina-conclusoes');
    const selectedOption = option.textContent;

    dropdownToggle.innerHTML = `${(selectedOption)}`;
    atualizarConclusoes();
}

document.getElementById('select_ranking').addEventListener('keyup', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        pesquisarCurso();
    }
});

function pesquisarCurso() {
    var inputCurso = document.getElementById('select_ranking').value.trim().toLowerCase();

    var tableRows = document.querySelectorAll('#table_populares tbody tr');

    for (var i = 0; i < tableRows.length; i++) {
        var curso = tableRows[i].querySelector('td:nth-child(2)').textContent.trim().toLowerCase();

        if (curso.includes(inputCurso)) {
            tableRows[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }
    }
}

function createRankingTable(json) {


    // Ordenar o JSON com base na quantidade de matrículas em ordem decrescente
    const sortedJson = json.sort((a, b) => b.qtdMatriculados - a.qtdMatriculados);

    const tableBody = document.getElementById("rankingCursosEmAndamento");

    // Limpar o conteúdo existente na tabela
    tableBody.innerHTML = "";

    // Criar as linhas da tabela com base no JSON ordenado
    for (let i = 0; i < sortedJson.length; i++) {
        const curso = sortedJson[i];

        const row = document.createElement("tr");

        const trofeuCell = document.createElement("td");
        trofeuCell.className = "trofeu";

        const h2 = document.createElement("h2");
        h2.textContent = `${i + 1}º`;

        const img = document.createElement("img");
        img.src = i < 3 ? `img/trofeu_${i + 1}.svg` : "img/trofeu_nao_podio.svg";
        img.alt = "";

        trofeuCell.appendChild(h2);
        trofeuCell.appendChild(img);

        const cursoCell = document.createElement("td");
        cursoCell.textContent = curso.fullname.toUpperCase();

        const matriculadosCell = document.createElement("td");
        matriculadosCell.textContent = curso.qtdMatriculados;

        row.appendChild(trofeuCell);
        row.appendChild(cursoCell);
        row.appendChild(matriculadosCell);

        tableBody.appendChild(row);
    }
}

var table = document.getElementById("table_usuarios_concluidos");
var rows = Array.from(table.getElementsByTagName("tr"));
var sortOrder = {
    nome_curso: 0,
    nome_aluno: 0,
    data_conclusao: 0,
    data_inscricao: 0,
    categoria: 0
};

function sortTable(columnIndex, columnName) {
    var tableBody = document.getElementById("tabelaConcluidos");
    var headerCell = table.rows[0].cells[columnIndex];
    var headerText = columnName.toLowerCase();
    var ascending = !headerCell.classList.contains("asc");

    var sortedRows = Array.from(tableBody.rows).slice(0); // Cria uma cópia das linhas

    sortedRows.sort(function (a, b) {
        var cellA = a.cells[columnIndex].textContent.toLowerCase().trim();
        var cellB = b.cells[columnIndex].textContent.toLowerCase().trim();

        if (cellA < cellB) {
            return ascending ? -1 : 1;
        } else if (cellA > cellB) {
            return ascending ? 1 : -1;
        } else {
            return 0;
        }
    });

    for (var i = 0; i < sortedRows.length; i++) {
        tableBody.appendChild(sortedRows[i]);
    }

    // Remove as classes de ordenação de todas as colunas
    var headerCells = table.rows[0].cells;
    for (var i = 0; i < headerCells.length; i++) {
        headerCells[i].classList.remove("asc", "desc");
    }

    // Adiciona a classe de ordenação correta na coluna atual
    headerCell.classList.toggle("asc", ascending);
    headerCell.classList.toggle("desc", !ascending);
}


function reordenarTabela() {
    var tbody = table.getElementsByTagName("tbody")[0];

    for (var i = 0; i < rows.length; i++) {
        tbody.appendChild(rows[i]);
    }
}

const cursosDropdown = document.getElementById('cursos'); // Elemento onde os cursos serão adicionados

function formatDate(timestamp) {
    const date = new Date(timestamp * 1000);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

function selectOption(option) {
    const dropdownToggle = document.getElementById('nomeDoCurso');
    const selectedOption = option.textContent;

    dropdownToggle.innerHTML = `${formatarTexto(selectedOption)}`;
    const formattedOption = selectedOption.replace(/\s+/g, '_');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_cursos_finalizados.php?name=' + formattedOption, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var resposta = xhr.responseText;
            resposta = JSON.parse(resposta);
            var resultado = resposta.cursosFinalizados[0];
            areaConclusao(resultado);
        }
    };

    xhr.send();

    // Restaurar o estado original do dropdown
    const dropdownContainer = document.getElementById('dropdown-cursos');
    dropdownContainer.classList.remove('active');
}


function toggleDropdown(element) {
    var dropdownMenu = element.querySelector('.area_drop_down_conclusao');
    dropdownMenu.classList.toggle('openDropdown');
}

function toggleDropdownQuantidade(element) {
    var dropdownMenu = element.querySelector('.area_drop_down_quantidade');
    dropdownMenu.classList.toggle('openDropdown');
}

function chartEngajamentoCursosEmAndamento(json) {
    const sortedData = json.sort((a, b) => b.qtdMatriculados - a.qtdMatriculados);
    const top5 = sortedData.slice(0, 5);

    const labels = top5.map(item => item.fullname.toUpperCase());
    const data = top5.map(item => item.qtdMatriculados);

    const data5 = {
        labels: labels,
        datasets: [{
            axis: 'y',
            label: 'Cursos com mais inscrições',
            data: data,
            fill: false,
            backgroundColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderWidth: 1,
            borderRadius: 100,
            maxBarThickness: 15,
            minBarLength: 10
        }]
    };

    var chart5 = document.getElementsByClassName('bar-chart-adm-1');
    var chartGraph2 = new Chart(chart5, {
        type: 'bar',
        data: data5,
        options: {
            indexAxis: 'y',
        }
    });
}

function criarAlunosMatriculadosNosUltimos30dias(matriculas, totalMatriculas) {

    const title = document.getElementById('matriculados30dias');
    title.innerHTML = `${matriculas}/${totalMatriculas}`;
    const data = {
        /* labels: [
             'Alunos'
         ],
             */
        datasets: [{
            label: '',
            data: [matriculas, totalMatriculas - matriculas],
            backgroundColor: [
                '#F76818',
                '#FFE7D6'
            ],
            hoverOffset: 4
        }],

    };

    var chart2 = document.getElementsByClassName('doughnut-chart');

    var chartGraph2 = new Chart(chart2, {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }

    });
}

function criarTotalDeHoras(horasCursosEmAndamento, totalDeHorasDeCursos) {

    const title = document.getElementById('horasAssistidasNosUltimos30dias');
    title.innerHTML = `${horasCursosEmAndamento}/${totalDeHorasDeCursos}`;


    const data = {
        /* labels: [
             'Alunos'
         ],
             */
        datasets: [{
            label: '',
            data: [horasCursosEmAndamento, totalDeHorasDeCursos - horasCursosEmAndamento],
            backgroundColor: [
                'rgba(247, 104, 24, 1)',
                'rgba(90, 92, 81, 1)'
            ],
            hoverOffset: 4
        }],

    };

    var chart3 = document.getElementsByClassName('doughnut-chart_2');

    var chartGraph2 = new Chart(chart3, {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
}

function criarIniaciaramOsCursos(emAndamento, aprovados, quantidadeDeInscricoes) {
    emAndamento = Math.abs(emAndamento);
    aprovados = Math.abs(aprovados);
    var inscritosQueIniciaram = emAndamento + aprovados;
    const title = document.getElementById('alunosIniciaram30dias');
    title.innerHTML = `${inscritosQueIniciaram}/${quantidadeDeInscricoes}`;


    const data = {
        /* labels: [
             'Alunos'
         ],
             */
        datasets: [{
            label: '',
            data: [inscritosQueIniciaram, quantidadeDeInscricoes - inscritosQueIniciaram],
            backgroundColor: [
                '#06BDDD',
                '#FD66CB'
            ],
            hoverOffset: 4
        }],

    };

    var chart4 = document.getElementsByClassName('doughnut-chart_3');

    var chartGraph2 = new Chart(chart4, {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }

    });
}

function criarAlunosQueFinalizaramOsCursos(concluidos, quantidadeDeInscricoes) {
    concluidos = Math.abs(concluidos);
    const title = document.getElementById('alunosFinalizaram30dias');
    title.innerHTML = `${concluidos}/${quantidadeDeInscricoes}`;

    const data = {
        /* labels: [
             'Alunos'
         ],
             */
        datasets: [{
            label: '',
            data: [concluidos, quantidadeDeInscricoes - concluidos],
            backgroundColor: [
                'rgba(4, 191, 218, 1)',
                'rgba(252, 192, 32, 1)'
            ],
            hoverOffset: 4
        }],

    };

    var chart5 = document.getElementsByClassName('doughnut-chart_4');

    var chartGraph2 = new Chart(chart5, {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }


    });
}