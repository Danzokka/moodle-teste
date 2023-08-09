<?php
if (isset($_GET['periodo_inicial'])) {
  $periodo_inicial = $_GET['periodo_inicial'];
  $periodo_final = $_GET['periodo_final'];
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://lynx.avantebrasil.com.br/webhook/alunos_by_periodo',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS => array('periodo_inicial' => $periodo_inicial,'periodo_final' => $periodo_final),
    CURLOPT_HTTPHEADER => array(
      'x-url: skills.superapprova.com.br',
      'x-wstoken: 8684d46338373740bf1390950f6540d0',
      'Authorization: Basic c3VwZXJhcHByb3ZhOlc3MDM0UTAwNDlmcQ=='
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  echo $response;
}
