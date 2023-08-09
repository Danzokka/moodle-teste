<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel administrativo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
</head>

<body>
    <?php include 'header.php' ?>


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
                                        Matrículas
                                        abertas
                                    </h2>
                                </div>
                            </div>

                            <div class="info_matriculas_2">
                                <div class="info_numeros_matriculas">
                                    <h2>
                                        12
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

                            <div class="info_matriculas_2">
                                <div class="info_numeros_matriculas">
                                    <h2>
                                        12
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

                            <div class="info_matriculas_2">
                                <div class="info_numeros_matriculas">
                                    <h2>
                                        12
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

                            <div class="info_matriculas_2">
                                <div class="info_numeros_matriculas ativo">
                                    <h2>
                                        12
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
                                    <input class="input_curso" type="text" name="curso" placeholder="Por curso">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.7137 14.3767L12.6397 11.3027C13.5713 10.0831 14.0822 8.60377 14.0824 7.04279C14.0824 5.16164 13.3498 3.39296 12.0194 2.0628C10.6893 0.73265 8.92081 0 7.03943 0C5.15828 0 3.3896 0.73265 2.05945 2.0628C-0.686483 4.80897 -0.686483 9.27707 2.05945 12.0228C3.3896 13.3532 5.15828 14.0858 7.03943 14.0858C8.60042 14.0856 10.0797 13.5746 11.2993 12.643L14.3733 15.717C14.5582 15.9022 14.801 15.9947 15.0435 15.9947C15.286 15.9947 15.5288 15.9022 15.7137 15.717C16.0839 15.347 16.0839 14.7467 15.7137 14.3767ZM3.39979 10.6824C1.39298 8.67563 1.39321 5.41018 3.39979 3.40314C4.37195 2.43121 5.66461 1.89573 7.03943 1.89573C8.41448 1.89573 9.70691 2.43121 10.6791 3.40314C11.6512 4.3753 12.1867 5.66797 12.1867 7.04279C12.1867 8.41784 11.6512 9.71027 10.6791 10.6824C9.70691 11.6546 8.41448 12.1901 7.03943 12.1901C5.66461 12.1901 4.37195 11.6546 3.39979 10.6824Z"
                                            fill="#FCC020" />
                                    </svg>

                                </div>

                            </div>

                            <div class="area_input_andamento">
                                <div class="title_input_andamento">
                                    <h2>
                                        Excluir
                                    </h2>
                                </div>
                                <div class="area_input_curso">
                                    <input class="input_curso" type="text" name="excluir" placeholder="Excluir">
                                    <svg width="15" height="17" viewBox="0 0 15 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.5477 1.89479H11.1792V1.42109C11.1792 0.637503 10.5417 0 9.75807 0H5.96849C5.1849 0 4.5474 0.637503 4.5474 1.42109V1.89479H2.17891C1.39532 1.89479 0.757812 2.53229 0.757812 3.31589C0.757812 3.94521 1.16914 4.47995 1.73695 4.66627L2.58187 14.8658C2.64272 15.5965 3.26478 16.1689 3.99803 16.1689H11.7285C12.4618 16.1689 13.0839 15.5965 13.1448 14.8656L13.9896 4.66624C14.5574 4.47995 14.9687 3.94521 14.9687 3.31589C14.9687 2.53229 14.3312 1.89479 13.5477 1.89479ZM5.49479 1.42109C5.49479 1.1599 5.70729 0.947396 5.96849 0.947396H9.75807C10.0193 0.947396 10.2318 1.1599 10.2318 1.42109V1.89479H5.49479V1.42109ZM12.2006 14.7871C12.1803 15.0307 11.973 15.2215 11.7285 15.2215H3.99803C3.75364 15.2215 3.54628 15.0307 3.52604 14.7874L2.69347 4.73698H13.0331L12.2006 14.7871ZM13.5477 3.78958H2.17891C1.91771 3.78958 1.70521 3.57708 1.70521 3.31589C1.70521 3.05469 1.91771 2.84219 2.17891 2.84219H13.5477C13.8089 2.84219 14.0214 3.05469 14.0214 3.31589C14.0214 3.57708 13.8089 3.78958 13.5477 3.78958Z"
                                            fill="#FCC020" />
                                        <path
                                            d="M5.96709 13.7711L5.49339 6.12873C5.47719 5.8676 5.25117 5.66899 4.9913 5.68526C4.73017 5.70146 4.53163 5.92624 4.5478 6.18735L5.02149 13.8297C5.03706 14.0809 5.24562 14.2741 5.49383 14.2741C5.76817 14.2741 5.98392 14.0431 5.96709 13.7711Z"
                                            fill="#FCC020" />
                                        <path
                                            d="M7.86237 5.68433C7.60076 5.68433 7.38867 5.89642 7.38867 6.15802V13.8004C7.38867 14.062 7.60076 14.274 7.86237 14.274C8.12398 14.274 8.33607 14.062 8.33607 13.8004V6.15802C8.33607 5.89642 8.12398 5.68433 7.86237 5.68433Z"
                                            fill="#FCC020" />
                                        <path
                                            d="M10.7345 5.68525C10.474 5.66905 10.2486 5.86759 10.2324 6.12873L9.75873 13.7711C9.74259 14.0322 9.94114 14.2569 10.2022 14.2731C10.4635 14.2893 10.6882 14.0907 10.7043 13.8297L11.178 6.18734C11.1942 5.92621 10.9957 5.70142 10.7345 5.68525Z"
                                            fill="#FCC020" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="area_select_input_total">
                            <div class="title_select_input">
                                <h2>
                                    Mostrar
                                </h2>
                            </div>
                            <div class="area_select_input_points">
                                <div class="area_select_input">
                                    <h2>10</h2>
                                    <img src="img/set_form.svg" alt="">
                                </div>
                                <img src="img/points_form.svg" alt="">
                            </div>

                        </div>

                    </div>

                    <table id="table_administrativo" class="bordered striped centered highlight responsive-table">
                        <thead class="bg_nomes">
                            <tr>
                                <th>Nome do Curso</th>
                                <th>Categoria</th>
                                <th>Matriculado</th>
                                <th>Concluído</th>
                                <th>Não foi iniciado</th>
                                <th>Em andamento</th>
                                <th>Pelo menos uma Atividade Iniciada</th>
                                <th>Atividades totais</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="title_tabela">Biologia do Ensino Médio</td>
                                <td>Diversos</td>
                                <td class="area_matriculado_tabela">
                                    1848
                                    <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="_x32_-Magnifying_Glass">
                                            <path id="Vector"
                                                d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                fill="#FCC020" />
                                        </g>
                                    </svg>

                                </td>
                                <td>29</td>
                                <td>697</td>
                                <td>1120</td>
                                <td>1120</td>
                                <td>1120</td>
                            </tr>
                            <tr>
                                <td class="title_tabela">Biologia do Ensino Médio</td>
                                <td>Diversos</td>
                                <td class="area_matriculado_tabela">
                                    1848
                                    <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="_x32_-Magnifying_Glass">
                                            <path id="Vector"
                                                d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                fill="#FCC020" />
                                        </g>
                                    </svg>

                                </td>
                                <td>29</td>
                                <td>697</td>
                                <td>1120</td>
                                <td>1120</td>
                                <td>1120</td>
                            </tr>
                            <tr>
                                <td class="title_tabela">Biologia do Ensino Médio</td>
                                <td>Diversos</td>
                                <td class="area_matriculado_tabela">
                                    1848
                                    <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="_x32_-Magnifying_Glass">
                                            <path id="Vector"
                                                d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                fill="#FCC020" />
                                        </g>
                                    </svg>

                                </td>
                                <td>29</td>
                                <td>697</td>
                                <td>1120</td>
                                <td>1120</td>
                                <td>1120</td>
                            </tr>
                            <tr>
                                <td class="title_tabela">Biologia do Ensino Médio</td>
                                <td>Diversos</td>
                                <td class="area_matriculado_tabela">
                                    1848
                                    <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="_x32_-Magnifying_Glass">
                                            <path id="Vector"
                                                d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                fill="#FCC020" />
                                        </g>
                                    </svg>

                                </td>
                                <td>29</td>
                                <td>697</td>
                                <td>1120</td>
                                <td>1120</td>
                                <td>1120</td>
                            </tr>
                        </tbody>
                    </table>
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
                                    <p>
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
                                    <p>
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
                                    <p>
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
                                    <p>
                                        1.879/23.567
                                    </p>
                                </div>
                                <div class="sub_title_graficos_texts">
                                    <p>
                                        AAlunos que finalizaram seus cursos nos últimos 30 dias
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

                <div class="area_select_curso_total">
                    <div class="title_select_curso">
                        <h2>
                            Curso
                        </h2>
                    </div>
                    <div class="area_select_curso">
                        <h2>Biologia do ensino médio</h2>
                        <img src="img/set_form.svg" alt="">
                    </div>
                </div>

                <div class="area_categoria_conclusao">
                    <div class="title_categoria">
                        <h2>
                            Categoria: diversos
                        </h2>
                    </div>
                    <div class="sub_title_categoria">
                        <p>
                            Biologia do ensino médio
                        </p>
                    </div>
                </div>

                <div class="area_infos_conclusao">
                    <div class="infos_conclusao">
                        <h2>
                            <b>Data de início:</b> 18 de setembro de 2019
                        </h2>
                    </div>
                    <div class="infos_conclusao">
                        <h2>
                            <b>Total de visitas:</b> 7746
                        </h2>
                    </div>
                    <div class="infos_conclusao">
                        <h2>
                            <b>Média visitas:</b> 5
                        </h2>
                    </div>
                    <div class="infos_conclusao">
                        <h2>
                            <b>Média visitas:</b> 5
                        </h2>
                    </div>
                    <div class="infos_conclusao">
                        <h2>
                            <b> Média de tempo gasto:</b> 00:008:09
                        </h2>
                    </div>
                </div>


                <div class="area_infos_conclusao_2">
                    <div class="infos_conclusao_2">
                        <h2>
                            1846
                        </h2>
                        <p>
                            Matriculado
                        </p>
                    </div>
                    <div class="infos_conclusao_2">
                        <h2>
                            29
                        </h2>
                        <p>
                            Concluído
                        </p>
                    </div>
                    <div class="infos_conclusao_2">
                        <h2>
                            <b>25,78%</b>
                            <p>
                                Média progresso
                            </p>
                        </h2>
                    </div>
                    <div class="infos_conclusao_2">
                        <h2>
                            27,92%
                        </h2>
                        <p>
                            Média nota
                        </p>
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
                        <table id="table_populares" class="bordered striped centered highlight responsive-table">
                            <div class="area_title_tabela_populares">
                                <div class="title_tabela_populares">
                                    <h2>
                                        Cursos populares
                                    </h2>
                                </div>
                                <img src="img/points_form.svg" alt="">
                            </div>
                            <div class="area_input_populares">
                                <div class="title_input_andamento">
                                    <h2>
                                        Procurar
                                    </h2>
                                </div>
                                <div class="area_input_curso">
                                    <input class="input_curso_2" type="text" name="curso" placeholder="Por curso">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.7137 14.3767L12.6397 11.3027C13.5713 10.0831 14.0822 8.60377 14.0824 7.04279C14.0824 5.16164 13.3498 3.39296 12.0194 2.0628C10.6893 0.73265 8.92081 0 7.03943 0C5.15828 0 3.3896 0.73265 2.05945 2.0628C-0.686483 4.80897 -0.686483 9.27707 2.05945 12.0228C3.3896 13.3532 5.15828 14.0858 7.03943 14.0858C8.60042 14.0856 10.0797 13.5746 11.2993 12.643L14.3733 15.717C14.5582 15.9022 14.801 15.9947 15.0435 15.9947C15.286 15.9947 15.5288 15.9022 15.7137 15.717C16.0839 15.347 16.0839 14.7467 15.7137 14.3767ZM3.39979 10.6824C1.39298 8.67563 1.39321 5.41018 3.39979 3.40314C4.37195 2.43121 5.66461 1.89573 7.03943 1.89573C8.41448 1.89573 9.70691 2.43121 10.6791 3.40314C11.6512 4.3753 12.1867 5.66797 12.1867 7.04279C12.1867 8.41784 11.6512 9.71027 10.6791 10.6824C9.70691 11.6546 8.41448 12.1901 7.03943 12.1901C5.66461 12.1901 4.37195 11.6546 3.39979 10.6824Z"
                                            fill="#FCC020" />
                                    </svg>

                                </div>

                            </div>

                            <thead class="bg_nomes_populares">
                                <tr>
                                    <th>Classificação</th>
                                    <th>Nome do curso</th>
                                    <th class="area_icons_tabela">
                                        Matricula
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>
                                    <th class="area_icons_tabela">
                                        Visitas
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="trofeu">
                                        <h2>1º</h2>
                                        <img src="img/trofeu_1.svg" alt="">
                                    </td>

                                    <td>
                                        Biologia do Ensino Médio
                                    </td>
                                    <td>1896</td>
                                    <td>1167</td>
                                </tr>
                                <tr>
                                    <td class="trofeu">
                                        <h2>2º</h2>
                                        <img src="img/trofeu_2.svg" alt="">
                                    </td>

                                    <td>
                                        Biologia do Ensino Médio
                                    </td>
                                    <td>1896</td>
                                    <td>1167</td>
                                </tr>
                                <tr>
                                    <td class="trofeu">
                                        <h2>3º</h2>
                                        <img src="img/trofeu_3.svg" alt="">
                                    </td>

                                    <td>
                                        Biologia do Ensino Médio
                                    </td>
                                    <td>1896</td>
                                    <td>1167</td>
                                </tr>

                                <tr>
                                    <td class="trofeu">
                                        <h2>4º</h2>
                                        <img src="img/trofeu_3.svg" alt="">
                                    </td>

                                    <td>
                                        Biologia do Ensino Médio
                                    </td>
                                    <td>1896</td>
                                    <td>1167</td>
                                </tr>

                                <tr>
                                    <td class="trofeu">
                                        <h2>5º</h2>
                                        <img src="img/trofeu_3.svg" alt="">
                                    </td>

                                    <td>
                                        Biologia do Ensino Médio
                                    </td>
                                    <td>1896</td>
                                    <td>1167</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>


                <div class="area_tabela_2">

                    <div class="title_tabela_2">
                        <h2>
                            Conclusão de cursos
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
                                        <input class="input_curso_2" type="text" name="curso" placeholder="Por curso">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.7137 14.3767L12.6397 11.3027C13.5713 10.0831 14.0822 8.60377 14.0824 7.04279C14.0824 5.16164 13.3498 3.39296 12.0194 2.0628C10.6893 0.73265 8.92081 0 7.03943 0C5.15828 0 3.3896 0.73265 2.05945 2.0628C-0.686483 4.80897 -0.686483 9.27707 2.05945 12.0228C3.3896 13.3532 5.15828 14.0858 7.03943 14.0858C8.60042 14.0856 10.0797 13.5746 11.2993 12.643L14.3733 15.717C14.5582 15.9022 14.801 15.9947 15.0435 15.9947C15.286 15.9947 15.5288 15.9022 15.7137 15.717C16.0839 15.347 16.0839 14.7467 15.7137 14.3767ZM3.39979 10.6824C1.39298 8.67563 1.39321 5.41018 3.39979 3.40314C4.37195 2.43121 5.66461 1.89573 7.03943 1.89573C8.41448 1.89573 9.70691 2.43121 10.6791 3.40314C11.6512 4.3753 12.1867 5.66797 12.1867 7.04279C12.1867 8.41784 11.6512 9.71027 10.6791 10.6824C9.70691 11.6546 8.41448 12.1901 7.03943 12.1901C5.66461 12.1901 4.37195 11.6546 3.39979 10.6824Z"
                                                fill="#FCC020" />
                                        </svg>

                                    </div>

                                </div>

                                <div class="area_input_andamento">
                                    <div class="title_input_andamento">
                                        <h2>
                                            Excluir
                                        </h2>
                                    </div>
                                    <div class="area_input_curso">
                                        <input class="input_curso_2" type="text" name="excluir" placeholder="Excluir">
                                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.5477 1.89479H11.1792V1.42109C11.1792 0.637503 10.5417 0 9.75807 0H5.96849C5.1849 0 4.5474 0.637503 4.5474 1.42109V1.89479H2.17891C1.39532 1.89479 0.757812 2.53229 0.757812 3.31589C0.757812 3.94521 1.16914 4.47995 1.73695 4.66627L2.58187 14.8658C2.64272 15.5965 3.26478 16.1689 3.99803 16.1689H11.7285C12.4618 16.1689 13.0839 15.5965 13.1448 14.8656L13.9896 4.66624C14.5574 4.47995 14.9687 3.94521 14.9687 3.31589C14.9687 2.53229 14.3312 1.89479 13.5477 1.89479ZM5.49479 1.42109C5.49479 1.1599 5.70729 0.947396 5.96849 0.947396H9.75807C10.0193 0.947396 10.2318 1.1599 10.2318 1.42109V1.89479H5.49479V1.42109ZM12.2006 14.7871C12.1803 15.0307 11.973 15.2215 11.7285 15.2215H3.99803C3.75364 15.2215 3.54628 15.0307 3.52604 14.7874L2.69347 4.73698H13.0331L12.2006 14.7871ZM13.5477 3.78958H2.17891C1.91771 3.78958 1.70521 3.57708 1.70521 3.31589C1.70521 3.05469 1.91771 2.84219 2.17891 2.84219H13.5477C13.8089 2.84219 14.0214 3.05469 14.0214 3.31589C14.0214 3.57708 13.8089 3.78958 13.5477 3.78958Z"
                                                fill="#FCC020" />
                                            <path
                                                d="M5.96709 13.7711L5.49339 6.12873C5.47719 5.8676 5.25117 5.66899 4.9913 5.68526C4.73017 5.70146 4.53163 5.92624 4.5478 6.18735L5.02149 13.8297C5.03706 14.0809 5.24562 14.2741 5.49383 14.2741C5.76817 14.2741 5.98392 14.0431 5.96709 13.7711Z"
                                                fill="#FCC020" />
                                            <path
                                                d="M7.86237 5.68433C7.60076 5.68433 7.38867 5.89642 7.38867 6.15802V13.8004C7.38867 14.062 7.60076 14.274 7.86237 14.274C8.12398 14.274 8.33607 14.062 8.33607 13.8004V6.15802C8.33607 5.89642 8.12398 5.68433 7.86237 5.68433Z"
                                                fill="#FCC020" />
                                            <path
                                                d="M10.7345 5.68525C10.474 5.66905 10.2486 5.86759 10.2324 6.12873L9.75873 13.7711C9.74259 14.0322 9.94114 14.2569 10.2022 14.2731C10.4635 14.2893 10.6882 14.0907 10.7043 13.8297L11.178 6.18734C11.1942 5.92621 10.9957 5.70142 10.7345 5.68525Z"
                                                fill="#FCC020" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="area_select_input_total">
                                <div class="title_select_input">
                                    <h2>
                                        Mostrar
                                    </h2>
                                </div>
                                <div class="area_select_input">
                                    <h2>10</h2>
                                    <img src="img/set_form.svg" alt="">
                                </div>
                            </div>

                        </div>

                        <table id="table_administrativo" class="bordered striped centered highlight responsive-table">
                            <thead class="bg_nomes">
                                <tr>
                                    <th class="area_icons_tabela">
                                        Nome
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>
                                    <th class="area_icons_tabela">
                                        E-mail
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>

                                    <th class="area_icons_tabela">
                                        Data de emissão
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>
                                    <th class="area_icons_tabela">
                                        Data de inscrição
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>
                                    <th class="area_icons_tabela">
                                        Nota
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>
                                    <th class="area_icons_tabela">
                                        Progresso
                                        <img src="img/sets_tabela.svg" alt="">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--<tr>
                                    <td class="title_tabela">Biologia do Ensino Médio</td>
                                    <td>Diversos</td>
                                    <td class="area_matriculado_tabela">
                                        1848
                                        <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="_x32_-Magnifying_Glass">
                                                <path id="Vector"
                                                    d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                    fill="#FCC020" />
                                            </g>
                                        </svg>
    
                                    </td>
                                    <td>29</td>
                                    <td>697</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                </tr>
                                <tr>
                                    <td class="title_tabela">Biologia do Ensino Médio</td>
                                    <td>Diversos</td>
                                    <td class="area_matriculado_tabela">
                                        1848
                                        <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="_x32_-Magnifying_Glass">
                                                <path id="Vector"
                                                    d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                    fill="#FCC020" />
                                            </g>
                                        </svg>
    
                                    </td>
                                    <td>29</td>
                                    <td>697</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                </tr>
                                <tr>
                                    <td class="title_tabela">Biologia do Ensino Médio</td>
                                    <td>Diversos</td>
                                    <td class="area_matriculado_tabela">
                                        1848
                                        <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="_x32_-Magnifying_Glass">
                                                <path id="Vector"
                                                    d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                    fill="#FCC020" />
                                            </g>
                                        </svg>
    
                                    </td>
                                    <td>29</td>
                                    <td>697</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                </tr>
                                <tr>
                                    <td class="title_tabela">Biologia do Ensino Médio</td>
                                    <td>Diversos</td>
                                    <td class="area_matriculado_tabela">
                                        1848
                                        <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="_x32_-Magnifying_Glass">
                                                <path id="Vector"
                                                    d="M10.809 9.88931L8.69446 7.77478C9.3353 6.93586 9.68677 5.91829 9.68691 4.84453C9.68691 3.55054 9.18294 2.33392 8.26781 1.41894C7.35283 0.503969 6.13637 0 4.84222 0C3.54824 0 2.33161 0.503969 1.41664 1.41894C-0.472212 3.30795 -0.472212 6.38143 1.41664 8.27012C2.33161 9.18525 3.54824 9.68922 4.84222 9.68922C5.91598 9.68908 6.93355 9.33761 7.77248 8.69676L9.887 10.8113C10.0142 10.9386 10.1812 11.0023 10.348 11.0023C10.5148 11.0023 10.6818 10.9386 10.809 10.8113C11.0637 10.5568 11.0637 10.1438 10.809 9.88931ZM2.33862 7.34814C0.958193 5.96772 0.958352 3.7215 2.33862 2.34092C3.00734 1.67236 3.89652 1.30402 4.84222 1.30402C5.78808 1.30402 6.67711 1.67236 7.34583 2.34092C8.01455 3.00965 8.3829 3.89883 8.3829 4.84453C8.3829 5.79039 8.01455 6.67942 7.34583 7.34814C6.67711 8.01686 5.78808 8.38521 4.84222 8.38521C3.89652 8.38521 3.00734 8.01686 2.33862 7.34814Z"
                                                    fill="#FCC020" />
                                            </g>
                                        </svg>
    
                                    </td>
                                    <td>29</td>
                                    <td>697</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                    <td>1120</td>
                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>
    </div>
    </div>


    <?php include 'footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.min.js"
        integrity="sha512-TJ7U6JRJx5IpyvvO9atNnBzwJIoZDaQnQhb0Wmw32Rj5BQHAmJG16WzaJbDns2Wk5VG6gMt4MytZApZG47rCdg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/script.js"></script>
    <script>

        const data5 = {
            labels: [
                '1º Microsoft excel', '2º Agricultura Familiar ', '3º  Defesa Agropecuária', '4º Planejamento estratégico', '5º Gerenciamento de crise'
            ],
            datasets: [{
                axis: 'y',
                label: 'Cursos com mais inscrições',
                data: [5500, 3000, 3400, 3600, 3800],
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

        const data2 = {
           /* labels: [
                'Alunos'
            ],
                */
            datasets: [{
                label: '',
                data: [10, 80, 50, 20],
                backgroundColor: [
                    'rgba(252, 192, 32, 1)',
                    'rgba(4, 191, 218, 1)',
                    'rgba(247, 104, 24, 1)',
                    'rgba(90, 92, 81, 1)'
                ],
                hoverOffset: 4
            }],

        };

        var chart2 = document.getElementsByClassName('doughnut-chart');

        var chartGraph2 = new Chart(chart2, {
            type: 'doughnut',
            data: data2,
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

        var chart3 = document.getElementsByClassName('doughnut-chart_2');

        var chartGraph2 = new Chart(chart3, {
            type: 'doughnut',
            data: data2,
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

        var chart4 = document.getElementsByClassName('doughnut-chart_3');

        var chartGraph2 = new Chart(chart4, {
            type: 'doughnut',
            data: data2,
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


        var chart5 = document.getElementsByClassName('doughnut-chart_4');

        var chartGraph2 = new Chart(chart5, {
            type: 'doughnut',
            data: data2,
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

    </script>
</body>

</html>