<?php
/*
if (!defined('STDIN')) {
    echo "Acesso a esse arquivo não autorizado!";
    exit();
}*/
if($_GET['ver']=="sim"){
	include 'dao/conexao/conexao.php';
	include 'dao/geralDAO.php';
	$wpdb = new GeralDAO();
	@date_default_timezone_set('America/Sao_Paulo');
	
	echo	'<b>Cursos</b><br>';
	$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_cursos");
	foreach($sqlWs as $linhaWs){
		echo '<br>id:	'.$linhaWs->id;
		echo '<br>id_curso:	'.$linhaWs->id_curso;
		echo '<br>nome:	'.$linhaWs->nome;
		echo '<br>inicio:	'.$linhaWs->inicio;
		echo '<br>fim:	'.$linhaWs->fim;
		echo '<br>data_criacao:	'.$linhaWs->data_criacao;
		echo '<br>id_categoria:	'.$linhaWs->id_categoria;
		echo '<hr>';
	}
	echo	'<b>Inscrito</b><br>';
	$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_inscritos");
	foreach($sqlWs as $linhaWs){
		echo '<br>id:	'.$linhaWs->id;
		echo '<br>iduser:	'.$linhaWs->iduser;
		echo '<br>id_curso:	'.$linhaWs->id_curso;
		echo '<br>nome:	'.$linhaWs->nome;
		echo '<br>telefone:	'.$linhaWs->telefone;
		echo '<br>data_inscrito_no_curso:	'.$linhaWs->data_inscrito_no_curso;
		echo '<br>perfil_no_curso:	'.$linhaWs->perfil_no_curso;
		echo '<br>email:	'.$linhaWs->email;
		echo '<br>username:	'.$linhaWs->username;
		echo '<br>data_hora_json:	'.$linhaWs->data_hora_json;
		echo '<hr>';
	}
	echo	'<b>======Envios=========</b><br>';
	$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_controle_msg");
	foreach($sqlWs as $linhaWs){
		echo '<br>id:	'.$linhaWs->id;
		echo '<br>id_user:	'.$linhaWs->id_user;
		echo '<br>id_curso:	'.$linhaWs->id_curso;
		echo '<br>id_zap_mensagens:	'.$linhaWs->id_zap_mensagens;
		echo '<br>resposta_z_api:	'.$linhaWs->resposta_z_api;
		echo '<br>dt_disparo:	'.$linhaWs->dt_disparo;
		echo '<hr>';
	}
	echo	'<b>======Retorno z-api=========</b><br>';
	$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_realizar_curso order by id asc");
	foreach($sqlWs as $linhaWs){
		echo '<br>id:	'.$linhaWs->id;
		echo '<br>id_user:	'.$linhaWs->id_user;
		echo '<br>id_curso:	'.$linhaWs->id_curso;
		//echo '<br>id_zap_mensagens:	'.$linhaWs->id_zap_mensagens;
		echo '<br>id_topico:	'.$linhaWs->id_topico;
		echo '<br>modulo:	'.$linhaWs->modulo;
		//echo '<br>resposta_z_api:	'.$linhaWs->resposta_z_api;
		echo '<br>resposta_json:	'.$linhaWs->resposta_json;
		echo '<br>dt_disparo:	'.$linhaWs->dt_disparo;
		
		echo '<br><br>';
		
		$lendo = json_decode($linhaWs->resposta_json);
		$buttonId = $lendo->buttonReply->buttonId;
		$buttonIdArray = explode("|", $buttonId);
		$contDadoRetApi = 0;
		foreach($buttonIdArray as $dadosRetornoApi){
			$contDadoRetApi = $contDadoRetApi + 1;
			if($contDadoRetApi==1){
				echo 'modulo: '.$dadosRetornoApi;
			}
			if($contDadoRetApi==2){
				echo 'id_topico: '.$dadosRetornoApi;
			}
			if($contDadoRetApi==3){
				echo 'iduser: '.$dadosRetornoApi;
			}
			if($contDadoRetApi==4){
				echo 'id_curso: '.$dadosRetornoApi;
			}
			echo '<br>';
		}
		
		echo '<hr>';
	}
	
	/*
	
	$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_cursos");
	foreach($sqlWs as $linhaWs){
		echo $linhaWs->json;
		echo '<hr>';
	}*/
	//$ins = $wpdb->query("TRUNCATE `ead_zap_controle_msg`;");
	//$ins = $wpdb->query("TRUNCATE `ead_zap_realizar_curso`;");	
	//$ins = $wpdb->query("TRUNCATE `ead_zap_inscritos`;");
	//$ins = $wpdb->query("TRUNCATE `ead_zap_realizar_curso`;");
	//$ins = $wpdb->query("delete from ead_zap_cursos where id_curso<>8;");
	
	
	
	//$ins = $wpdb->query("TRUNCATE `ead_zap_cursos`;");
	//$ins = $wpdb->query("delete from ead_zap_controle_msg where id_curso=8 and id_user=12;");
	//$ins = $wpdb->query("delete from ead_zap_realizar_curso where id_curso=8 and id_user=12;");
					
					
}else{
	$method = $_SERVER['REQUEST_METHOD'];
	if($method == 'GET' or $method == 'POST'){

		$requestBody = file_get_contents('php://input'); 
		$lendo = json_decode($requestBody);

		include 'dao/conexao/conexao.php';
		include 'dao/geralDAO.php';
		$wpdb = new GeralDAO();
		@date_default_timezone_set('America/Sao_Paulo');
		
		$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_token_moodle WHERE id='1'");
		foreach($sqlWs as $linhaWs);
		$token_wordpress = $linhaWs->token_wordpress;
		if($lendo->token==$token_wordpress and $lendo->acao=="inscricao"){
			
			
			$url = $linhaWs->host_ead.'/webservice/rest/server.php?wstoken='.$linhaWs->token.'&wsfunction=core_enrol_get_enrolled_users&moodlewsrestformat=json&courseid='.$lendo->idCourse;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$url);
			$result=curl_exec($ch);
			curl_close($ch);
			$dadosDoInscrito = json_decode($result);
			foreach($dadosDoInscrito as $linhaInscrito){
				if($linhaInscrito->id==$lendo->idUser){
					$perfil_no_curso = $linhaInscrito->roles[0]->shortname;
					break;
				}
			}
								
			//echo 'Inscricao';
			$ins = $wpdb->query("
			INSERT INTO ead_zap_inscritos SET
			iduser                 = '".addslashes($lendo->idUser)."',
			id_curso               = '".addslashes($lendo->idCourse)."',
			nome                   = '".addslashes($lendo->nomeAluno)."',
			telefone               = '".addslashes($lendo->celular)."',
			data_inscrito_no_curso = '".addslashes($lendo->dataIncricao)."',
			perfil_no_curso        = '".addslashes($perfil_no_curso)."',
			email                  = '".addslashes($lendo->email)."',
			username               = '".addslashes($lendo->username)."',
			data_hora_json         = '".date('Y-m-d H:i:s')."'
			");
		}else if($lendo->token==$token_wordpress and $lendo->acao=="newuser"){
			//echo 'novo user';
		}else if($lendo->token==$token_wordpress and $lendo->acao=="desinscricao"){
			$wpdb->query("delete from ead_zap_inscritos where id_curso=".$lendo->courseid." and iduser=".$lendo->userid.";");
			$wpdb->query("delete from ead_zap_controle_msg where id_curso=".$lendo->courseid." and id_user=".$lendo->userid.";");
			$wpdb->query("delete from ead_zap_realizar_curso where id_curso=".$lendo->courseid." and id_user=".$lendo->userid.";");
		}else if($lendo->token==$token_wordpress and $lendo->acao=="curso"){
			//echo 'novo curso';
			$ins = $wpdb->query("
			INSERT INTO ead_zap_cursos SET
			id_curso        = '".addslashes($lendo->idCourse)."',
			nome            = '".addslashes($lendo->nomeCurso)."',
			inicio          = '".addslashes($lendo->dataInicio)."',
			fim             = '".addslashes($lendo->dataFim)."',
			data_criacao    = '".addslashes($lendo->dataCriacao)."',
			id_categoria    = '".addslashes($lendo->idCategoria)."',
			data_hora_json  = '".date('Y-m-d H:i:s')."'
			");
		}else{
			?>
			<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
			<html><head>
			<title>403 Forbidden</title>
			</head><body>
			<h1>Forbidden</h1>
			<p>You don't have permission to access this resource teste.</p>
			<p>Additionally, a 403 Forbidden
			error was encountered while trying to use an ErrorDocument to handle the request.</p>
			</body></html>
			<?php
			exit();
		}
	}
}

?>
