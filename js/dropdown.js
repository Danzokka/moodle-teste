function toggleCheckbox(checkbox) {
  var categoriaOrCursoId = checkbox.closest('.dropdown-menu-container').id;
  var dropdownToggle = document.querySelector(`#${categoriaOrCursoId} .dropdown-toggle`);
  var dropdownMenu = document.querySelector(`#${categoriaOrCursoId} .dropdown-menu`);
  const elementoContainer = document.querySelector(`#${categoriaOrCursoId}`);

  if (checkbox.checked) {
      dropdownToggle.innerHTML = `<i class="fa-solid fa-tag" style="color: #578ae9; width: 10px; vertical-align: -2px; padding-right: 20px;"></i> ${categoriaOrCursoId === 'dropdown-categorias' ? 'Categoria' : 'Curso'} <img src="img/para_baixo_azul.svg" alt="" style="width: 15px;">`;
      elementoContainer.classList.add('marcada');
  } else {
      dropdownToggle.innerHTML = `<i class="fa-solid fa-tag" style="color: #898989; width: 10px; vertical-align: -2px; padding-right: 20px;"></i> ${categoriaOrCursoId === 'dropdown-categorias' ? 'Categoria' : 'Curso'} <img src="img/para_baixo.svg" alt="" style="width: 15px;">`;
      elementoContainer.classList.remove('marcada');
  }
}

document.addEventListener("click", function (event) {
  var dropdownMenus = document.querySelectorAll(".dropdown-menu");
  var dropdownToggles = document.querySelectorAll(".dropdown-toggle");

  for (var i = 0; i < dropdownMenus.length; i++) {
    var dropdownMenu = dropdownMenus[i];
    var dropdownToggle = dropdownToggles[i];

    if (!dropdownMenu.contains(event.target) && !dropdownToggle.contains(event.target)) {
      dropdownMenu.classList.remove("show");
    }
  }
});

function toggleDropdown(element) {
  var dropdownMenu = element.nextElementSibling;
  dropdownMenu.classList.toggle('show');
}

function selectItem(element) {
  var dropdownToggle = element.parentNode.querySelector('.dropdown-toggle');
  var selectedText = element.textContent;
  dropdownToggle.textContent = selectedText;
  var dropdownMenu = element.parentNode;
  dropdownMenu.classList.remove('show');
}

function clearFilters(divId) {
  var checkboxes = document.querySelectorAll(`#${divId} .menu-list input[type="checkbox"]:checked`);
  checkboxes.forEach(function (checkbox) {
    checkbox.checked = false;
  });

  printSelectedCheckboxes(divId);
}

var periodoInicialText = "Período Inicial";
var periodoFinalText = "Período Final";

function adicionarFiltro(id) {
  const inputDate = document.querySelector(`#${id} input[type="date"]`);
  const selectedDate = inputDate.value;

  const elementoH2 = document.querySelector(`#${id} h2`);
  const elementoContainer = document.querySelector(`#${id}`);

  if (selectedDate !== "") {
    const dateObj = new Date(selectedDate);
    const timezoneOffset = dateObj.getTimezoneOffset() * 60000; // Converte para milissegundos
    // Adiciona o deslocamento de fuso horário ao valor do input
    const adjustedDate = new Date(dateObj.getTime() + timezoneOffset);
    const formattedDate = adjustedDate.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
    elementoH2.innerHTML = `<i class="fa-regular fa-calendar" style="color: #578ae9; width: 10px; padding-right: 20px;"></i> ${formattedDate} <img src="img/para_baixo_azul.svg" alt="" style="width: 15px;">`;
    elementoContainer.classList.add('marcada');
  } else {
    elementoContainer.classList.remove('marcada');
    if (id === "periodo-inicial") {
      elementoH2.innerHTML = `<i class="fa-regular fa-calendar" style="color: #898989; width: 10px; padding-right: 20px;"></i> ${periodoInicialText} <img src="img/para_baixo.svg" alt="" style="width: 15px;">`;
    } else if (id === "periodo-final") {
      elementoH2.innerHTML = `<i class="fa-regular fa-calendar" style="color: #898989; width: 10px; padding-right: 20px;"></i> ${periodoFinalText} <img src="img/para_baixo.svg" alt="" style="width: 15px;">`;
    }
  }
}

const categoriaDropdown = document.getElementById('categoria'); // Elemento onde as categorias serão adicionadas
const cursosDropdown = document.getElementById('cursos'); // Elemento onde os cursos serão adicionados

function createCheckboxItem(text) {
  return `<li><label><input type="checkbox" onclick="toggleCheckbox(this)">${text}</label></li>`;
}

document.addEventListener('DOMContentLoaded', function () {
  fetch('get_categorias.php')
    .then(response => response.json())
    .then(data => {
      const categorias = data.categorias[0]; // Obtém o objeto de categorias

      // Adiciona as categorias ao dropdown de categoria
      Object.keys(categorias).forEach(categoria => {
        const checkboxItem = createCheckboxItem(categoria);
        categoriaDropdown.innerHTML += checkboxItem;
      });

      // Adiciona os cursos ao dropdown de cursos
      Object.values(categorias).forEach(cursos => {
        cursos.forEach(curso => {
          const checkboxItem = createCheckboxItem(curso);
          cursosDropdown.innerHTML += checkboxItem;
        });
      });
    })
    .catch(error => {
      console.error('Ocorreu um erro ao carregar as categorias:', error);
    });
});

function pegarFiltros() {
  var filtros = {
      categoria: getCategoriaFiltros(),
      curso: getCursoFiltros(),
      periodoInicial: getPeriodoInicial(),
      periodoFinal: getPeriodoFinal()
  };

  // Exibir os filtros selecionados
  console.log(filtros);
  alert(JSON.stringify(filtros));
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
  return periodoInicial;
}

function getPeriodoFinal() {
  var periodoFinal = document.getElementById('input-periodo-final').value;
  return periodoFinal;
}
