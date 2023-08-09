document.addEventListener('DOMContentLoaded', function () {
    fetch('get_categorias.php')
        .then(response => response.json())
        .then(data => {
            createListItems(data);
        })
        .catch(error => console.log('erro ao obter os dados da API:', error));

    pegarFiltros();
});

document.getElementById('select_curso').addEventListener('keyup', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        pesquisarCurso();
    }
});

function pesquisarCurso() {
    var inputCurso = document.getElementById('select_curso').value.trim().toLowerCase();

    var cursos = document.querySelectorAll('#cursos .curso-item');

    for (var i = 0; i < cursos.length; i++) {
        var curso = cursos[i].textContent.trim().toLowerCase();

        if (curso.includes(inputCurso)) {
            cursos[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }
    }
}

document.getElementById('select_categoria').addEventListener('keyup', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        pesquisarCategoria();
    }
});

function pesquisarCategoria() {
    var inputCategoria = document.getElementById('select_categoria').value.trim().toLowerCase();

    var categorias = document.querySelectorAll('#categorias .categoria-item');

    for (var i = 0; i < categorias.length; i++) {
        var categoria = categorias[i].textContent.trim().toLowerCase();

        if (categoria.includes(inputCategoria)) {
            categorias[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }
    }
}

function chamaAlunosPorPeriodo(periodo_inicial, periodo_final) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', `get_alunos_by_periodo.php?periodo_inicial=${periodo_inicial}&periodo_final=${periodo_final}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var resposta = xhr.responseText;
            resposta = JSON.parse(resposta);
            graficosAlunosPorPeriodo(resposta);
        }
    };
    xhr.send();
    return;
}

function graficosAlunosPorPeriodo(data) {
    const periodoInicial = data.periodo_inicial;
    const periodoFinal = data.periodo_final;
    cadastrosPorEstado(
        diferencaEntrePropriedades(periodoInicial.dadosUsuarios.estado, periodoFinal.dadosUsuarios.estado));
    cadastrosPorRegiao(ordenarPorRegiao(
        diferencaEntrePropriedades(periodoInicial.dadosUsuarios.estado, periodoFinal.dadosUsuarios.estado)));
    chartIdade(
        periodoFinal.dadosUsuarios.mediaIdadesPorPerfil);
    donutPorDeficiencias(
        diferencaEntrePropriedades(periodoInicial.dadosUsuarios.deficiencia, periodoFinal.dadosUsuarios.deficiencia));
    donutPorGeneros(
        diferencaEntrePropriedades(periodoInicial.dadosUsuarios.genero, periodoFinal.dadosUsuarios.genero));
    porEscolaridade(
        diferencaEntrePropriedades(periodoInicial.dadosUsuarios.escolaridade, periodoFinal.dadosUsuarios.escolaridade));
}

function createListItems(data) {
    const categoriasContainer = document.getElementById("categorias");
    const cursosContainer = document.getElementById("cursos");

    data.categorias.forEach((categoria) => {
        for (const nomeCategoria in categoria) {
            const categoriaLI = document.createElement("li");
            const categoriaLabel = document.createElement("label");
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.onclick = function () {
                toggleCheckbox(this);
                pegarFiltros();
                atualizarCursosPorCategoria();
            };

            categoriaLabel.appendChild(checkbox);
            categoriaLabel.appendChild(document.createTextNode(nomeCategoria));
            categoriaLI.appendChild(categoriaLabel);
            categoriasContainer.appendChild(categoriaLI);
            categoriaLI.classList.add("categoria-item"); // Add class "categoria-item"

            const cursos = categoria[nomeCategoria];
            if (cursos.length > 0) {
                cursos.forEach((curso) => {
                    const cursoLI = document.createElement("li");
                    const cursoLabel = document.createElement("label");
                    const cursoCheckbox = document.createElement("input");
                    cursoCheckbox.type = "checkbox";
                    cursoCheckbox.onclick = function () {
                        toggleCheckbox(this);
                        pegarFiltros();
                    };
                    cursoLabel.appendChild(cursoCheckbox);
                    cursoLabel.appendChild(document.createTextNode(curso));
                    cursoLI.appendChild(cursoLabel);
                    cursosContainer.appendChild(cursoLI);
                    cursoLI.classList.add("curso-item"); // Add class "curso-item" to cursos
                });
            }
        }
    });
}

function atualizarCursosPorCategoria() {
    var cursoItems = document.querySelectorAll('.curso-item');

    for (var i = 0; i < cursoItems.length; i++) {
        var cursoLabel = cursoItems[i].querySelector('label');
        var nomeCurso = cursoLabel.textContent.trim().toLowerCase();
        var checkbox = cursoLabel.querySelector('input');
        var pertenceCategoria = false;

        for (var categoria in cursosSelecionadosPorCategoria) {
            if (cursosSelecionadosPorCategoria[categoria].includes(nomeCurso)) {
                pertenceCategoria = true;
                break;
            }
        }

        checkbox.checked = pertenceCategoria;
    }
}

function atualizaInscricoes(jsonData) {

    fetch('get_filtros_por_inscricoes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
        .then(response => response.json())
        .then(data => {
            // Aqui você pode manipular a resposta (response) da sua API
            porInscricoes(data);
        })
        .catch(error => {
            // Trate qualquer erro que possa ocorrer durante a chamada da API
            console.error('Erro na chamada da API:', error);
        });

}

function atualizaDonutStatusALunos(jsonData) {

    fetch('get_filtros_aprovados.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
        .then(response => response.json())
        .then(data => {
            // Aqui você pode manipular a resposta (response) da sua API
            donutStatusAlunos(data);
        })
        .catch(error => {
            // Trate qualquer erro que possa ocorrer durante a chamada da API
            console.error('Erro na chamada da API:', error);
        });

}

function atualizaAlunos(jsonData) {
    fetch('get_filtros_usuarios.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
        .then(response => response.json())
        .then(data => {
            // Aqui você pode manipular a resposta (response) da sua API
            const h2Usuarios = document.getElementById("users");
            h2Usuarios.textContent = data.atual.qtdUsuarios;

            // Atualizar valor de matrículas
            const h2Matriculas = document.getElementById("matriculas");
            h2Matriculas.textContent = data.atual.qtdInscricoes;

            // Atualizar valor de acessos últimos 30 dias
            const h2Acessos = document.getElementById("acessosUltimoMes");
            h2Acessos.textContent = data.atual.qtdAcessosUltimoMes;

            // Atualizar valor de nunca acessaram plataforma
            const h2NuncaAcessaram = document.getElementById("nuncaAcessaram");
            h2NuncaAcessaram.textContent = data.atual.qtdNuncaAcessaram;

            const h2conclusoes = document.getElementById("conclusoes");
            h2conclusoes.textContent = data.atual.qtdAprovados;
            if (data.atual.qtdAprovados >= data.anterior.qtdAprovados) {
                h2conclusoes.parentNode.classList.add("ativo");
                h2conclusoes.parentNode.nextElementSibling.classList.add("ativo");
                h2conclusoes.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.atual.qtdAprovadoss, data.anterior.qtdAprovados);
                h2conclusoes.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
            } else {
                h2conclusoes.parentNode.classList.remove("ativo");
                h2conclusoes.parentNode.nextElementSibling.classList.remove("ativo");
                h2conclusoes.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.anterior.qtdAprovados, data.atual.qtdAprovados);
                h2conclusoes.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
            }

            const h2usuariosAtivos = document.getElementById("usuariosAtivos");
            h2usuariosAtivos.textContent = data.atual.qtdUsuariosAtivos;
            if (data.atual.qtdUsuariosAtivos >= data.anterior.qtdUsuariosAtivos) {
                h2usuariosAtivos.parentNode.classList.add("ativo");
                h2usuariosAtivos.parentNode.nextElementSibling.classList.add("ativo");
                h2usuariosAtivos.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.atual.qtdUsuariosAtivos, data.anterior.qtdUsuariosAtivos)
                h2usuariosAtivos.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
            } else {
                h2usuariosAtivos.parentNode.classList.remove("ativo");
                h2usuariosAtivos.parentNode.nextElementSibling.classList.remove("ativo");
                h2usuariosAtivos.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.anterior.qtdUsuariosAtivo, data.atual.qtdUsuariosAtivos);
                h2usuariosAtivos.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
            }
        })
        .catch(error => {
            // Trate qualquer erro que possa ocorrer durante a chamada da API
            console.error('Erro na chamada da API:', error);
        });
}

function calculatePercentageDiff(currentValue, previousValue) {
    if (previousValue === 0) {
        return "0%";
    }

    const diffPercentage = ((currentValue - previousValue) / previousValue) * 100;
    return diffPercentage.toFixed(0) + "%";
}

function atualizaCursos(jsonData) {
    fetch('get_filtros_cursos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
        .then(response => response.json())
        .then(data => {
            // Aqui você pode manipular a resposta (response) da sua API
            const h2Curso = document.getElementById("curso");
            h2Curso.textContent = data.atual.qtdCursos;

            const h2matriculasAbertas = document.getElementById("matriculasAbertas");
            h2matriculasAbertas.textContent = data.atual.qtdMatriculasAbertas;
            if (data.atual.qtdMatriculasAbertas >= data.anterior.qtdMatriculasAbertas) {
                h2matriculasAbertas.parentNode.classList.add("ativo");
                h2matriculasAbertas.parentNode.nextElementSibling.classList.add("ativo");
                h2matriculasAbertas.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.atual.qtdMatriculasAbertas, data.anterior.qtdMatriculasAbertas);
                h2matriculasAbertas.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
            } else {
                h2matriculasAbertas.parentNode.classList.remove("ativo");
                h2matriculasAbertas.parentNode.nextElementSibling.classList.remove("ativo");
                h2matriculasAbertas.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.anterior.qtdMatriculasAbertas, data.atual.qtdMatriculasAbertas);
                h2matriculasAbertas.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
            }

            const h2matriculasEncerradas = document.getElementById("matriculasEncerradas");
            h2matriculasEncerradas.textContent = data.atual.qtdMatriculasEncerradas;
            if (data.atual.qtdMatriculasEncerradas >= data.anterior.qtdMatriculasEncerradas) {
                h2matriculasEncerradas.parentNode.classList.add("ativo");
                h2matriculasEncerradas.parentNode.nextElementSibling.classList.add("ativo");
                h2matriculasEncerradas.parentNode.nextElementSibling.querySelector("img").src = "img/set_top_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.atual.qtdMatriculasEncerradas, data.anterior.qtdMatriculasEncerradas);
                h2matriculasEncerradas.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Acima";
            } else {
                h2matriculasEncerradas.parentNode.classList.remove("ativo");
                h2matriculasEncerradas.parentNode.nextElementSibling.classList.remove("ativo");
                h2matriculasEncerradas.parentNode.nextElementSibling.querySelector("img").src = "img/set_down_porcentagem.svg";
                const diffPercentage = calculatePercentageDiff(data.anterior.qtdMatriculasEncerradas, data.atual.qtdMatriculasEncerradas)
                h2matriculasEncerradas.parentNode.nextElementSibling.querySelector("h2").textContent = diffPercentage + " Abaixo";
            }
        })
        .catch(error => {
            // Trate qualquer erro que possa ocorrer durante a chamada da API
            console.error('Erro na chamada da API:', error);
        });
}

function atualizaFiltros(data) {
    atualizaDonutStatusALunos(data);
    atualizaInscricoes(data);
    atualizaAlunos(data);
    atualizaCursos(data);
}

function porInscricoes(data) {
    constroiLineChart(data.inscricoesXdias);
    inscricoesXestado(data.estadoXinscricoes);
    inscricoesXgenero(data.generoXinscricoes);
    inscricoesXcategoria(data.categoriaXinscricoes);
    inscricoesXperfil(data.perfilXinscricoes);
}

const data = [];
let prev = 5;
let prev2 = 50;
for (let i = 0; i < 1000; i++) {
    prev += 5 - Math.random() * 10;
    data.push({ x: i, y: prev });
    prev2 += 5 - Math.random() * 10;

}

function pegarFiltros() {
    var filtros = {
        categoria: getCategoriaFiltros(),
        curso: getCursoFiltros(),
        periodoInicial: getPeriodoInicial(),
        periodoFinal: getPeriodoFinal()
    };

    var data = JSON.stringify({
        "categoria": filtros.categoria,
        "curso": filtros.curso,
        "periodoInicial": filtros.periodoInicial,
        "periodoFinal": filtros.periodoFinal
    });

    atualizaFiltros(data);
    chamaAlunosPorPeriodo(filtros.periodoInicial, filtros.periodoFinal);
    return filtros;
}

function getCategoriaFiltros() {
    var checkboxes = document.querySelectorAll('#dropdown-categorias .menu-list input[type="checkbox"]:checked');
    var filtros = Array.from(checkboxes).map(function (checkbox) {
        return checkbox.parentNode.textContent.trim();
    });
    return filtros;
}

function getCursoFiltros() {
    var checkboxes = document.querySelectorAll('#dropdown-cursos .menu-list input[type="checkbox"]:checked');
    var filtros = Array.from(checkboxes).map(function (checkbox) {
        return checkbox.parentNode.textContent.trim();
    });
    return filtros;
}

function getPeriodoInicial() {
    var periodoInicial = document.getElementById('input-periodo-inicial').value;
    var data = new Date(periodoInicial);
    var dia = data.getDate() + 1;
    var mes = (data.getMonth() + 1).toString().padStart(2, '0');
    var ano = data.getFullYear().toString();

    if (isNaN(dia)) {
        return '16/06/2023';
    }

    return dia.toString().padStart(2, '0') + '/' + mes + '/' + ano;
}

function getPeriodoFinal() {
    var periodoFinal = document.getElementById('input-periodo-final').value;
    var data = new Date(periodoFinal);
    var dia, mes, ano;

    if (isNaN(data)) {
        // Return the current date
        data = new Date();
        dia = data.getDate();
        mes = (data.getMonth() + 1).toString().padStart(2, '0');
        ano = data.getFullYear().toString();
    } else {
        // Convert the provided date to the required format
        dia = data.getDate() + 1;
        mes = (data.getMonth() + 1).toString().padStart(2, '0');
        ano = data.getFullYear().toString();
    }

    return dia.toString().padStart(2, '0') + '/' + mes + '/' + ano;
}

var checkboxes = document.querySelectorAll('.menu-list input[type="checkbox"]');
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('click', aplicarFiltros);
});

const totalDuration = 10000;
const delayBetweenPoints = totalDuration / data.length;
const previousY = (ctx) => ctx.index === 0 ? ctx.chart.scales.y.getPixelForValue(100) : ctx.chart.getDatasetMeta(ctx.datasetIndex).data[ctx.index - 1].getProps(['y'], true).y;
const animation = {
    x: {
        type: 'number',
        easing: 'linear',
        duration: delayBetweenPoints,
        from: NaN, // the point is initially skipped
        delay(ctx) {
            if (ctx.type !== 'data' || ctx.xStarted) {
                return 0;
            }
            ctx.xStarted = true;
            return ctx.index * delayBetweenPoints;
        }
    },
    y: {
        type: 'number',
        easing: 'linear',
        duration: delayBetweenPoints,
        from: previousY,
        delay(ctx) {
            if (ctx.type !== 'data' || ctx.yStarted) {
                return 0;
            }
            ctx.yStarted = true;
            return ctx.index * delayBetweenPoints;
        }
    }
};

function ordenarPorRegiao(qtdEstados) {
    const regioes = {
        "Norte": ["AM", "RR", "AP", "PA", "TO", "RO", "AC"],
        "Nordeste": ["MA", "PI", "CE", "RN", "PB", "PE", "AL", "SE", "BA"],
        "Centro-Oeste": ["MT", "MS", "GO", "DF"],
        "Sudeste": ["SP", "RJ", "MG", "ES"],
        "Sul": ["PR", "SC", "RS"]
    };

    const regioesOrdenadas = Object.entries(regioes).sort((a, b) => a[0].localeCompare(b[0]));

    const qtdEstadosOrdenados = regioesOrdenadas.reduce((obj, [regiao, estadosRegiao]) => {
        const totalRegiao = estadosRegiao.reduce((total, estado) => total + (qtdEstados[estado] || 0), 0);
        obj[regiao] = totalRegiao;
        return obj;
    }, {});

    const naoInformadoCount = qtdEstados["NÃO INFORMADO"] || 0;
    qtdEstadosOrdenados["Não Informado"] = naoInformadoCount;

    return qtdEstadosOrdenados;
}

function constroiLineChart(dados) {
    var chart = document.getElementById('grafico-de-linha');
    const valores = Object.values(dados);

    const dadosParaGrafico = valores.map((valor, indice) => ({ x: indice, y: valor }));

    console.log(dadosParaGrafico);

    const data = {
        datasets: [{
            label: 'Inscrições',
            data: dadosParaGrafico,
            backgroundColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderWidth: 1,
            borderRadius: 100,
            maxBarThickness: 25,
            minBarLength: 20
        }]
    };

    criarOuAtualizarGraficoLinha(data, chart);
}

function donutStatusAlunos(dados) { //Fazer para o Reprovados
    const valores = [
        dados.qtdAprovados,
        dados.qtdNuncaAcessaram,
        dados.qtdEmAndamento,
        dados.qtdReprovados
    ];

    const data = {
        labels: [
            'Aprovados',
            'Nunca acessou',
            'Em andamento',
            'Reprovados'
        ],

        datasets: [{
            label: 'Status cursos',
            data: valores,
            backgroundColor: [
                'rgba(247, 104, 24, 1)',
                'rgba(255, 208, 182, 0.5)',
                'rgba(90, 92, 81, 1)',
                'rgba(221, 211, 83, 1)'
            ],
            hoverOffset: 4

        }],

    };



    var chart2 = document.getElementById('status-alunos-cursos');

    criarOuAtualizarGraficoDoughnut(data, chart2);
}

function inscricoesXestado(inscricoesXestado) {
    const labels = Object.keys(inscricoesXestado);
    const valores = Object.values(inscricoesXestado);

    const data = {
        labels: labels,
        datasets: [{
            label: 'Inscrições x Estado',
            data: valores,
            backgroundColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderWidth: 1,
            borderRadius: 100,
            maxBarThickness: 25,
            minBarLength: 20
        }]
    };
    var chart3 = document.getElementById('inscricoes-por-estado');

    criarOuAtualizarGraficoBarraVertical(data, chart3);
}

function inscricoesXgenero(inscricoesXgenero) {
    const labels = Object.keys(inscricoesXgenero);
    const valores = Object.values(inscricoesXgenero);
    const data = {
        labels: labels,

        datasets: [{
            label: 'Inscrições x Gênero',
            data: valores,
            backgroundColor: [
                'rgba(4, 191, 218, 1)',
                'rgba(251, 103, 202, 1)',
                'rgba(255, 168, 74, 1)'

            ],
            hoverOffset: 3

        }],

    };

    var chart2 = document.getElementById('inscricoes-por-genero');

    criarOuAtualizarGraficoDoughnut(data, chart2);
}

function inscricoesXcategoria(inscricoesXcategoria) {
    const labels = Object.keys(inscricoesXcategoria);
    const valores = Object.values(inscricoesXcategoria);

    const data = {
        labels: labels,
        datasets: [{
            axis: 'y',
            label: 'Inscrições x Categoria',
            data: valores,
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


    var chart5 = document.getElementById('inscricoes-por-categoria');

    criarOuAtualizarGraficoBarraHorizontal(data, chart5);
}

function inscricoesXperfil(inscricoesXperfil) {
    const labels = Object.keys(inscricoesXperfil);
    const valores = Object.values(inscricoesXperfil);
    const data = {
        labels: labels,
        datasets: [{
            axis: 'y',
            label: 'Inscrições x Perfil',
            data: valores,
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


    var chart6 = document.getElementById('inscricoes-por-perfil');

    criarOuAtualizarGraficoBarraHorizontal(data, chart6);
}

function diferencaEntrePropriedades(periodoInicial, periodoFinal) {
    const todasAsChaves = [...new Set([...Object.keys(periodoInicial), ...Object.keys(periodoFinal)])];

    const diferencaPorChave = todasAsChaves.reduce((diferenca, chave) => {
        const valorInicial = periodoInicial[chave];
        const valorFinal = periodoFinal[chave];

        // Calculamos a diferença somente se o valor existir em ambos os períodos
        if (valorInicial !== undefined && valorFinal !== undefined) {
            if (typeof valorInicial === 'object' && typeof valorFinal === 'object') {
                const todasAsSubChaves = [...new Set([...Object.keys(valorInicial), ...Object.keys(valorFinal)])];

                const diferencaSubChave = todasAsSubChaves.reduce((diferencaSub, subChave) => {
                    const valorIni = valorInicial?.[subChave] || 0;
                    const valorFin = valorFinal?.[subChave] || 0;
                    const diferencaValor = valorFin - valorIni;
                    diferencaSub[subChave] = diferencaValor;
                    return diferencaSub;
                }, {});

                diferenca[chave] = diferencaSubChave;
            } else {
                const diferencaValor = valorFinal - valorInicial;
                diferenca[chave] = diferencaValor;
            }
        }

        return diferenca;
    }, {});

    return diferencaPorChave;
}

function cadastrosPorEstado(qtdEstados) {
    const labels = Object.keys(qtdEstados);
    const valores = Object.values(qtdEstados);
    const data = {
        labels: labels,
        datasets: [{
            label: 'Cadastros na plataforma por estado',
            data: valores,
            backgroundColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderColor: [
                'rgba(252, 192, 32, 1)'
            ],
            borderWidth: 1,
            borderRadius: 100,
            maxBarThickness: 25,
            minBarLength: 20
        }]
    };
    var chart7 = document.getElementById('cadastros-estados');

    criarOuAtualizarGraficoBarraVertical(data, chart7);
}

function cadastrosPorRegiao(qtdEstadosOrdenados) {
    const labels = Object.keys(qtdEstadosOrdenados);
    const data = Object.values(qtdEstadosOrdenados);

    const chartData = {
        labels: labels,
        datasets: [{
            label: 'Região',
            data: data,
            backgroundColor: [
                'rgba(247, 104, 24, 1)',
                'rgba(90, 92, 81, 1)',
                'rgba(242, 216, 137, 1)',
                'rgba(252, 192, 32, 1)'
            ],
            hoverOffset: 4
        }]
    };

    var chartElement = document.getElementById('cadastros-regiao');

    criarOuAtualizarGraficoDoughnut(chartData, chartElement);

}

function chartIdade(faixaEtariaXPerfil) {
    const labels = Object.keys(faixaEtariaXPerfil);
    const valores = Object.values(faixaEtariaXPerfil);

    const data = {
        labels: labels,
        datasets: [{
            axis: 'y',
            label: 'Faixa Etária',
            data: valores,
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
    var chart9 = document.getElementById('faixaXperfil');

    criarOuAtualizarGraficoBarraHorizontal(data, chart9);
}

function donutPorDeficiencias(qtdDeficiencias) {
    const labels = Object.keys(qtdDeficiencias);
    const valores = Object.values(qtdDeficiencias);

    const data = {
        labels: labels,

        datasets: [{
            label: labels,
            data: valores,
            backgroundColor: [
                'rgba(247, 104, 24, 1)',
                'rgba(90, 92, 81, 1)',
                'rgba(221, 211, 83, 1)',
                'rgba(252, 192, 32, 1)'
            ],
            hoverOffset: 4

        }],

    };

    var chart10 = document.getElementById('deficiencias');

    criarOuAtualizarGraficoDoughnut(data, chart10);
}

function donutPorGeneros(qtdGeneros) {
    const labels = Object.keys(qtdGeneros);
    const valores = Object.values(qtdGeneros);
    const data = {
        labels: labels,

        datasets: [{
            label: 'Gênero',
            data: valores,
            backgroundColor: [
                'rgba(4, 191, 218, 1)',
                'rgba(251, 103, 202, 1)',
                'rgba(255, 168, 74, 1)'

            ],
            hoverOffset: 3

        }],

    };

    var chart11 = document.getElementById('cadastros-genero');

    criarOuAtualizarGraficoDoughnut(data, chart11);

}

function porEscolaridade(qtdEscolaridade) {
    const labels = Object.keys(qtdEscolaridade);
    const valores = Object.values(qtdEscolaridade);

    const data = {
        labels: labels,
        datasets: [{
            axis: 'y',
            label: 'Escolaridade',
            data: valores,
            fill: false,
            backgroundColor: ['rgba(252, 192, 32, 1)'],
            borderColor: ['rgba(252, 192, 32, 1)'],
            borderWidth: 1,
            borderRadius: 100,
            maxBarThickness: 15,
            minBarLength: 10
        }]
    };

    var chart12 = document.getElementById('cadastros-escolaridade');

    criarOuAtualizarGraficoBarraHorizontal(data, chart12);
}

// Objeto para armazenar as instâncias dos gráficos
let chartInstances = {};

function criarOuAtualizarGraficoBarraVertical(data, canvasElement) {
    let chartGraph = null;

    if (chartInstances[canvasElement.id]) {
        // Destroi o gráfico existente
        chartInstances[canvasElement.id].destroy();
    }

    chartGraph = new Chart(canvasElement, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    // Armazena a referência do gráfico no objeto
    chartInstances[canvasElement.id] = chartGraph;
}

function criarOuAtualizarGraficoBarraHorizontal(data, canvasElement) {
    let chartGraph = null;

    if (chartInstances[canvasElement.id]) {
        // Destroi o gráfico existente
        chartInstances[canvasElement.id].destroy();
    }

    chartGraph = new Chart(canvasElement, {
        type: 'bar',
        data: data,
        options: {
            indexAxis: 'y',
        },
    });

    // Armazena a referência do gráfico no objeto
    chartInstances[canvasElement.id] = chartGraph;
}

function criarOuAtualizarGraficoDoughnut(data, canvasElement) {
    let chartGraph = null;

    if (chartInstances[canvasElement.id]) {
        // Destroi o gráfico existente
        chartInstances[canvasElement.id].destroy();
    }

    chartGraph = new Chart(canvasElement, {
        type: 'doughnut',
        data: data,
    });

    // Armazena a referência do gráfico no objeto
    chartInstances[canvasElement.id] = chartGraph;
}

function criarOuAtualizarGraficoLinha(data, canvasElement) {
    let chartGraph = null;

    if (chartInstances[canvasElement.id]) {
        // Destroi o gráfico existente
        chartInstances[canvasElement.id].destroy();
    }

    chartGraph = new Chart(canvasElement, {
        type: 'line',
        data: {
            datasets: [{
                data: data.datasets[0].data, // Ajuste aqui
                borderWidth: 1,
                radius: 0,
                borderColor: 'rgba(42, 185, 185, 1)',
                backgroundColor: 'rgba(42, 185, 185, 1)',
            }]
        },
        options: {
            //animation,
            interaction: {
                intersect: false
            },
            plugins: {
                legend: false
            },
            scales: {
                x: {
                    type: 'linear'
                }
            }
        }
    });

    // Armazena a referência do gráfico no objeto
    chartInstances[canvasElement.id] = chartGraph;
}