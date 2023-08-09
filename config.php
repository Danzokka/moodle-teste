<?php
$x_wstoken = "8684d46338373740bf1390950f6540d0";
$x_url     = "skills.superapprova.com.br";
$Authorization = "Basic c3VwZXJhcHByb3ZhOlc3MDM0UTAwNDlmcQ==";
$host = "https://lynx.avantebrasil.com.br/webhook";

//Requisições da pagina de curso
$rash_curso = "cf0daee8-cd01-4f57-8a18-99f56ee3cd38";
$urlCursoIndividual = $host.'/'.$rash_curso.'/curso/';

$rash_trilha = '356257f8-9088-49b2-b068-53e7267eba4e';
$urlCursosRelacionados = $host.'/'.$rash_trilha.'/trilha/';

$rash_likes = '3a4d9ad3-16c2-4029-918e-6846bc5e4f5e';
$urlLikesAdds = $host.'/'.$rash_likes.'/likes/add/';

//Requisições da pagina de perfil do cliente
$rash_usuarioId = '413432b1-007c-482f-b2ec-b335c77ba696';
$urlUsuarioId = $host.'/'.$rash_usuarioId.'/usuario/';

$rash_ranking = 'cca052c4-6fa0-4cfb-9d07-616c32e09dfb';
$urlranking = $host.'/'.$rash_ranking.'/ranking';

$rash_jornada = '50ea354b-47ff-4864-9280-27b1fff8e7d6';
$urljornada = $host.'/'.$rash_jornada.'/jornada/';

$rash_CursoAndamento = '5c701ce5-5d06-4744-86e4-1de76a3fa3f4/5c701ce5-5d06-4744-86e4-1de76a3fa3f4';
$urlCursoAndamento = $host.'/'.$rash_CursoAndamento.'/cursos/andamento/';

$rash_CursoInscricoesAbertas = '5fda175c-0226-49e5-a08e-5574ee23b359';
$urlCursoInscricoesAbertas = $host.'/'.$rash_CursoInscricoesAbertas.'/inscricoes_abertas';

$rash_CursosConcluidos = 'eedada91-d34a-44af-8f52-a7834d314286/eedada91-d34a-44af-8f52-a7834d314286';
$urlCursosConcluidos = $host.'/'.$rash_CursosConcluidos.'/cursos/concluidos/';
?>