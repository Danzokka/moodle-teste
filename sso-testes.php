<?php

// Configurações de autenticação do SSO
$clientId = 'SURTU09TdXBlckFwcHJvdmE';
$clientSecret = 'c2VjcmV0U1NPU3VwZXJBcHByb3Zh';
$redirectUri = 'https://skills.superapprova.com.br/admin/oauth2callback.php';

// Verifica se o código de autorização está presente na URL
if (isset($_GET['code'])) {
    $authCode = $_GET['code'];

    // URL do token de acesso do SSO
    $tokenUrl = 'https://sso.example.com/oauth2/token';

    // Dados para obter o token de acesso
    $params = array(
        'grant_type' => 'authorization_code',
        'code' => $authCode,
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri
    );

    // Solicitação de token de acesso
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodificar a resposta JSON
    $tokenData = json_decode($response, true);

    // Verificar se a solicitação foi bem-sucedida
    if (isset($tokenData['access_token'])) {
        $accessToken = $tokenData['access_token'];

        // Agora você pode usar o token de acesso para fazer chamadas à API do Moodle
        // Exemplo de chamada à API usando o token de acesso
       
    } else {
        // A solicitação falhou. Lidar com o erro aqui.
        echo 'Falha na autenticação.';
    }
} else {
    // Redirecionar para a URL de autorização do SSO
    $authorizationUrl = 'https://skills.superapprova.com.br/auth/oauth2/login.php?id=2&wantsurl=%2F&sesskey=87L7vZWFcR';
    $params = array(
        'response_type' => 'code',
        'client_id' => $clientId,
        'redirect_uri' => $redirectUri,
        'code' => $clientId,
        'state' => 1
    );
    $redirectUrl = $authorizationUrl . '?' . http_build_query($params);
    header('Location: ' . $redirectUrl);
    exit();
}
//https://skills.superapprova.com.br/oauth/authorize/?client_id=SURTU09TdXBlckFwcHJvdmE&response_type=code&redirect_uri=https%3A%2F%2Fskills.superapprova.com.br%2Fadmin%2Foauth2callback.php&state=%2Fauth%2Foauth2%2Flogin.php%3Fwantsurl%3Dhttps%253A%252F%252Fskills.superapprova.com.br%252F%26sesskey%3D87L7vZWFcR%26id%3D2&scope=openid%20profile%20email
?>