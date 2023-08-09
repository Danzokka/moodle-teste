<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
<?php 
//config.php está incluído dentro d lib.php
include 'lib.php';

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => $host.'/customfields',
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
$ret = json_decode($response);
$customfields = $ret->customfields;

 ?> 

 
                       

                        <form class="form" action="" method="POST">

                            <div class="area_form">
                                <div class="area_form_cadastro_total">
                                    <div class="area_form_cadastro">
                                        <label for="nome">Nome</label>
                                        <input type="text" id="nome" name="nome" required>
                                    </div>
    
                                    <div class="area_form_cadastro">
                                        <label for="sobrenome">Sobrenome</label>
                                        <input type="text" id="sobrenome" name="sobrenome" required>
                                    </div>
                                </div>
    
                            
                                <div class="area_form_cadastro">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" required>
                                </div>

                                <div class="area_form_cadastro">
                                    <label for="whatsapp">WhatsApp</label>
                                    <input type="text" id="whatsapp" name="whatsapp" required>
                                </div>
    
                                <div class="area_form_cadastro">
                                    <label for="senha">Senha</label>
                                    <input type="password" id="senha" name="senha" required>
                                </div>
								
								<?php foreach($customfields as $field){?>
                                <div class="area_form_cadastro">
                                    <label for="<?=$field->shortname?>"><?=$field->name?></label>
                                    <input type="text" id="<?=$field->shortname?>" name="<?=$field->shortname?>">
                                </div>
								<?php } ?>
								
                            </div>
                            <button type="submit" name="enviar" value="Enviar">Enviar</button>
                        
                        </form>
                    </div>
<?php
if(@$_POST['enviar']=="Enviar"){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = array();
    
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
    }

    $curlEnviarPost = curl_init();
    curl_setopt_array($curlEnviarPost, array(
    CURLOPT_URL => 'https://fox.avantebrasil.com.br/webhook-test/12b54798-cf0a-47e4-b6ac-debe78a6e563/usuario/add',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_HTTPHEADER => array(
        'x-wstoken: '.$x_wstoken,
        'x-url: '.$x_url,
        'Authorization: '.$Authorization
    ),
    ));
    $responseEnviarPost = curl_exec($curlEnviarPost);
    curl_close($curlEnviarPost);
    echo 'reposta do envio: <br>'.$responseEnviarPost;
    
}
?>

    <script src="js/script.js"></script>
</body>

</html>