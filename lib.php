<?php
include 'config.php';
function mesPorExtenso($mes){
    switch ($mes) {
        case 1:
            return "janeiro";
        case 2:
            return "fevereiro";
        case 3:
            return "março";
        case 4:
            return "abril";
        case 5:
            return "maio";
        case 6:
            return "junho";
        case 7:
            return "julho";
        case 8:
            return "agosto";
        case 9:
            return "setembro";
        case 10:
            return "outubro";
        case 11:
            return "novembro";
        case 12:
            return "dezembro";
        default:
            return null;
    }
}

if($_POST['postAcao']=="Curtir"){
    $curlCurtir = curl_init();
    curl_setopt_array($curlCurtir, array(
    CURLOPT_URL => $urlLikesAdds.$_POST['id'],
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
    $responseCurtir = curl_exec($curlCurtir);
    curl_close($curlCurtir);
}
function botaoVoltarCadastro($nomeBOtao){
	return '
	<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path
			d="M12.2127 4.69708H2.33868L4.18868 6.54709C4.29477 6.65318 4.35437 6.79705 4.35437 6.94708C4.35437 7.09711 4.29477 7.24099 4.18868 7.34708C4.0826 7.45316 3.93871 7.51276 3.78868 7.51276C3.63865 7.51276 3.49477 7.45316 3.38868 7.34708L1.70368 5.6601L0.581683 4.53009C0.476833 4.42477 0.417969 4.28219 0.417969 4.13358C0.417969 3.98496 0.476833 3.84241 0.581683 3.73709L3.39168 0.920074C3.49777 0.813988 3.64165 0.754395 3.79168 0.754395C3.94171 0.754395 4.0856 0.813988 4.19168 0.920074C4.29777 1.02616 4.35737 1.17004 4.35737 1.32007C4.35737 1.4701 4.29777 1.61401 4.19168 1.72009L2.33768 3.57007H12.2417C12.3172 3.5695 12.3921 3.58415 12.4618 3.6131C12.5315 3.64205 12.5947 3.68471 12.6477 3.73859C12.7006 3.79247 12.7421 3.85647 12.7698 3.92673C12.7975 3.99699 12.8107 4.07209 12.8088 4.14758C12.8068 4.22307 12.7897 4.29738 12.7584 4.36612C12.7272 4.43486 12.6824 4.49662 12.6268 4.5477C12.5712 4.59878 12.5059 4.63816 12.4347 4.66348C12.3636 4.6888 12.2881 4.69953 12.2127 4.69507V4.69708Z"
			fill="#F76818" />
	</svg>
	<div class="title_btn_voltar">
		<h2>
			'.$nomeBOtao.'
		</h2>
	</div>
	';
}
function botaoContinuarCadastro($nomeBOtao){
	return '
	<div class="title_btn_inscreva_se">
		<h2>
			'.$nomeBOtao.'
		</h2>
	</div>
	<svg width="13" height="8" viewBox="0 0 13 8" fill="none"
		xmlns="http://www.w3.org/2000/svg">
		<path
			d="M0.86287 4.69696H10.7379L8.88787 6.54697C8.78178 6.65305 8.72218 6.79693 8.72218 6.94696C8.72218 7.09699 8.78178 7.24087 8.88787 7.34695C8.99396 7.45304 9.13784 7.51263 9.28787 7.51263C9.4379 7.51263 9.58178 7.45304 9.68787 7.34695L11.3729 5.65997L12.4979 4.53397C12.6027 4.42864 12.6616 4.28607 12.6616 4.13745C12.6616 3.98884 12.6027 3.84629 12.4979 3.74097L9.68487 0.919952C9.57878 0.813866 9.4349 0.754272 9.28487 0.754272C9.13484 0.754272 8.99096 0.813866 8.88487 0.919952C8.77878 1.02604 8.71918 1.16992 8.71918 1.31995C8.71918 1.46998 8.77878 1.61388 8.88487 1.71997L10.7389 3.56995H0.83387C0.758358 3.56937 0.683502 3.58403 0.613757 3.61298C0.544013 3.64193 0.480805 3.68458 0.427896 3.73846C0.374987 3.79234 0.333458 3.85635 0.305781 3.92661C0.278103 3.99686 0.264843 4.07197 0.266789 4.14746C0.268734 4.22295 0.285847 4.29726 0.317108 4.366C0.348368 4.43474 0.393138 4.49649 0.448753 4.54758C0.504368 4.59866 0.569691 4.63804 0.640834 4.66336C0.711978 4.68868 0.787488 4.69941 0.86287 4.69495V4.69696Z"
			fill="#FCB21D" />
	</svg>
	';
}

if($_POST['postAcao']=="verificarLogin"){
    
    $curlCurtir = curl_init();
    curl_setopt_array($curlCurtir, array(
    CURLOPT_URL => $urlUsuarioId.'check/'.$_POST['cpf_filtro'],
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
    echo 'resposta ('.$urlUsuarioId.'check/'.$_POST['cpf_filtro'].')<br>';
    echo 
    $responseCurtir = curl_exec($curlCurtir);
    curl_close($curlCurtir);
?>
<script>
$("#cadastro_passo01").hide();
$("#cadastro_passo02").show();
$("#enviaParaServidor").show();
</script>
<?php
}
if(@$_POST['postAcao']=="EnviarParaEad"){
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
    echo 'resposta (https://fox.avantebrasil.com.br/webhook-test/12b54798-cf0a-47e4-b6ac-debe78a6e563/usuario/add)<br>';
    echo 
    $responseEnviarPost = curl_exec($curlEnviarPost);
    curl_close($curlEnviarPost);
    
}
?>