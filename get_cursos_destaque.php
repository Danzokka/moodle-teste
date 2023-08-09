<?php
// Inicializar a flag indicando que as outras APIs não foram acionadas
$outrasAPIsAcionadas = false;

// Verificar se a API de pesquisa foi chamada
if (isset($_GET['pesquisa'])) {
    // Realizar a lógica da API de pesquisa
    // ...
    
    // Definir a flag indicando que a API de pesquisa foi acionada
    $outrasAPIsAcionadas = true;
}

// Verificar se a API de modalidade foi chamada
if (isset($_GET['modalidade'])) {
    // Realizar a lógica da API de modalidade
    // ...
    
    // Definir a flag indicando que a API de modalidade foi acionada
    $outrasAPIsAcionadas = true;
}

// Get cursos em destaque apenas se nenhuma das outras APIs foi acionada
if (!$outrasAPIsAcionadas) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://lynx.avantebrasil.com.br/webhook/521ac45a-ae61-4f0d-a03e-a7d286b7b4cd/rafael/cursos_destaques',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'x-url: skills.superapprova.com.br',
            'x-wstoken: 8684d46338373740bf1390950f6540d0',
            'Authorization: Basic c3VwZXJhcHByb3ZhOlc3MDM0UTAwNDlmcQ=='
        ),
    ));

    $json = curl_exec($curl);

    curl_close($curl);

    $dados = json_decode($json);
}

// Retornar os dados da API ou uma resposta vazia dependendo da flag
if ($outrasAPIsAcionadas) {
    // Responder com uma resposta vazia
    echo json_encode(array('cursos_destaque' => []));
} else {
    // Responder com os dados da API
    echo $json;
}
?>