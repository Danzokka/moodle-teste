<?php
$data = array(
    'userid' => 3,
    'courseid' => 2,
    'acao' => 'desinscricao',
    'token' => '7asd16fg3e21r6t3m5n9h2qa2f4107sa'
);

$jsonData = json_encode($data);

$url = 'https://painel.superapprova.com.br/eadzap/retorno_ead.php';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo 
$response = curl_exec($ch);

if (curl_errno($ch)) {
    $error = curl_error($ch);
}
curl_close($ch);
?>