<?php

// API de Pesquisa
$input = '';

if (isset($_GET['pesquisa_home'])) {
    $input = $_GET['pesquisa_home'];

    $url = 'https://lynx.avantebrasil.com.br/webhook/b5623960-8ec4-452b-80c3-067f6c3ccb8b/b5623960-8ec4-452b-80c3-067f6c3ccb8b/rafael/busca/' . $input;

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

    echo $json;
}
?>