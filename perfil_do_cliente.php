<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do cliente</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-adicional-perfil-adicional.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
</head>

<body>
   
<?php

//config.php está incluído dentro d lib.php
include 'lib.php';

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => $urlUsuarioId.$_GET['id'],
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'x-wstoken: '.$x_wstoken,
    'x-url: '.$x_url,
    'Authorization: '.$Authorization
),
));
$response = curl_exec($curl);
curl_close($curl);
$retorno = json_decode($response);


$curlRanking = curl_init();
curl_setopt_array($curlRanking, array(
CURLOPT_URL => $urlranking,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'x-wstoken: '.$x_wstoken,
    'x-url: '.$x_url,
    'Authorization: '.$Authorization
),
)); 
$responseRanking = curl_exec($curlRanking);
curl_close($curlRanking);
$retornoRanking = json_decode($responseRanking);


$curlJornada = curl_init();
curl_setopt_array($curlJornada, array(
CURLOPT_URL => $urljornada.$_GET['id'],
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'x-wstoken: '.$x_wstoken,
    'x-url: '.$x_url,
    'Authorization: '.$Authorization
),
)); 
$responseJornada = curl_exec($curlJornada);
curl_close($curlJornada);
$retJornada = json_decode($responseJornada);
$retornoJornadas = $retJornada->jornada;


$curlCursoAndamento = curl_init();
curl_setopt_array($curlCursoAndamento, array(
CURLOPT_URL => $urlCursoAndamento.$_GET['id'],
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'x-wstoken: '.$x_wstoken,
    'x-url: '.$x_url,
    'Authorization: '.$Authorization
),
)); 
$responseCursoAndamento = curl_exec($curlCursoAndamento);
curl_close($curlCursoAndamento);
$retCursoAndamento = json_decode($responseCursoAndamento);
$retornoCursoAndamentos = $retCursoAndamento->cursos_andamento;

$curlCursoInscriAbertas = curl_init();
curl_setopt_array($curlCursoInscriAbertas, array(
CURLOPT_URL => $urlCursoInscricoesAbertas,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'x-wstoken: '.$x_wstoken,
    'x-url: '.$x_url,
    'Authorization: '.$Authorization
),
));  
$responseCursoInscriAbertas = curl_exec($curlCursoInscriAbertas);
curl_close($curlCursoInscriAbertas);
$retCursoInscriAbertas = json_decode($responseCursoInscriAbertas);
$retornoCursoInscriAbertas = $retCursoInscriAbertas->inscricoes_abertas;


$curlCursosConcluidos = curl_init();
curl_setopt_array($curlCursosConcluidos, array(
CURLOPT_URL => $urlCursosConcluidos.$_GET['id'],
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'x-wstoken: '.$x_wstoken,
    'x-url: '.$x_url,
    'Authorization: '.$Authorization
),
));
$responseCursosConcluidos = curl_exec($curlCursosConcluidos);
curl_close($curlCursosConcluidos);
$retCursosConcluidos = json_decode($responseCursosConcluidos);
$retornoCursosConcluidos = $retCursosConcluidos->cursos_finalizados;

include 'header.php';
?> 

    <div class="container_1">
        <div class="container_1_int">
            <div class="area_container_1">
                <div class="card_perfil">
                    <div class="card_perfil_int">
                        <img src="<?php echo $retorno->imagem; ?>" class="imagemPerfil" alt="">

                        <div class="title_perfil">
                            <h2>
                               <?php echo $retorno->fullname; ?>
                            </h2>
                        </div>
                        <div class="info_perfil">
                            <p>
                                E-mail: <?=$retorno->email; ?>
                            </p>
                            <p>
                                Data de nascimento: <?=date('d/m/Y', substr($retorno->dtnascimento,0,11)); ?>
                            </p>
                            <p>
                                WhatsApp: <?=$retorno->celular; ?>
                            </p>
                            <p>
                               &nbsp; 
                            </p>
                        </div>

                        <a href="#">
                            <div class="btn_perfil">
                                <h2>
                                    Atualizar Perfil
                                </h2>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="card_ranking">
                    <div class="card_ranking_int">
                        <img src="img_perfil/ranking.svg" alt="">

                        <div class="title_ranking">
                            <h2>
                                Ranking
                            </h2>
                        </div>
                        <div class="area_ranking_total">
                            <?php 
                            $contaranking = 0;
                            foreach($retornoRanking->ranking as $ranking){
                                $contaranking ++;
                                ?>
                                <div class="area_ranking">
                                    <div class="area_ranking_int">
                                        <img src="<?=$ranking->imagem;?>" class="imagemRanking" alt="">

                                        <div class="rankings">
                                            <div class="numero">
                                                <?=$contaranking?>º
                                            </div>
                                            <div class="nome_ranking">
                                                <h2>
                                                <?=$ranking->Nome;?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="xp_ranking">
                                        <h2>
                                            <?=$ranking->pontuacao;?> xp
                                        </h2>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="card_tempo">
                    <div class="card_tempo_int">
                        <div class="area_tempo">
                            <img src="img_perfil/clock.svg" alt="">

                            <div class="title_tempo">
                                <h2>
                                    Tempo de uso
                                </h2>
                            </div>

                            <div class="info_tempo">
                                <p>
                                    Inscrito desde: <?=date('d/m/Y', substr($retorno->dtinscricao,0,11)); ?>
                                </p>

                                <p>
                                    último acesso: <?=date('d/m/Y', substr($retorno->lastaccess,0,11)); ?>
                                </p>
                                <p>
                                    Certificados emitidos: <span id="qtdCertificadsoEmitidos">...</span>
                                </p>
                                <p>
                                    Cursos em andamento: <span id="qtdCursoAndamento">...</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <?php foreach ($retornoJornadas as $retornoJornada); ?>
            <div class="area_jornada">
                <div class="area_jornada_int">
                    <div class="area_file">
                        <img src="img_perfil/files.svg" alt="">

                        <div class="title_file">
                            <h2>
                                Sua jornada possui
                            </h2>
                        </div>
                    </div>

                    <div class="area_numeros_jornada">
                        <div class="area_numeros_jornada_int">
                            <div class="info_numeros_jornada">
                                <p>
                                    <?=$retornoJornada->qtdCursosOnline;?>
                                </p>
                            </div>
                            <div class="title_numeros_jornada">
                                <h2>
                                    Cursos
                                    Presenciais
                                </h2>
                            </div>
                        </div>

                        <div class="area_numeros_jornada_int">
                            <div class="info_numeros_jornada">
                                <p>
                                    <?=$retornoJornada->qtdPresencial;?>
                                </p>
                            </div>
                            <div class="title_numeros_jornada">
                                <h2>
                                    Cursos
                                    Presenciais
                                </h2>
                            </div>
                        </div>

                        <div class="area_numeros_jornada_int">
                            <div class="info_numeros_jornada">
                                <p>
                                    <?=$retornoJornada->qtdHibridos;?>
                                </p>
                            </div>
                            <div class="title_numeros_jornada">
                                <h2>
                                    Cursos Híbridos
                                </h2>
                            </div>
                        </div>

                        <div class="area_numeros_jornada_int">
                            <div class="info_numeros_jornada">
                                <p>
                                    <?=$retornoJornada->qtdWebnario;?>
                                </p>
                            </div>
                            <div class="title_numeros_jornada">
                                <h2>
                                    Eventos Online
                                </h2>
                            </div>
                        </div>

                        <div class="area_numeros_jornada_int">
                            <div class="info_numeros_jornada">
                                <p>
                                    <?=$retornoJornada->qtdOficinas;?>
                                </p>
                            </div>
                            <div class="title_numeros_jornada">
                                <h2>
                                    Oficinas
                                </h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container_2">
        <div class="container_2_int">

            <div class="area_btns_cursos">
                <div class="btn_cursos_opcao select" id="curso-em-andamento">
                    <div class="title_btn_cursos_opcao select" id="titulo-curso-em-andamento">
                        <h2>
                            Cursos em andamento
                        </h2>
                    </div>
                </div>
                <div class="btn_cursos_opcao" id="cursos-adquiridos">
                    <div class="title_btn_cursos_opcao" id="titulo-cursos-adquiridos">
                        <h2>
                            Cursos finalizados
                        </h2>
                    </div>
                </div>
                <div class="btn_cursos_opcao" id="loja-de-cursos">
                    <div class="title_btn_cursos_opcao" id="titulo-loja-de-cursos">
                        <h2>
                            Inscrições abertas
                        </h2>
                    </div>
                </div>
            </div>

            <div class="area_container_2_total">
                <div class="area_pesquisa">
                    <div class="area_lupa">
                        <form action="">
                            <img src="img_perfil/lupa.svg" alt="">
                            <input id="aba-pesquisa" type="hidden" value="andamento">
                            <input class="pesquisa" type="text" placeholder="Cursos online disponíveis" required>
                            <input class="enviar" id="buscarDadosCurso" type="button" value="Buscar">
                        </form>
                    </div>

                    <div class="title_cursos_pesquisa" id="titulo-lista-cursos">
                        <h2>
                            Cursos em andamento
                        </h2>
                    </div>
                </div>

                <div class="area_container_2" id="lista-cursos-em-andamento">
                    <?php
                    $contaCursoAdquirido = 0;
                    $contaCursoEmAndamento = 0;
                    $conta = 0;
                    $qtdCursoAndamento = 0;
                    foreach($retornoCursoAndamentos as $linhaCursoAndamentos){

                        if($linhaCursoAndamentos->progresso=="100"){
                            $contaCursoAdquirido ++; 
                        }
                        if($linhaCursoAndamentos->progresso!="100"){
                             $contaCursoEmAndamento ++; 
                        }
                        if($contaCursoAdquirido==4){
                            $contaCursoAdquirido = 0;
                        }
                        if($contaCursoEmAndamento==4){
                            $contaCursoEmAndamento = 0;
                        }
                        $qtdCursoAndamento ++;
                    ?>
                    <div class="card_cursos_online<?php if($linhaCursoAndamentos->progresso=="100"){ echo ' catCursoAdquirido" style="display:none;'; }else{ echo " catCursoEmAndamento";} ?>">
                        <div class="card_cursos_online_int">
                            <div class="area_img_cursos_online">
                                <div class="curso_online_destaque">
                                    <h2>
                                        Cursos Online
                                    </h2>
                                </div>
                                <img src="<?=$linhaCursoAndamentos->imagem?>" alt=""><!-- height: 180px;-->
                            </div>

                            <div class="area_texts_cursos_online">
                                <div class="title_cursos_online">
                                    <h2>
                                        <?=$linhaCursoAndamentos->curso?>
                                    </h2>
                                </div>
                                <div class="sub_title_cursos_online">
                                    <p>
                                        <?=$linhaCursoAndamentos->descricaocurta?>
                                    </p>
                                </div>
                            </div>

                            <img src="img/separador.svg" alt="">

                            <div class="area_info_cursos_online">

                                <div class="area_info_cursos_online_int">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.75 0C7.01942 0 5.32769 0.513178 3.88876 1.47464C2.44983 2.4361 1.32832 3.80267 0.666058 5.40152C0.00379121 7.00037 -0.169488 8.75971 0.168133 10.457C0.505753 12.1544 1.33911 13.7135 2.56282 14.9372C3.78653 16.1609 5.34563 16.9943 7.04296 17.3319C8.7403 17.6695 10.4996 17.4962 12.0985 16.8339C13.6973 16.1717 15.0639 15.0502 16.0254 13.6112C16.9868 12.1723 17.5 10.4806 17.5 8.75C17.5 6.42936 16.5781 4.20376 14.9372 2.56282C13.2962 0.921872 11.0706 0 8.75 0ZM8.75 15.909C7.33409 15.909 5.94997 15.4891 4.77268 14.7025C3.59539 13.9158 2.6778 12.7978 2.13595 11.4896C1.5941 10.1815 1.45233 8.74206 1.72856 7.35335C2.00479 5.96464 2.68662 4.68903 3.68783 3.68782C4.68903 2.68662 5.96464 2.00479 7.35335 1.72856C8.74206 1.45233 10.1815 1.5941 11.4896 2.13595C12.7978 2.67779 13.9159 3.59538 14.7025 4.77267C15.4891 5.94996 15.909 7.33408 15.909 8.75C15.909 10.6487 15.1548 12.4696 13.8122 13.8122C12.4696 15.1548 10.6487 15.909 8.75 15.909Z"
                                            fill="#F76818" />
                                        <path
                                            d="M9.54412 8.42099V3.98199C9.52321 3.7856 9.43038 3.60389 9.28351 3.47183C9.13665 3.33978 8.94613 3.26672 8.74862 3.26672C8.55112 3.26672 8.3606 3.33978 8.21374 3.47183C8.06687 3.60389 7.97404 3.7856 7.95312 3.98199V8.75499C7.95375 8.9657 8.03748 9.16765 8.18612 9.31699L10.5721 11.703C10.6426 11.7903 10.7307 11.8618 10.8306 11.9128C10.9305 11.9639 11.0401 11.9934 11.1521 11.9993C11.2642 12.0053 11.3762 11.9876 11.481 11.9474C11.5858 11.9072 11.6809 11.8455 11.7603 11.7661C11.8396 11.6868 11.9014 11.5916 11.9415 11.4869C11.9817 11.3821 11.9994 11.27 11.9934 11.158C11.9875 11.0459 11.958 10.9364 11.907 10.8365C11.8559 10.7365 11.7844 10.6485 11.6971 10.578L9.54412 8.42099Z"
                                            fill="#F76818" />
                                    </svg>
                                    <div class="title_info_cursos_online">
                                        <h2>
                                            Progresso: <b><?=$linhaCursoAndamentos->progresso;?>%</b>
                                        </h2>
                                    </div>

                                </div>

                                <!--<div class="area_info_cursos_online_int">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.154 9.32196C2.896 9.32196 0 11.809 0 16.322C0 16.4914 0.0673228 16.654 0.187159 16.7738C0.306994 16.8936 0.469527 16.961 0.639 16.961H15.669C15.8385 16.961 16.001 16.8936 16.1208 16.7738C16.2407 16.654 16.308 16.4914 16.308 16.322C16.308 11.81 13.412 9.32196 8.154 9.32196ZM1.301 15.688C1.552 12.311 3.855 10.5999 8.154 10.5999C12.453 10.5999 14.754 12.311 15.007 15.688H1.301Z"
                                            fill="#F76818" />
                                        <path
                                            d="M8.15409 0.464938C7.58846 0.457746 7.02725 0.565269 6.50434 0.781014C5.98143 0.996759 5.50766 1.31625 5.11167 1.72019C4.71567 2.12413 4.40565 2.60414 4.20034 3.13124C3.99502 3.65833 3.89866 4.22157 3.91709 4.78694C3.86858 5.37275 3.9421 5.96225 4.13298 6.51821C4.32387 7.07417 4.62798 7.5845 5.02611 8.01696C5.42424 8.44942 5.90772 8.79461 6.44603 9.03073C6.98434 9.26684 7.56578 9.38875 8.1536 9.38875C8.74141 9.38875 9.32284 9.26684 9.86115 9.03073C10.3995 8.79461 10.8829 8.44942 11.2811 8.01696C11.6792 7.5845 11.9833 7.07417 12.1742 6.51821C12.3651 5.96225 12.4386 5.37275 12.3901 4.78694C12.4085 4.22165 12.3122 3.6585 12.1069 3.13147C11.9017 2.60445 11.5917 2.12448 11.1959 1.72056C10.8 1.31663 10.3263 0.997117 9.80353 0.781312C9.28074 0.565506 8.71963 0.457882 8.15409 0.464938V0.464938ZM8.15409 8.10794C7.32263 8.05638 6.5452 7.67848 5.99102 7.0565C5.43683 6.43452 5.15077 5.61881 5.19509 4.78694C5.17522 4.38915 5.2375 3.99152 5.37806 3.61886C5.51861 3.2462 5.73443 2.90648 6.01204 2.62089C6.28966 2.3353 6.62312 2.10995 6.99166 1.95891C7.36019 1.80786 7.75589 1.73434 8.15409 1.74294C8.5508 1.7397 8.94406 1.81687 9.31012 1.96979C9.67619 2.12271 10.0075 2.34821 10.284 2.63268C10.5605 2.91715 10.7766 3.25469 10.9191 3.62494C11.0615 3.9952 11.1276 4.39048 11.1131 4.78694C11.1574 5.61881 10.8713 6.43452 10.3172 7.0565C9.76298 7.67848 8.98554 8.05638 8.15409 8.10794Z"
                                            fill="#F76818" />
                                    </svg>
                                    <div class="title_info_cursos_online">
                                        <h2>
                                            Público alvo: <b>Estudantes</b>
                                        </h2>
                                    </div>

                                </div>-->
                                <div class="area_btn_info">
                                    <a href="#">
                                        <div class="btn_info_cursos_online animation_btns">
                                            <h2>
                                                Acessar
                                            </h2>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  
                    }                    
                    if($contaCursoAdquirido!=0){                        
                        for ($x = ($contaCursoAdquirido +1); $x <= 4; $x++) {
                            echo '<div class="card_cursos_online catCursoAdquirido" style="display: none; background: transparent; border: none; box-shadow: none; border-radius: 20px;"></div>';
                        }
                    }
                    if($contaCursoEmAndamento!=0){
                        for ($x = ($contaCursoEmAndamento + 1); $x <= 4; $x++) {
                            echo '<div class="card_cursos_online catCursoEmAndamento" style="background: transparent; border: none; box-shadow: none; border-radius: 20px;"></div>';
                        }                        
                    }

                    $contaCursoInsAbertas = 0;
                    foreach($retornoCursoInscriAbertas as $linhaCursoInsAbertas){
                        $contaCursoInsAbertas ++;
                        if($contaCursoInsAbertas==4){
                            $contaCursoInsAbertas = 0;
                        }
                        
                        $publicoAlvo = '';
                        foreach ($linhaCursoInsAbertas as $key => $value) {
                            //echo $key . ": " . $value . "<br>";
                            if(substr($key,0,8)=="publico_" and $value!="0"){
                                $publicoAlvo .= $value . ", ";
                            }
                        }
                    ?>
                    <div class="card_cursos_online catCursoParaInscricao" style="display:none;">
                        <div class="card_cursos_online_int">
                            <div class="area_img_cursos_online">
                                <div class="curso_online_destaque">
                                    <h2>
                                        Cursos Online
                                    </h2>
                                </div>
                                <img src="<?=$linhaCursoInsAbertas->imagem?>" alt="">
                            </div>

                            <div class="area_texts_cursos_online">
                                <div class="title_cursos_online">
                                    <h2>
                                        <?=$linhaCursoInsAbertas->fullname?>
                                    </h2>
                                </div>
                                <div class="sub_title_cursos_online">
                                    <p>
                                        <?=$linhaCursoInsAbertas->descricaocurta?>
                                    </p>
                                </div>
                            </div>

                            <img src="img/separador.svg" alt="">

                            <div class="area_info_cursos_online">

                                <div class="area_info_cursos_online_int">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.75 0C7.01942 0 5.32769 0.513178 3.88876 1.47464C2.44983 2.4361 1.32832 3.80267 0.666058 5.40152C0.00379121 7.00037 -0.169488 8.75971 0.168133 10.457C0.505753 12.1544 1.33911 13.7135 2.56282 14.9372C3.78653 16.1609 5.34563 16.9943 7.04296 17.3319C8.7403 17.6695 10.4996 17.4962 12.0985 16.8339C13.6973 16.1717 15.0639 15.0502 16.0254 13.6112C16.9868 12.1723 17.5 10.4806 17.5 8.75C17.5 6.42936 16.5781 4.20376 14.9372 2.56282C13.2962 0.921872 11.0706 0 8.75 0ZM8.75 15.909C7.33409 15.909 5.94997 15.4891 4.77268 14.7025C3.59539 13.9158 2.6778 12.7978 2.13595 11.4896C1.5941 10.1815 1.45233 8.74206 1.72856 7.35335C2.00479 5.96464 2.68662 4.68903 3.68783 3.68782C4.68903 2.68662 5.96464 2.00479 7.35335 1.72856C8.74206 1.45233 10.1815 1.5941 11.4896 2.13595C12.7978 2.67779 13.9159 3.59538 14.7025 4.77267C15.4891 5.94996 15.909 7.33408 15.909 8.75C15.909 10.6487 15.1548 12.4696 13.8122 13.8122C12.4696 15.1548 10.6487 15.909 8.75 15.909Z"
                                            fill="#F76818" />
                                        <path
                                            d="M9.54412 8.42099V3.98199C9.52321 3.7856 9.43038 3.60389 9.28351 3.47183C9.13665 3.33978 8.94613 3.26672 8.74862 3.26672C8.55112 3.26672 8.3606 3.33978 8.21374 3.47183C8.06687 3.60389 7.97404 3.7856 7.95312 3.98199V8.75499C7.95375 8.9657 8.03748 9.16765 8.18612 9.31699L10.5721 11.703C10.6426 11.7903 10.7307 11.8618 10.8306 11.9128C10.9305 11.9639 11.0401 11.9934 11.1521 11.9993C11.2642 12.0053 11.3762 11.9876 11.481 11.9474C11.5858 11.9072 11.6809 11.8455 11.7603 11.7661C11.8396 11.6868 11.9014 11.5916 11.9415 11.4869C11.9817 11.3821 11.9994 11.27 11.9934 11.158C11.9875 11.0459 11.958 10.9364 11.907 10.8365C11.8559 10.7365 11.7844 10.6485 11.6971 10.578L9.54412 8.42099Z"
                                            fill="#F76818" />
                                    </svg>
                                    <div class="title_info_cursos_online">
                                        <h2>
                                            Público alvo: <b><?php echo substr($publicoAlvo,0,-2); ?></b>
                                        </h2>
                                    </div>

                                </div>

                                <div class="area_info_cursos_online_int">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.154 9.32196C2.896 9.32196 0 11.809 0 16.322C0 16.4914 0.0673228 16.654 0.187159 16.7738C0.306994 16.8936 0.469527 16.961 0.639 16.961H15.669C15.8385 16.961 16.001 16.8936 16.1208 16.7738C16.2407 16.654 16.308 16.4914 16.308 16.322C16.308 11.81 13.412 9.32196 8.154 9.32196ZM1.301 15.688C1.552 12.311 3.855 10.5999 8.154 10.5999C12.453 10.5999 14.754 12.311 15.007 15.688H1.301Z"
                                            fill="#F76818" />
                                        <path
                                            d="M8.15409 0.464938C7.58846 0.457746 7.02725 0.565269 6.50434 0.781014C5.98143 0.996759 5.50766 1.31625 5.11167 1.72019C4.71567 2.12413 4.40565 2.60414 4.20034 3.13124C3.99502 3.65833 3.89866 4.22157 3.91709 4.78694C3.86858 5.37275 3.9421 5.96225 4.13298 6.51821C4.32387 7.07417 4.62798 7.5845 5.02611 8.01696C5.42424 8.44942 5.90772 8.79461 6.44603 9.03073C6.98434 9.26684 7.56578 9.38875 8.1536 9.38875C8.74141 9.38875 9.32284 9.26684 9.86115 9.03073C10.3995 8.79461 10.8829 8.44942 11.2811 8.01696C11.6792 7.5845 11.9833 7.07417 12.1742 6.51821C12.3651 5.96225 12.4386 5.37275 12.3901 4.78694C12.4085 4.22165 12.3122 3.6585 12.1069 3.13147C11.9017 2.60445 11.5917 2.12448 11.1959 1.72056C10.8 1.31663 10.3263 0.997117 9.80353 0.781312C9.28074 0.565506 8.71963 0.457882 8.15409 0.464938V0.464938ZM8.15409 8.10794C7.32263 8.05638 6.5452 7.67848 5.99102 7.0565C5.43683 6.43452 5.15077 5.61881 5.19509 4.78694C5.17522 4.38915 5.2375 3.99152 5.37806 3.61886C5.51861 3.2462 5.73443 2.90648 6.01204 2.62089C6.28966 2.3353 6.62312 2.10995 6.99166 1.95891C7.36019 1.80786 7.75589 1.73434 8.15409 1.74294C8.5508 1.7397 8.94406 1.81687 9.31012 1.96979C9.67619 2.12271 10.0075 2.34821 10.284 2.63268C10.5605 2.91715 10.7766 3.25469 10.9191 3.62494C11.0615 3.9952 11.1276 4.39048 11.1131 4.78694C11.1574 5.61881 10.8713 6.43452 10.3172 7.0565C9.76298 7.67848 8.98554 8.05638 8.15409 8.10794Z"
                                            fill="#F76818" />
                                    </svg>
                                    <div class="title_info_cursos_online">
                                        <h2>
                                            Carga horária: <b><?php echo $linhaCursoInsAbertas->chcurso ?></b>
                                        </h2>
                                    </div>

                                </div>
                                <div class="area_btn_info">
                                    <a href="informacoes.php?id=<?=$linhaCursoInsAbertas->courseid;?>">
                                        <div class="btn_info_cursos_online animation_btns">
                                            <h2>
                                                Fazer Inscrição
                                            </h2>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
                    if($contaCursoInsAbertas!=0){
                        for ($x = $contaCursoInsAbertas; $x <= 4; $x++) {
                            echo '<div class="card_cursos_online catCursoParaInscricao" style="display: none; background: transparent; border: none; box-shadow: none; border-radius: 20px;"></div>';
                        }                        
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>


    <div class="container_finalizados">
        <div class="container_finalizados_int">
            <div class="area_finalizados">


                <div class="area_texts_finalizados">
                    <div class="info_finalizados">
                        <p>
                            Cursos finalizados
                        </p>
                    </div>
                    <div class="title_finalizados">
                        <h2>
                            Cursos a distância
                        </h2>
                    </div>
                </div>



                <div class="container_tabela blocoVersaoParaPC">
                    <table class="bordered striped centered highlight responsive-table">
                        <thead>
                            <tr>
                                <th style="max-width: 100px">Nome do Curso</th>
                                <th style="max-width: 100px">Data de Conclusão</th>
                                <th style="max-width: 100px">Emitir Certificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qtdCertificadsoEmitidos = 0;
                            foreach($retornoCursosConcluidos as $cursos_finalizados){
                                $qtdCertificadsoEmitidos ++;
                            ?>
                            <tr>
                                <td><?php echo $cursos_finalizados->curso;?></td>
                                <td><?=date('d/m/Y', substr($cursos_finalizados->ultimaAtualizacao,0,11)); ?></td>
                                <td class="area_certificado">
                                    <a target="_blank" href="<?=$cursos_finalizados->urlCertificado;?>">
                                        <img src="img_perfil/pdf.svg" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="img_perfil/in.svg" alt="">
                                    </a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                foreach($retornoCursosConcluidos as $cursos_finalizados){
                ?>
                <div class="container_tabela blocoVersaoParaCelular">
                    <table class="bordered striped centered highlight responsive-table">
                        <tbody>
                            <tr>
                                <th style="max-width: 100px">Nome do Curso</th>
                                <td><?php echo $cursos_finalizados->curso;?></td>
                            </tr>
                            <tr>
                                <th style="max-width: 100px">Data de Conclusão</th>
                                <td><?=date('d/m/Y', substr($cursos_finalizados->ultimaAtualizacao,0,11)); ?></td>
                            </tr>
                            <tr>
                                <th style="max-width: 100px">Emitir Certificado</th>
                                <td class="area_certificado">
                                    <a target="_blank" href="<?=$cursos_finalizados->urlCertificado;?>">
                                        <img src="img_perfil/pdf.svg" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="img_perfil/in.svg" alt="">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>


    <div class="container_faq">
        <div class="container_faq_int">
            <div class="area_faq">
                <div class="title_faq">
                    <h2>
                        Perguntas Frequentes
                    </h2>
                </div>

                <div class="fale_conosco">
                    <div class="fale_conosco_int">
                        <div class="area_1_fale_conosco">
                            <a href="#">
                                <div class="btn_fale_conosco animation_btns">
                                    <h2>
                                        Dúvidas técnicas
                                    </h2>
                                </div>
                            </a>

                            <a href="#">
                                <div class="btn_fale_conosco animation_btns">
                                    <h2>
                                        Novas matrículas
                                    </h2>
                                </div>
                            </a>
                            <a href="#">
                                <div class="btn_fale_conosco animation_btns">
                                    <h2>
                                        Renovar matrícula
                                    </h2>
                                </div>
                            </a>
                        </div>


                        <div class="area_2_fale_conosco">
                            <div class="title_fale_conosco">
                                <h2>
                                    Fale conosco
                                </h2>
                            </div>
                            <div class="sub_title_fale_conosco">
                                <p>
                                    Caso não tenha resolvido seu problema ou precise falar com nosso suporte, entre em
                                    contato com nossa central de atendimento.
                                </p>
                            </div>

                            <div class="area_horario_fale_conosco">
                                <img src="img_perfil/relogio.svg" alt="">
                                <div class="title_horario_fale_conosco">
                                    <h2>
                                        9h as 18h
                                    </h2>
                                </div>
                            </div>

                        </div>

                        <div class="area_3_fale_conosco">
                            <a href="#">
                                <div class="btn_suporte">
                                    <h2>
                                        Acessar suporte
                                    </h2>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php include 'footer.php' ?> 

   
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/script.js"></script>
    <script>
    $("#curso-em-andamento").click(function(){
        $("#curso-em-andamento").addClass("select");
        $("#titulo-curso-em-andamento").addClass("select");
        $("#cursos-adquiridos").removeClass("select");
        $("#titulo-cursos-adquiridos").removeClass("select");
        $("#loja-de-cursos").removeClass("select");
        $("#titulo-loja-de-cursos").removeClass("select");
        $("#titulo-lista-cursos").html("<h2>Cursos em andamento</h2>");
        $(".catCursoAdquirido").hide();
        $(".catCursoEmAndamento").show();
        $(".catCursoParaInscricao").hide();
        $("#aba-pesquisa").val("andamento");
        $("#lista-cursos-em-andamento").attr("style", "");
        $('.pesquisa').val("");
    });
    $("#cursos-adquiridos").click(function(){
        $("#curso-em-andamento").removeClass("select");
        $("#titulo-curso-em-andamento").removeClass("select");
        $("#cursos-adquiridos").addClass("select");
        $("#titulo-cursos-adquiridos").addClass("select");
        $("#loja-de-cursos").removeClass("select");
        $("#titulo-loja-de-cursos").removeClass("select");
        $("#titulo-lista-cursos").html("<h2>Cursos finalizados</h2>");
        $(".catCursoAdquirido").show();
        $(".catCursoEmAndamento").hide();
        $(".catCursoParaInscricao").hide();
        $("#aba-pesquisa").val("adquiridos");
        $("#lista-cursos-em-andamento").attr("style", "");
        $('.pesquisa').val("");
    });
    $("#loja-de-cursos").click(function(){
        $("#loja-de-cursos").addClass("select");
        $("#titulo-loja-de-cursos").addClass("select");
        $("#curso-em-andamento").removeClass("select");
        $("#titulo-curso-em-andamento").removeClass("select");
        $("#cursos-adquiridos").removeClass("select");
        $("#titulo-cursos-adquiridos").removeClass("select");
        $("#titulo-lista-cursos").html("<h2>Inscrições abertas</h2>");
        $(".catCursoAdquirido").hide();
        $(".catCursoEmAndamento").hide();
        $(".catCursoParaInscricao").show();
        $("#aba-pesquisa").val("loja-de-cursos");
        $("#lista-cursos-em-andamento").attr("style", "");
        $('.pesquisa').val("");
    });

    $("#buscarDadosCurso").click(function(){
        if($("#aba-pesquisa").val()=="andamento"){
            $('.catCursoEmAndamento').hide();
            var txt = $('.pesquisa').val();
            $('.catCursoEmAndamento').each(function(){
            if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                $(this).show();
            }
            });
        }
        if($("#aba-pesquisa").val()=="adquiridos"){
            $('.catCursoAdquirido').hide();
            var txt = $('.pesquisa').val();
            $('.catCursoAdquirido').each(function(){
            if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                $(this).show();
            }
            });
        }
        if($("#aba-pesquisa").val()=="loja-de-cursos"){
            $('.catCursoParaInscricao').hide();
            var txt = $('.pesquisa').val();
            $('.catCursoParaInscricao').each(function(){
            if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                $(this).show();
            }
            });
        }
        if($('.pesquisa').val()!=""){
            $("#lista-cursos-em-andamento").attr("style", "justify-content: left;");
        }
    });
    $("#qtdCertificadsoEmitidos").html("<?php echo $qtdCertificadsoEmitidos ?>");
    $("#qtdCursoAndamento").html("<?php echo $qtdCursoAndamento ?>");
    </script>>
</body>

</html>