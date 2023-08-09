<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style-adicional-index-dash.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/01d22bbb46.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>

    <?php include 'header_2.php' ?>

    <div class="container_ead_flex">
        <div class="container_ead_flex_int">
            <div class="area_ead_flex">
                <div class="area_categoria">

                    <div class="dropdown-menu">
                        <div>
                            <ul class="menu-list">
                                <div class="area_pesquisa_dropdown">
                                    <input id="select_categoria" type="text" class="pesquisa_dropdown" placeholder="Pesquisar">
                                </div>
                                <div id="categorias"></div>
                            </ul>
                        </div>
                    </div>
                    <div class="categoria_ead_flex dropdown-menu-container" id="periodo-inicial">
                        <h2 class="dropdown-toggle" onclick="toggleDropdown(this)">
                            <i class="fa-regular fa-calendar" style="color: #898989; width: 10px; padding-right: 20px;"></i> Periodo Inicial <img src="img/para_baixo.svg" alt="" style="width: 15px;">
                        </h2>
                        <div class="dropdown-menu">
                            <div>
                                <input type="date" id="input-periodo-inicial">
                            </div>
                            <div class="add-filters">
                                <div class="btn_filtro" onclick="adicionarFiltro('periodo-inicial'); pegarFiltros();">Adicionar Filtros
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="categoria_ead_flex dropdown-menu-container" id="periodo-final">
                        <h2 class="dropdown-toggle" onclick="toggleDropdown(this)">
                            <i class="fa-regular fa-calendar" style="color: #898989; width: 10px; padding-right: 20px;"></i> Periodo Final <img src="img/para_baixo.svg" alt="" style="width: 15px;">
                        </h2>
                        <div class="dropdown-menu">
                            <div>
                                <input type="date" id="input-periodo-final">
                            </div>
                            <div class="add-filters">
                                <div class="btn_filtro" onclick="adicionarFiltro('periodo-final'); pegarFiltros();">Adicionar Filtros
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-menu">
                        <div>
                            <ul class="menu-list">
                                <div class="area_pesquisa_dropdown">
                                    <input id="select_curso" type="text" class="pesquisa_dropdown" placeholder="Pesquisar">
                                </div>
                                <div id="cursos">
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="title_ead_flex">
                    <h2>
                        ChildFund Dashboard
                    </h2>
                </div>

                <div class="area_info_dashboard_1">
                    <div class="area_info_dashboard_1_int">
                        <div class="info_dashboard">
                            <img src="img/ead_flex_1.svg" alt="">

                            <div class="area_texts_dashboard">
                                <div class="title_info_dashboard">
                                    <h2 id="users">

                                    </h2>
                                </div>
                                <div class="sub_title_info_dashboard">
                                    <p>
                                        Usuários inscritos
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="info_dashboard">
                            <img src="img/ead_flex_2.svg" alt="">

                            <div class="area_texts_dashboard">
                                <div class="title_info_dashboard">
                                    <h2 id="curso">

                                    </h2>
                                </div>
                                <div class="sub_title_info_dashboard">
                                    <p>
                                        Total de cursos
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="info_dashboard">
                            <img src="img/ead_flex_3.svg" alt="">

                            <div class="area_texts_dashboard">
                                <div class="title_info_dashboard">
                                    <h2 id="matriculas">

                                    </h2>
                                </div>
                                <div class="sub_title_info_dashboard">
                                    <p>
                                        Matrículas
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="info_dashboard">
                            <img src="img/ead_flex_4.svg" alt="">

                            <div class="area_texts_dashboard">
                                <div class="title_info_dashboard">
                                    <h2 id="acessosUltimoMes">

                                    </h2>
                                </div>
                                <div class="sub_title_info_dashboard">
                                    <p>
                                        Acesso últimos 30 dias
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="info_dashboard">
                            <img src="img/ead_flex_5.svg" alt="">

                            <div class="area_texts_dashboard">
                                <div class="title_info_dashboard">
                                    <h2 id="nuncaAcessaram">

                                    </h2>
                                </div>
                                <div class="sub_title_info_dashboard">
                                    <p>
                                        Nunca acessaram plataforma
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="area_info_dashboard_2">
                    <div class="info_dashboard_2">
                        <div class="info_dashboard_2_int">
                            <div class="info_matriculas">
                                <img src="img/ead_flex_1.svg" alt="">

                                <div class="title_info_matriculas">
                                    <h2>
                                        Matrículas
                                        abertas
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnMatriculasAbertas">
                                <div class="info_numeros_matriculas">
                                    <h2 id="matriculasAbertas">

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
                                        Matrículas encerradas
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnMatriculasEncerradas">
                                <div class="info_numeros_matriculas">
                                    <h2 id="matriculasEncerradas">

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
                                        do curso
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnConclusoes">
                                <div class="info_numeros_matriculas">
                                    <h2 id="conclusoes">

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
                                        Usuários
                                        ativos
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2" id="btnUsuariosAtivos">
                                <div class="info_numeros_matriculas ativo">
                                    <h2 id="usuariosAtivos">

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


    <div class="container_graficos_cursos">
        <div class="container_graficos_cursos_int">
            <div class="area_graficos_cursos">
                <div class="area_info_grafico_curso">
                    <canvas id="grafico-de-linha" class="line-chart"></canvas>
                </div>

                <div class="area_status_curso">
                    <canvas id="status-alunos-cursos" class="doughnut-chart"></canvas>
                </div>

            </div>
            <div class="area_graficos_cursos">
                <div class="area_info_grafico_curso">
                    <canvas id="inscricoes-por-estado" class="line-chart-2"></canvas>
                </div>

                <div class="area_status_curso">
                    <canvas id="inscricoes-por-genero" class="doughnut-chart-2"></canvas>
                </div>

            </div>
        </div>
    </div>


    <div class="container_inscricoes">
        <div class="container_inscricoes_int">
            <div class="area_inscricoes">
                <div class="graficos_inscricoes">
                    <canvas id="inscricoes-por-categoria" class="bar-chart-1"></canvas>
                </div>
                <div class="graficos_inscricoes">
                    <canvas id="inscricoes-por-perfil" class="bar-chart-2"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="container_alunos">
        <div class="container_alunos_int">
            <div class="title_alunos">
                <h2>
                    Informações dos alunos
                </h2>
            </div>
            <div class="area_alunos">
                <div class="graficos_alunos">
                    <canvas id="cadastros-estados" class="line-chart-3"></canvas>
                </div>
                <div class="graficos_alunos_regiao">
                    <canvas id="cadastros-regiao" class="doughnut-chart-3"></canvas>
                </div>
            </div>

            <div class="area_alunos_2">
                <div class="graficos_alunos_2">
                    <canvas id="faixaXperfil" class="bar-chart-3"></canvas>
                </div>
                <div class="graficos_alunos_2">
                    <canvas id="deficiencias" class="doughnut-chart-5"></canvas>
                </div>
            </div>

            <div class="area_alunos_2">
                <div class="graficos_alunos_2">
                    <canvas id="cadastros-genero" class="doughnut-chart-6"></canvas>
                </div>
                <div class="graficos_alunos_2">
                    <canvas id="cadastros-escolaridade" class="bar-chart-4"></canvas>
                </div>
            </div>

        </div>
    </div>



    <?php include 'footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.min.js" integrity="sha512-TJ7U6JRJx5IpyvvO9atNnBzwJIoZDaQnQhb0Wmw32Rj5BQHAmJG16WzaJbDns2Wk5VG6gMt4MytZApZG47rCdg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/script.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/graficos.js"></script>
</body>

</html>