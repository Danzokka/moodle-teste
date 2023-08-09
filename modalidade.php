<?php

$modalidade = '';

// Get Cursos By Modalidade
if (isset($_GET['modalidade'])) {
  $modalidade = $_GET['modalidade'];

    $url = 'https://lynx.avantebrasil.com.br/webhook/b5623960-8ec4-452b-80c3-067f6c3ccb8b/b5623960-8ec4-452b-80c3-067f6c3ccb8b/rafael/curso_destaque/'.$modalidade;

    
    $opts = array(
        'http' => array(
            'method' => 'GET',
            'header' => "x-url: skills.superapprova.com.br\r\n" .
                        "x-wstoken: 8684d46338373740bf1390950f6540d0\r\n" .
                        "Authorization: Basic c3VwZXJhcHByb3ZhOlc3MDM0UTAwNDlmcQ==\r\n"
        )
    );
    $context = stream_context_create($opts);
    $json = file_get_contents($url, false, $context);
    $json = json_encode($json);
    echo $json;
  }
?>

