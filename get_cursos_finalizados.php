<?php 
    $input='' ; 
    if (isset($_GET['name'])) { $input=$_GET['name'];
    $url='https://lynx.avantebrasil.com.br/webhook/a9cf8719-0581-4fe0-b31e-66f0afbb0ce5/get_cursos_finalizados/'
    . $input; 
    $opts=array( 'http'=> array(
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