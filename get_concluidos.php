<?php 
    if (isset($_GET['quantidade'])) { 
      $quantidade = $_GET['quantidade'];
      $pagina = $_GET['pagina'];
      $curl = curl_init();

      $url = 'https://lynx.avantebrasil.com.br/webhook/521ac45a-ae61-4f0d-a03e-a7d286b7b4cd/get_concluidos';

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('quantidade' => $quantidade,'pagina' => $pagina),
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