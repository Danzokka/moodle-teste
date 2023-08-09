<?php
include 'dao/conexao/conexao.php';
include 'dao/geralDAO.php';
$wpdb = new GeralDAO();

$sqlWs = $wpdb->get_results("SELECT * FROM `ead_zap_token_moodle` WHERE id='1'");
foreach($sqlWs as $linhaWs);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EadZap</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/curso.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/css_formulario.css">
	
	<script src="jquery.min.js" type="text/javascript"></script>
	<script src="form.js"></script>
	<script>
		function mascara(o,f){
			v_obj=o
			v_fun=f
			setTimeout("execmascara()",1)
		}
		function execmascara(){
			v_obj.value=v_fun(v_obj.value)
		}
		function leech(v){
			v=v.replace(/o/gi,"0")
			v=v.replace(/i/gi,"1")
			v=v.replace(/z/gi,"2")
			v=v.replace(/e/gi,"3")
			v=v.replace(/a/gi,"4")
			v=v.replace(/s/gi,"5")
			v=v.replace(/t/gi,"7")
			return v
		}
		function soNumeros(v){
			return v.replace(/\D/g,"")
		}
		function telefone(v){
			v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
			v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
			v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
			return v
		}
		function cepp(v){
			v=v.replace(/\D/g,"")                //Remove tudo o que não é dígito
			v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
			return v
		}
	</script>	
	<span style="display: none;">
		<iframe name="acao_iframe" src="hidden.php" style="width: 1px; height: 1px;"></iframe>
	</span>
</head>

<body>
<?php
    require_once '../header_2.php';

 if(@$_SESSION['id_user']!=""){ ?>
<div class="container_turma">
    <div class="container_turma_int">
    

        <div class="area_info_curso">
            <div class="area_formulario">
                <nav>
                    <ul>
                        <a href="ead_zap-list-mensagens.php">
                            <li>Lista mensagem</li>
                        </a>
                        <a href="ead_zap-cad-mensagens.php">
                            <li>Nova Mensagem</li>
                        </a>
                        <a href="ead_zap-config-webservice.php">
                            <li>Configuração</li>
                        </a>
                        <a href="sair.php">
                            <li class="btn_menu">
                                <h2>Sair</h2>
                            </li>
                        </a>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php } ?>