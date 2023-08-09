function renderizarBlocosTrilha(cursos_destaque) {
  var trilhas = new Set();

  cursos_destaque.forEach(function (curso) {
    for (var trilha in curso) {
      if (trilha.startsWith('trilha_')) {
        if (curso[trilha] !== 0) {
          trilhas.add(trilha);
        }
      }
    }
  });

  var container = document.querySelector('.area_btns_cursos_home');
  container.innerHTML = ''; // Limpar o conteúdo do container antes de renderizar as trilhas

  trilhas.forEach(function (trilha) {
    var quantidade = cursos_destaque.filter(function (curso) {
      return curso[trilha] !== 0;
    }).length;

    var nome = trilha
      .replace('trilha_', '')
      .replace(/_/g, ' ')
      .replace(/\b\w/g, function (l) {
        return l.toUpperCase();
      });

    var trilhaHtml = '<a href="#" data-trilha="' + trilha + '">' +
      '<div class="btn_pesquisa_home animation_btns">' +
      '<h2>' + nome + ' (' + quantidade + ')</h2>' +
      '</div>' +
      '</a>';

    var div = document.createElement('div');
    div.innerHTML = trilhaHtml;

    var anchor = div.querySelector('a');
    anchor.addEventListener('click', function (event) {
      event.preventDefault();
      var trilhaSelecionada = event.currentTarget.dataset.trilha;
      resetarCursosDestaque();
      renderizarCursosDestaque(cursos_destaque, trilhaSelecionada);
    });

    container.appendChild(div.firstChild);
  });
}



function resetarBlocosTrilha() {
  var container = document.querySelector('.area_btns_cursos');
  var blocosTrilha = container.querySelectorAll('.btn_pesquisa_home');

  // Remover os blocos existentes
  blocosTrilha.forEach(function (bloco) {
    container.removeChild(bloco);
  });
}


function resetarCursosDestaque() {
  var container = document.querySelector('.area_container_2_home');
  container.innerHTML = '';
}

function renderizarCursosDestaque(cursosDestaque, trilha) {
  var container = document.querySelector('.area_container_2_home');
  if (cursosDestaque.length > 0 && Object.keys(cursosDestaque[0]).length > 0) {
    cursosDestaque.forEach(function (curso) {
      // Verificar se a trilha está definida e corresponde à trilha selecionada
      if ((trilha === undefined || curso[trilha] !== undefined && curso[trilha] !== 0) && curso != undefined) {
        var modalidadeFormatado = curso.modalidade === 'Curso via Whatsapp' ? 'Curso via <br> Whatsapp' : curso.modalidade;
        if (modalidadeFormatado == "Não Informado"){
            modalidadeFormatado = "Sem <br> Modalidade";
        }
        var modalidade = curso.modalidade;
        var imagem = curso.imagem;
        var fullname = curso.fullname;
        var descricaocurta = curso.descricaocurta;
        var chcurso = curso.chcurso;
        var url_pg_vendas = curso.url_pg_vendas;
        var publicos = [
          curso.publico_empresario || 0,
          curso.publico_estudante || 0,
          curso.publico_univesitario || 0,
          curso.publico_publicogeral || 0,
          curso.publico_profissionalliberal || 0,
          curso.publico_profissionalautonomo || 0,
          curso.publico_empregadoclt || 0,
          curso.publico_desempregado || 0,
          curso.publico_estagiario || 0
        ];
        var publicos_diferentes_zero = publicos.filter(function (valor) {
          return valor !== 0;
        });



        var cursoHtml = '<div class="card_cursos_online_home">' +
          '<div class="card_cursos_online_int">' +
          '<div class="area_img_cursos_online_home">' +
          '<div class="bg_card_home">' +
          '<img src="img/cards_home_' + obterModalidade(modalidade) + '.svg" alt="">' +
          '</div>' +
          '<div class="curso_online_destaque_home">' +
          '<h2>' + modalidadeFormatado + '</h2>' +
          '</div>' +
          '<img class="bg_card_principal_' + obterModalidade(modalidade) + '" src="' + imagem + '" alt="">' +
          '</div>' +
          '<div class="area_info_cursos_online_home_total">' +
          '<div class="area_texts_cursos_online_home">' +
          '<div class="title_cursos_online_home_' + obterModalidade(modalidade) + '">' +
          '<h2>' + fullname + '</h2>' +
          '</div>' +
          '<div class="sub_title_cursos_online_home">' +
          '<p>' + descricaocurta + '</p>' +
          '</div>' +
          '</div>' +
          '<div class="area_info_cursos_online_home">' +
          '<div class="area_info_cursos_online_int_home_total">' +
          '<div class="area_info_cursos_online_int_home">' +
          '<img src="img/card_horas_' + obterModalidade(modalidade) + '.svg" alt="">' +
          '<div class="title_info_cursos_online">' +
          '<h2>Carga Horária: <b>' + chcurso + 'hs</b></h2>' +
          '</div>' +
          '</div>' +
          '<div class="area_info_cursos_online_int_home">' +
          '<img src="img/card_public_' + obterModalidade(modalidade) + '.svg" alt="">' +
          '<div class="title_info_cursos_online">' +
          '<h2>Público alvo: <br><b>' + publicos_diferentes_zero.join(', ') + '</b></h2>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '<div class="area_btn_info">' +
          '<a href="' + url_pg_vendas + '">' +
          '<div class="btn_info_cursos_online_home">' +
          '<h2>Realizar inscrição</h2>' +
          '</div>' +
          '</a>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '</div>';

        var div = document.createElement('div');
        div.innerHTML = cursoHtml;

        container.appendChild(div.firstChild);
      }
    });
  }
}


function obterCursosDestaque() {
  fetch('get_cursos_destaque.php')
    .then(response => response.json())
    .then(data => {
      const cursosDestaque = data.cursos_destaque;
      resetarBlocosTrilha();
      resetarCursosDestaque();
      renderizarBlocosTrilha(cursosDestaque);
      renderizarCursosDestaque(cursosDestaque);
    })
    .catch(error => console.error(error));
}

window.addEventListener('DOMContentLoaded', function () {
  obterCursosDestaque();
  fetch('get_cursos_destaque.php')
  .then(response => response.json())
  .then(data => {
    const cursosDestaque = data.cursos_destaque;
    renderModalidadesBlocks(cursosDestaque);
  })
  .catch(error => console.error(error));
});

function limparSelects() {
  var divs = document.querySelectorAll('.title_btn_cursos_opcao');
  divs.forEach(function (div) {
    div.classList.remove('select');
  });
}


function obterCursos(modalidade, event) {
  event.preventDefault();

  // Verificar se o botão atual já possui a classe "select"
  var btnClicado = event.currentTarget;
  var divSelecionada = btnClicado.querySelector('.title_btn_cursos_opcao');
  var possuiSelect = divSelecionada.classList.contains('select');

  if (possuiSelect) {
    obterCursosDestaque();
    // Remover classe "select" de todos os botões
    limparSelects();
  } else {
    limparSelects();
    // Adicionar classe "select" à div do botão clicado
    divSelecionada.classList.add('select');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'modalidade.php?modalidade=' + modalidade, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        var resposta = JSON.parse(xhr.responseText);
        resposta = JSON.parse(resposta);
        var cursosDestaque = resposta.cursos_destaque;
        resetarBlocosTrilha();
        renderizarBlocosTrilha(cursosDestaque);
        resetarCursosDestaque();
        renderizarCursosDestaque(cursosDestaque);
      }
    };

    xhr.send();
  }
}

function createModalidadeAnchor(modalidade) {
  // Format the modalidade by replacing spaces with hyphens
  const formattedModalidade = modalidade.replace(/\s+/g, '-');
  return `
    <a class="btn_cursos_opcao animation_btns" href="#" onclick="obterCursos('${formattedModalidade}', event)">
      <div class="title_btn_cursos_opcao">
        <h2>${modalidade}</h2>
      </div>
    </a>
  `;
}

function renderModalidadesBlocks(cursosDestaque) {
  const modalidadesContainer = document.getElementById("modalidadesContainer");
  const addedModalidades = new Set(); // Set to keep track of added modalidades

  if (cursosDestaque && cursosDestaque.length > 0) {
    cursosDestaque.forEach(function (curso) {
      const modalidade = curso.modalidade;

      // Check if the modalidade is not "Não Informado" and has not already been added, then add it
      if (modalidade !== "Não Informado" && !addedModalidades.has(modalidade)) {
        const anchor = createModalidadeAnchor(modalidade);
        modalidadesContainer.insertAdjacentHTML('beforeend', anchor);
        addedModalidades.add(modalidade); // Add the modalidade to the Set
      }
    });
  }
}

// Selecionar o campo de pesquisa
var campoPesquisa = document.getElementById('pesquisa_home');

// Adicionar o event listener ao evento 'input'
campoPesquisa.addEventListener('input', fazerPesquisa);

function fazerPesquisa(event) {

  event.preventDefault(); // Impedir o envio do formulário

  var input = campoPesquisa.value;

  if (input == '') {
    obterCursosDestaque();
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'pesquisa.php?pesquisa_home=' + input, true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var cursosDestaque = response.cursos_destaque;
      limparSelects();
      resetarBlocosTrilha();
      renderizarBlocosTrilha(cursosDestaque);
      resetarCursosDestaque();
      renderizarCursosDestaque(cursosDestaque);
    }
  };

  xhr.send();
}

function obterModalidade(modalidade) {
  switch (modalidade) {
    case 'Curso Online':
      return 1;
    case 'Curso Presencial':
      return 2;
    case 'Híbridos':
      return 5;
    case 'Webinário':
      return 3;
    case 'Curso via Whatsapp':
      return 4;
    case 'Oficinas':
      return 6;
    case 'Não Informado':
      return 7;
    default:
      return 0; // Valor padrão caso a modalidade não seja reconhecida
  }
}
