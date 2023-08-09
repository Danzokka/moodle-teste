<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel administrativo</title>
    <link rel="stylesheet" href="css/style-adicional-index-dash.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
</head>

<body>
    <?php include 'header.php'
    ?>

    <div class="container_ead_flex">
        <div class="container_ead_flex_int">
            <div class="area_ead_flex">
                <div class="title_ead_flex">
                    <h2>
                        Painel administrativo
                    </h2>
                </div>

                <div class="area_info_dashboard_2">
                    <div class="info_dashboard_2">
                        <div class="info_dashboard_2_int">
                            <div class="info_matriculas">
                                <img src="img/ead_flex_1.svg" alt="">

                                <div class="title_info_matriculas">
                                    <h2>
                                        Usuários Matriculados
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnMatriculasAbertas">
                                <div class="info_numeros_matriculas">
                                    <h2 id="usuariosMatriculados">

                                    </h2>
                                </div>

                                <div class="btn_porcentagem">
                                    <img src="img/set_down_porcentagem.svg" alt="">

                                    <h2>
                                        29% Abaixo
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="info_dashboard_2">
                        <div class="info_dashboard_2_int">
                            <div class="info_matriculas">
                                <img src="img/matricula_1.svg" alt="">

                                <div class="title_info_matriculas">
                                    <h2>
                                        Usuários Inscritos
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnMatriculasEncerradas">
                                <div class="info_numeros_matriculas">
                                    <h2 id="usuariosInscritos">

                                    </h2>
                                </div>

                                <div class="btn_porcentagem">
                                    <img src="img/set_down_porcentagem.svg" alt="">

                                    <h2>
                                        29% Abaixo
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info_dashboard_2">
                        <div class="info_dashboard_2_int">
                            <div class="info_matriculas">
                                <img src="img/ead_flex_3.svg" alt="">

                                <div class="title_info_matriculas">
                                    <h2>
                                        Conclusões
                                        de Curso
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnConclusoes">
                                <div class="info_numeros_matriculas">
                                    <h2 id="conclusoesDeCurso">

                                    </h2>
                                </div>

                                <div class="btn_porcentagem">
                                    <img src="img/set_down_porcentagem.svg" alt="">

                                    <h2>
                                        29% Abaixo
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="info_dashboard_2">
                        <div class="info_dashboard_2_int">
                            <div class="info_matriculas">
                                <img src="img/matricula_2.svg" alt="">

                                <div class="title_info_matriculas">
                                    <h2>
                                        Certificados Emitidos
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnUsuariosAtivos">
                                <div class="info_numeros_matriculas ativo">
                                    <h2 id="certificadosEmitidos">

                                    </h2>
                                </div>

                                <div class="btn_porcentagem ativo">
                                    <img src="img/set_top_porcentagem.svg" alt="">

                                    <h2>
                                        29% Acima
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container_cursos_andamentos">
        <div class="container_cursos_andamentos_int">
            <div class="area_cursos_andamentos">
                <div class="area_texts_finalizados">
                    <div class="title_finalizados">
                        <h2>
                            Status cursos em andamento
                        </h2>
                    </div>
                </div>

                <div class="container_tabela">

                    <div class="area_opcoes_andamento">
                        <div class="area_procurar_andamento">
                            <div class="area_input_andamento">
                                <div class="title_input_andamento">
                                    <h2>
                                        Procurar
                                    </h2>
                                </div>
                                <div class="area_input_curso">
                                    <input id="curso_em_andamento" class="input_curso" type="text" name="curso" placeholder="Cursos Em Andamento">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.7137 14.3767L12.6397 11.3027C13.5713 10.0831 14.0822 8.60377 14.0824 7.04279C14.0824 5.16164 13.3498 3.39296 12.0194 2.0628C10.6893 0.73265 8.92081 0 7.03943 0C5.15828 0 3.3896 0.73265 2.05945 2.0628C-0.686483 4.80897 -0.686483 9.27707 2.05945 12.0228C3.3896 13.3532 5.15828 14.0858 7.03943 14.0858C8.60042 14.0856 10.0797 13.5746 11.2993 12.643L14.3733 15.717C14.5582 15.9022 14.801 15.9947 15.0435 15.9947C15.286 15.9947 15.5288 15.9022 15.7137 15.717C16.0839 15.347 16.0839 14.7467 15.7137 14.3767ZM3.39979 10.6824C1.39298 8.67563 1.39321 5.41018 3.39979 3.40314C4.37195 2.43121 5.66461 1.89573 7.03943 1.89573C8.41448 1.89573 9.70691 2.43121 10.6791 3.40314C11.6512 4.3753 12.1867 5.66797 12.1867 7.04279C12.1867 8.41784 11.6512 9.71027 10.6791 10.6824C9.70691 11.6546 8.41448 12.1901 7.03943 12.1901C5.66461 12.1901 4.37195 11.6546 3.39979 10.6824Z" fill="#FCC020" />
                                    </svg>

                                </div>

                            </div>

                        </div>
                        <div class="pagina-quantidade">
                            <div class="area_select_input_total dropdown-menu-container" id="dropdown-cursos">
                                <div class="title_select_input">
                                    <h2>
                                        Pagina
                                    </h2>
                                </div>
                                <div class="area_select_input" class="dropdown-toggle" onclick="toggleDropdownQuantidade(this)">
                                    <h2 id="dropdown-pagina-cursos">1</h2>
                                    <img src="img/set_form.svg" alt="">

                                    <div class="area_drop_down_quantidade">
                                        <ul id="lista-quantidade-paginas" class="area_drop_down_quantidade_int">
                                            <li onclick="selectQuantidadePaginaCursosEmAndamento(this)">1</li>
                                            <li onclick="selectQuantidadePaginaCursosEmAndamento(this)">2</li>
                                            <li onclick="selectQuantidadePaginaCursosEmAndamento(this)">3</li>
                                            <li onclick="selectQuantidadePaginaCursosEmAndamento(this)">4</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="area_select_input_total dropdown-menu-container" id="dropdown-cursos">
                                <div class="title_select_input">
                                    <h2>
                                        Mostrar
                                    </h2>
                                </div>
                                <div class="area_select_input" class="dropdown-toggle" onclick="toggleDropdownQuantidade(this)">
                                    <h2 id="dropdown-quantidade-cursos-em-andamento">10</h2>
                                    <img src="img/set_form.svg" alt="">

                                    <div class="area_drop_down_quantidade">
                                        <ul class="area_drop_down_quantidade_int">
                                            <li onclick="selectQuantidadeCursosEmAndamento(this)">5</li>
                                            <li onclick="selectQuantidadeCursosEmAndamento(this)">10</li>
                                            <li onclick="selectQuantidadeCursosEmAndamento(this)">15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="limita_tabela_principal">
                        <table id="table_administrativo" class="bordered striped centered highlight responsive-table">
                            <thead class="bg_nomes">
                                <tr>
                                    <th>Nome do Curso</th>
                                    <th>Categoria</th>
                                    <th>Matriculados</th>
                                    <th>Concluído</th>
                                    <th>Não foi iniciado</th>
                                    <th>Em andamento</th>
                                    <th>Certificados Emitidos</th>
                                </tr>
                            </thead>
                            <tbody class="table-container" id="tabelaCursosEmAndamento">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container_inscricoes">
        <div class="container_inscricoes_int">
            <div class="area_inscricoes">
                <div class="area_graficos_1">
                    <div class="title_graficos_1">
                        <h2>
                            Engajamento cursos em andamento
                        </h2>
                    </div>
                    <div class="graficos_inscricoes">
                        <canvas class="bar-chart-adm-1"></canvas>
                    </div>
                </div>
                <div class="area_graficos_1">
                    <div class="title_graficos_1">
                        <h2>
                            Engajamento últimos 30 dias
                        </h2>
                    </div>
                    <div class="graficos_inscricoes area_doughnut">

                        <div class="area_graficos_texts">
                            <canvas class="doughnut-chart"></canvas>

                            <div class="area_texts_int">

                                <div class="title_graficos_texts">
                                    <p id="matriculados30dias">
                                        8.890/53.450
                                    </p>
                                </div>
                                <div class="sub_title_graficos_texts">
                                    <p>
                                        Alunos matriculados na plataforma nos últimos 30 dias
                                    </p>
                                </div>

                            </div>

                        </div>
                        <div class="area_graficos_texts">
                            <canvas class="doughnut-chart_2"></canvas>
                            <div class="area_texts_int">

                                <div class="title_graficos_texts">
                                    <p id="horasAssistidasNosUltimos30dias">
                                        Alunos que iniciaram
                                        seus estudo
                                    </p>
                                </div>
                                <div class="sub_title_graficos_texts">
                                    <p>
                                        Total de horas de cursos na plataforma nos últimos 30 dias
                                    </p>
                                </div>

                            </div>

                        </div>

                        <div class="area_graficos_texts">
                            <canvas class="doughnut-chart_3"></canvas>

                            <div class="area_texts_int">

                                <div class="title_graficos_texts">
                                    <p id="alunosIniciaram30dias">
                                        2.185/16.459
                                    </p>
                                </div>
                                <div class="sub_title_graficos_texts">
                                    <p>
                                        Alunos que iniciaram seus cursos nos últimos 30 dias
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="area_graficos_texts">

                            <canvas class="doughnut-chart_4"></canvas>
                            <div class="area_texts_int">

                                <div class="title_graficos_texts">
                                    <p id="alunosFinalizaram30dias">
                                        1.879/23.567
                                    </p>
                                </div>
                                <div class="sub_title_graficos_texts">
                                    <p>
                                        Alunos que finalizaram seus cursos nos últimos 30 dias
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container_conclusao">
        <div class="container_conclusao_int">


            <div class="area_conclusao">

                <div class="area_select_curso_total  dropdown-menu-container" id="dropdown-cursos">
                    <div class="title_select_curso">
                        <h2>
                            Curso
                        </h2>
                    </div>

                    <div class="area_input_curso">
                        <input id="curso_finalizado" class="input_curso_2" type="text" name="curso" placeholder="Cursos Finalizados">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.7137 14.3767L12.6397 11.3027C13.5713 10.0831 14.0822 8.60377 14.0824 7.04279C14.0824 5.16164 13.3498 3.39296 12.0194 2.0628C10.6893 0.73265 8.92081 0 7.03943 0C5.15828 0 3.3896 0.73265 2.05945 2.0628C-0.686483 4.80897 -0.686483 9.27707 2.05945 12.0228C3.3896 13.3532 5.15828 14.0858 7.03943 14.0858C8.60042 14.0856 10.0797 13.5746 11.2993 12.643L14.3733 15.717C14.5582 15.9022 14.801 15.9947 15.0435 15.9947C15.286 15.9947 15.5288 15.9022 15.7137 15.717C16.0839 15.347 16.0839 14.7467 15.7137 14.3767ZM3.39979 10.6824C1.39298 8.67563 1.39321 5.41018 3.39979 3.40314C4.37195 2.43121 5.66461 1.89573 7.03943 1.89573C8.41448 1.89573 9.70691 2.43121 10.6791 3.40314C11.6512 4.3753 12.1867 5.66797 12.1867 7.04279C12.1867 8.41784 11.6512 9.71027 10.6791 10.6824C9.70691 11.6546 8.41448 12.1901 7.03943 12.1901C5.66461 12.1901 4.37195 11.6546 3.39979 10.6824Z" fill="#FCC020" />
                        </svg>
                    </div>

                </div>

                <div class=" area_categoria_conclusao">
                    <div class="title_categoria">
                        <h2 id="categoria"></h2>
                    </div>
                    <div class="sub_title_categoria">
                        <p id="subCategoria"></p>
                    </div>
                </div>

                <div class="area_infos_conclusao">
                    <div class="infos_conclusao">
                        <h2><b>Data de início:</b> <span id="dataInicio"></span></h2>
                    </div>
                    <div class="infos_conclusao">
                        <h2><b>Data de Conclusão:</b> <span id="dataFinal"></span></h2>
                    </div>
                    <div class="infos_conclusao">
                        <h2><b>Nunca Acessaram:</b> <span id="qtdNuncaAcessaram"></span></h2>
                    </div>
                    <div class="infos_conclusao">
                        <h2><b>Concluídos:</b> <span id="qtdConcluidos"></span></h2>
                    </div>
                </div>

                <div class="area_infos_conclusao_2">
                    <div class="infos_conclusao_2">
                        <h2><span id="qtdMatriculados"></span></h2>
                        <p>Matriculados</p>
                    </div>
                    <div class="infos_conclusao_2">
                        <h2><span id="qtdCertificados"></span></h2>
                        <p>Certificados Emitidos</p>
                    </div>
                    <div class="infos_conclusao_2">
                        <h2><b><span id="mediaProgresso"></span></b></h2>
                        <p>Média progresso</p>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="container_populares">
        <div class="container_populares_int">
            <div class="area_populares">

                <div class="area_tabela_1">
                    <div class="title_tabela_1">
                        <h2>
                            Cursos Populares
                        </h2>
                    </div>

                    <div class="area_tabela_populares">
                        <div class="area_input_populares">
                            <div class="title_input_andamento">
                                <h2>
                                    Procurar
                                </h2>
                            </div>
                            <div class="area_input_curso">
                                <input id="select_ranking" class="input_curso_2" type="text" name="curso" placeholder="Cursos Mais Populares">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.7137 14.3767L12.6397 11.3027C13.5713 10.0831 14.0822 8.60377 14.0824 7.04279C14.0824 5.16164 13.3498 3.39296 12.0194 2.0628C10.6893 0.73265 8.92081 0 7.03943 0C5.15828 0 3.3896 0.73265 2.05945 2.0628C-0.686483 4.80897 -0.686483 9.27707 2.05945 12.0228C3.3896 13.3532 5.15828 14.0858 7.03943 14.0858C8.60042 14.0856 10.0797 13.5746 11.2993 12.643L14.3733 15.717C14.5582 15.9022 14.801 15.9947 15.0435 15.9947C15.286 15.9947 15.5288 15.9022 15.7137 15.717C16.0839 15.347 16.0839 14.7467 15.7137 14.3767ZM3.39979 10.6824C1.39298 8.67563 1.39321 5.41018 3.39979 3.40314C4.37195 2.43121 5.66461 1.89573 7.03943 1.89573C8.41448 1.89573 9.70691 2.43121 10.6791 3.40314C11.6512 4.3753 12.1867 5.66797 12.1867 7.04279C12.1867 8.41784 11.6512 9.71027 10.6791 10.6824C9.70691 11.6546 8.41448 12.1901 7.03943 12.1901C5.66461 12.1901 4.37195 11.6546 3.39979 10.6824Z" fill="#FCC020" />
                                </svg>
                            </div>

                        </div>
                        <div class="limita_tabela">
                            <table id="table_populares" class="bordered striped centered highlight responsive-table">
                                <thead class="bg_nomes_populares">
                                    <tr>
                                        <th>Classificação</th>
                                        <th>Nome do curso</th>
                                        <th>Matricula</th>
                                    </tr>
                                </thead>

                                <tbody id="rankingCursosEmAndamento">
                                </tbody>
                        </div>
                        </table>
                    </div>
                </div>

            </div>


            <div class="area_tabela_2">

                <div class="title_tabela_2">
                    <h2>
                        Certificados Emitidos
                    </h2>
                </div>


                <div class="area_tabela_populares_2">
                    <div class="area_opcoes_andamento">
                        <div class="area_procurar_andamento">
                            <div class="area_input_andamento">
                                <div class="title_input_andamento">
                                    <h2>
                                        Procurar
                                    </h2>
                                </div>
                                <div class="area_input_curso">
                                    <form onsubmit="fazerPesquisaConclusao(event)">
                                        <input id="usuario_concluido" class="input_curso" type="text" name="curso" placeholder="Pesquisa por Curso">
                                    </form>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.7137 14.3767L12.6397 11.3027C13.5713 10.0831 14.0822 8.60377 14.0824 7.04279C14.0824 5.16164 13.3498 3.39296 12.0194 2.0628C10.6893 0.73265 8.92081 0 7.03943 0C5.15828 0 3.3896 0.73265 2.05945 2.0628C-0.686483 4.80897 -0.686483 9.27707 2.05945 12.0228C3.3896 13.3532 5.15828 14.0858 7.03943 14.0858C8.60042 14.0856 10.0797 13.5746 11.2993 12.643L14.3733 15.717C14.5582 15.9022 14.801 15.9947 15.0435 15.9947C15.286 15.9947 15.5288 15.9022 15.7137 15.717C16.0839 15.347 16.0839 14.7467 15.7137 14.3767ZM3.39979 10.6824C1.39298 8.67563 1.39321 5.41018 3.39979 3.40314C4.37195 2.43121 5.66461 1.89573 7.03943 1.89573C8.41448 1.89573 9.70691 2.43121 10.6791 3.40314C11.6512 4.3753 12.1867 5.66797 12.1867 7.04279C12.1867 8.41784 11.6512 9.71027 10.6791 10.6824C9.70691 11.6546 8.41448 12.1901 7.03943 12.1901C5.66461 12.1901 4.37195 11.6546 3.39979 10.6824Z" fill="#FCC020" />
                                    </svg>

                                </div>

                            </div>
                        </div>
                        <div class="pagina-quantidade">
                            <div class="area_select_input_total dropdown-menu-container" id="dropdown-cursos">
                                <div class="title_select_input">
                                    <h2>
                                        Pagina
                                    </h2>
                                </div>
                                <div class="area_select_input" class="dropdown-toggle" onclick="toggleDropdownQuantidade(this)">
                                    <h2 id="dropdown-pagina-conclusoes">1</h2>
                                    <img src="img/set_form.svg" alt="">

                                    <div class="area_drop_down_quantidade">
                                        <ul id="lista-quantidade-paginas-conclusoes" class="area_drop_down_quantidade_int">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="area_select_input_total dropdown-menu-container" id="dropdown-cursos">
                                <div class="title_select_input">
                                    <h2>
                                        Mostrar
                                    </h2>
                                </div>
                                <div class="area_select_input" class="dropdown-toggle" onclick="toggleDropdownQuantidade(this)">
                                    <h2 id="dropdown-quantidade-conclusoes">5</h2>
                                    <img src="img/set_form.svg" alt="">

                                    <div class="area_drop_down_quantidade">
                                        <ul class="area_drop_down_quantidade_int">
                                            <li onclick="selectQuantidadeConclusao(this)">5</li>
                                            <li onclick="selectQuantidadeConclusao(this)">10</li>
                                            <li onclick="selectQuantidadeConclusao(this)">15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="limita_tabela">
                        <table id="table_usuarios_concluidos" class="bordered striped centered highlight responsive-table">
                            <thead class="bg_nomes">
                                <tr>
                                    <th class="area_icons_tabela" id="col_nome_curso" scope="col">
                                        Nome do Curso
                                        <img src="img/sets_tabela.svg" alt="" class="icon_tabela asc" onclick="sortTable(0, 'nome_curso')">
                                    </th>
                                    <th class="area_icons_tabela" id="col_nome_aluno" scope="col">
                                        Nome do Aluno
                                        <img src="img/sets_tabela.svg" alt="" class="icon_tabela asc" onclick="sortTable(1, 'nome_aluno')">
                                    </th>
                                    <th class="area_icons_tabela" id="col_data_conclusao" scope="col">
                                        Data de Conclusão
                                        <img src="img/sets_tabela.svg" alt="" class="icon_tabela asc" onclick="sortTable(2, 'data_conclusao')">
                                    </th>
                                    <th class="area_icons_tabela" id="col_data_inscricao" scope="col">
                                        Data de Inscrição
                                        <img src="img/sets_tabela.svg" alt="" class="icon_tabela asc" onclick="sortTable(3, 'data_inscricao')">
                                    </th>
                                    <th class="area_icons_tabela" id="col_categoria" scope="col">
                                        Categoria
                                        <img src="img/sets_tabela.svg" alt="" class="icon_tabela asc" onclick="sortTable(4, 'categoria')">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tabelaConcluidos">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


        </div>

    </div>
    </div>
    </div>


    <?php include 'footer.php' ?>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.min.js" integrity="sha512-TJ7U6JRJx5IpyvvO9atNnBzwJIoZDaQnQhb0Wmw32Rj5BQHAmJG16WzaJbDns2Wk5VG6gMt4MytZApZG47rCdg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/script.js"></script>
    <script src="js/graficos_administrativo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>