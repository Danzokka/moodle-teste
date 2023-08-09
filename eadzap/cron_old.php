<?php
exit();
/*
if (!defined('STDIN')) {
    echo "Acesso a essa Cron não autorizado!";
    exit();
}*/
include 'dao/conexao/conexao.php';
include 'dao/geralDAO.php';
$wpdb = new GeralDAO();
@date_default_timezone_set('America/Sao_Paulo');

$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_token_moodle WHERE id='1'");
foreach($sqlWs as $linhaWs);
$url_z_api = $linhaWs->token_z_api;
//mensagem por curso (Formato da mensagem: Após Inscrição / no mesmo dia)
$mensagemInscricao = $wpdb->get_results( "SELECT * FROM ead_zap_mensagens where tipo_mensagem='1' AND formato_mensagem='2' AND apos_inscricao_dias='0'");
foreach($mensagemInscricao as $linhaMsgInscr){
	if($linhaMsgInscr->id_curso){

		unset($linhaEnvio);
		$controleEnvio = $wpdb->get_results("SELECT * FROM ead_zap_inscritos where id_curso = '".$linhaMsgInscr->id_curso."' AND iduser NOT IN(SELECT id_user FROM ead_zap_controle_msg where id_curso = '".$linhaMsgInscr->id_curso."' AND id_zap_mensagens = '".$linhaMsgInscr->id."')");
		foreach($controleEnvio as $linhaEnvio){
			unset($campoCelular);

			//pegar o numero de telefone
			$campoCelular = $linhaEnvio->telefone;

			if(@$campoCelular){
				//número do celular formatado
				$campoCelularFormat = '55'.str_replace('.','',str_replace('-','',str_replace(')','',str_replace('(','',str_replace(' ','',$campoCelular)))));

				$chSend = curl_init($url_z_api.'send-text');
				$dataSend = array(
					'phone' => $campoCelularFormat,
					"message" => $linhaMsgInscr->texto_msg
				);
				$bodySend = json_encode($dataSend);
				curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
				curl_setopt($chSend, CURLOPT_VERBOSE, true);
				curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
				curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
				curl_setopt($chSend, CURLOPT_HEADER, 0);        
				curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
				curl_setopt($chSend, CURLOPT_POST,true);        
				curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
				curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend);
				$resultSend = curl_exec($chSend);
				curl_close($chSend);
				$chSend     = '';
				$dataSend   = '';
				$bodySend   = '';
				$chSend     = '';
			}else{
				$resultSend = 'não enviado, telefone não cadastrado!';
			}			
			$ins = $wpdb->query("
			INSERT INTO ead_zap_controle_msg SET
			id_curso             = '".$linhaMsgInscr->id_curso."',
			id_zap_mensagens     = '".$linhaMsgInscr->id."',
			id_user              = '".$linhaEnvio->iduser."',
			resposta_z_api       = '".$resultSend."',
			dt_disparo           = '".date('Y-m-d H:i:s')."'
			");
			$resultSend = '';
		}
	}
}

unset($linhaMsgInscr);
//mensagem por curso (Formato da mensagem: Após Inscrição / um ou mais dias depois)
$mensagemInscricao = $wpdb->get_results("SELECT * FROM ead_zap_mensagens where tipo_mensagem='1' AND formato_mensagem='2' AND apos_inscricao_dias<>'0'");
foreach($mensagemInscricao as $linhaMsgInscr){
	if($linhaMsgInscr->id_curso){
		//foreach($dadosDoInscrito as $linhaInscrito){
		unset($linhaEnvio);
		$controleEnvio = $wpdb->get_results("SELECT * FROM ead_zap_inscritos where id_curso = '".$linhaMsgInscr->id_curso."' AND iduser NOT IN(SELECT id_user FROM ead_zap_controle_msg where id_curso = '".$linhaMsgInscr->id_curso."' AND id_zap_mensagens = '".$linhaMsgInscr->id."')");
		foreach($controleEnvio as $linhaEnvio){
			//echo '2='.date('d/m/Y H:i:s',substr($linhaEnvio->data_inscrito_no_curso,0,10));
			//$data_inscrito=date('d-m-Y',substr($linhaEnvio->data_inscrito_no_curso,0,10));
			//echo $linhaMsgInscr->apos_inscricao_dias;
			//echo '<br>';
			$dataEnviar   = date('Ymd', strtotime('+'.$linhaMsgInscr->apos_inscricao_dias.' days', strtotime(date('d-m-Y',substr($linhaEnvio->data_inscrito_no_curso,0,10)))));
			//echo '<hr>';
			if($dataEnviar <= date('Ymd')){
				unset($campoCelular);

				//pegar o numero de telefone
				$campoCelular = $linhaEnvio->telefone;

				if(@$campoCelular){
					//número do celular formatado
					$campoCelularFormat = '55'.str_replace('.','',str_replace('-','',str_replace(')','',str_replace('(','',str_replace(' ','',$campoCelular)))));

					$chSend = curl_init($url_z_api.'send-text');
					$dataSend = array(
						'phone' => $campoCelularFormat,
						"message" => $linhaMsgInscr->texto_msg
					);
					$bodySend = json_encode($dataSend);
					curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
					curl_setopt($chSend, CURLOPT_VERBOSE, true);
					curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
					curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
					curl_setopt($chSend, CURLOPT_HEADER, 0);        
					curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
					curl_setopt($chSend, CURLOPT_POST,true);        
					curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
					curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend);
					$resultSend = curl_exec($chSend);
					curl_close($chSend);
					$chSend     = '';
					$dataSend   = '';
					$bodySend   = '';
					$chSend     = '';
				}else{
					$resultSend = 'não enviado, telefone não cadastrado!';
				}

				$ins = $wpdb->query("
				INSERT INTO ead_zap_controle_msg SET
				id_curso             = '".$linhaMsgInscr->id_curso."',
				id_zap_mensagens     = '".$linhaMsgInscr->id."',
				id_user              = '".$linhaEnvio->iduser."',
				resposta_z_api       = '".$resultSend."',
				dt_disparo           = '".date('Y-m-d H:i:s')."'
				");
				$resultSend = '';
			}
		}
	}
}

unset($linhaMsgInscr);
//mensagem por curso (Formato da mensagem: Por data)
$mensagemInscricao = $wpdb->get_results("SELECT * FROM ead_zap_mensagens where tipo_mensagem='1' AND formato_mensagem='1' AND dt_enviar='".date('Y-m-d')."' AND cast(hora_enviar as unsigned INTEGER)<='".date('His')."'");
foreach($mensagemInscricao as $linhaMsgInscr){
	if($linhaMsgInscr->id_curso){

		unset($linhaEnvio);		
		$controleEnvio = $wpdb->get_results("SELECT * FROM ead_zap_inscritos where id_curso = '".$linhaMsgInscr->id_curso."' AND iduser NOT IN(SELECT id_user FROM ead_zap_controle_msg where id_curso = '".$linhaMsgInscr->id_curso."' AND id_zap_mensagens = '".$linhaMsgInscr->id."')");
		foreach($controleEnvio as $linhaEnvio){
			unset($campoCelular);

			//pegar o numero de telefone
			$campoCelular = $linhaEnvio->telefone;

			if(@$campoCelular){
				//número do celular formatado
				$campoCelularFormat = '55'.str_replace('.','',str_replace('-','',str_replace(')','',str_replace('(','',str_replace(' ','',$campoCelular)))));
				$chSend = curl_init($url_z_api.'send-text');
				$dataSend = array(
					'phone' => $campoCelularFormat,
					"message" => $linhaMsgInscr->texto_msg
				);
				$bodySend = json_encode($dataSend);
				curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
				curl_setopt($chSend, CURLOPT_VERBOSE, true);
				curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
				curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
				curl_setopt($chSend, CURLOPT_HEADER, 0);        
				curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
				curl_setopt($chSend, CURLOPT_POST,true);        
				curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
				curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend);
				$resultSend = curl_exec($chSend);
				curl_close($chSend);
				$chSend     = '';
				$dataSend   = '';
				$bodySend   = '';
				$chSend     = '';
			}else{
				$resultSend = 'não enviado, telefone não cadastrado!';
			}			
			$ins = $wpdb->query("
			INSERT INTO ead_zap_controle_msg SET
			id_curso             = '".$linhaMsgInscr->id_curso."',
			id_zap_mensagens     = '".$linhaMsgInscr->id."',
			id_user              = '".$linhaEnvio->iduser."',
			resposta_z_api       = '".$resultSend."',
			dt_disparo           = '".date('Y-m-d H:i:s')."'
			");
			$resultSend = '';
		}
	}
}

unset($linhaMsgInscr);
//mensagem por usuario (professor) - editingteacher
$mensagemInscricao = $wpdb->get_results("SELECT * FROM ead_zap_mensagens where perfil='2' AND dt_enviar='".date('Y-m-d')."' AND cast(hora_enviar as unsigned INTEGER)<='".date('His')."'");
foreach($mensagemInscricao as $linhaMsgInscr){
	unset($linhaEnvio);
	$controleEnvio = $wpdb->get_results("SELECT * FROM ead_zap_inscritos where perfil_no_curso='editingteacher' AND iduser NOT IN(SELECT id_user FROM ead_zap_controle_msg where id_zap_mensagens = '".$linhaMsgInscr->id."')");
	foreach($controleEnvio as $linhaEnvio){
		unset($campoCelular);
	
		//pegar o numero de telefone
		$campoCelular = $linhaEnvio->telefone;
					
		if(@$campoCelular){
			//número do celular formatado
			$campoCelularFormat = '55'.str_replace('.','',str_replace('-','',str_replace(')','',str_replace('(','',str_replace(' ','',$campoCelular)))));					
			$chSend = curl_init($url_z_api.'send-text');
			$dataSend = array(
				'phone' => $campoCelularFormat,
				"message" => $linhaMsgInscr->texto_msg
			);
			$bodySend = json_encode($dataSend);
			curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
			curl_setopt($chSend, CURLOPT_VERBOSE, true);
			curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
			curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($chSend, CURLOPT_HEADER, 0);        
			curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
			curl_setopt($chSend, CURLOPT_POST,true);        
			curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
			curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend);
			$resultSend = curl_exec($chSend);
			curl_close($chSend);
			$chSend     = '';
			$dataSend   = '';
			$bodySend   = '';
			$chSend     = '';
		}else{
			$resultSend = 'não enviado, telefone não cadastrado!';
		}				
		$ins = $wpdb->query("
		INSERT INTO ead_zap_controle_msg SET
		id_curso             = '".$linhaMsgInscr->id_curso."',
		id_zap_mensagens     = '".$linhaMsgInscr->id."',
		id_user              = '".$linhaEnvio->iduser."',
		resposta_z_api       = '".$resultSend."',
		dt_disparo           = '".date('Y-m-d H:i:s')."'
		");
		$resultSend = '';
	}
}


unset($linhaMsgInscr);
//mensagem por usuario (aluno)
$mensagemInscricao = $wpdb->get_results("SELECT * FROM ead_zap_mensagens where perfil='1' AND dt_enviar='".date('Y-m-d')."' AND cast(hora_enviar as unsigned INTEGER)<='".date('His')."'");
foreach($mensagemInscricao as $linhaMsgInscr){
	
	unset($linhaEnvio);		
	$controleEnvio = $wpdb->get_results("SELECT * FROM ead_zap_inscritos where perfil_no_curso='student' AND iduser NOT IN(SELECT id_user FROM ead_zap_controle_msg where id_zap_mensagens = '".$linhaMsgInscr->id."')");
	foreach($controleEnvio as $linhaEnvio){
		unset($campoCelular);
		
		//pegar o numero de telefone
		$campoCelular = $linhaEnvio->telefone;
					
		if(@$campoCelular){
			//número do celular formatado
			$campoCelularFormat = '55'.str_replace('.','',str_replace('-','',str_replace(')','',str_replace('(','',str_replace(' ','',$campoCelular)))));					
			$chSend = curl_init($url_z_api.'send-text');
			$dataSend = array(
				'phone' => $campoCelularFormat,
				"message" => $linhaMsgInscr->texto_msg
			);
			$bodySend = json_encode($dataSend);
			curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
			curl_setopt($chSend, CURLOPT_VERBOSE, true);
			curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
			curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($chSend, CURLOPT_HEADER, 0);        
			curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
			curl_setopt($chSend, CURLOPT_POST,true);        
			curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
			curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend);
			$resultSend = curl_exec($chSend);
			curl_close($chSend);
			$chSend     = '';
			$dataSend   = '';
			$bodySend   = '';
			$chSend     = '';
		}else{
			$resultSend = 'não enviado, telefone não cadastrado!';
		}				
		$ins = $wpdb->query("
		INSERT INTO ead_zap_controle_msg SET
		id_curso             = '".$linhaMsgInscr->id_curso."',
		id_zap_mensagens     = '".$linhaMsgInscr->id."',
		id_user              = '".$linhaEnvio->iduser."',
		resposta_z_api       = '".$resultSend."',
		dt_disparo           = '".date('Y-m-d H:i:s')."'
		");
		$resultSend = '';
	}
}

//------------FUNÇÕES----------
function unicodeParaAcento($texto){
	$caractere = $texto;
	$caractere = str_replace('\u00e1','á', $caractere);
	$caractere = str_replace('\u00e0','à', $caractere);
	$caractere = str_replace('\u00e2','â', $caractere);
	$caractere = str_replace('\u00e3','ã', $caractere);
	$caractere = str_replace('\u00e4','ä', $caractere);
	$caractere = str_replace('\u00c1','Á', $caractere);
	$caractere = str_replace('\u00c0','À', $caractere);
	$caractere = str_replace('\u00c2','Â', $caractere);
	$caractere = str_replace('\u00c3','Ã', $caractere);
	$caractere = str_replace('\u00c4','Ä', $caractere);
	$caractere = str_replace('\u00e9','é', $caractere);
	$caractere = str_replace('\u00e8','è', $caractere);
	$caractere = str_replace('\u00ea','ê', $caractere);
	$caractere = str_replace('\u00ea','ê', $caractere);
	$caractere = str_replace('\u00c9','É', $caractere);
	$caractere = str_replace('\u00c8','È', $caractere);
	$caractere = str_replace('\u00ca','Ê', $caractere);
	$caractere = str_replace('\u00cb','Ë', $caractere);
	$caractere = str_replace('\u00ed','í', $caractere);
	$caractere = str_replace('\u00ec','ì', $caractere);
	$caractere = str_replace('\u00ee','î', $caractere);
	$caractere = str_replace('\u00ef','ï', $caractere);
	$caractere = str_replace('\u00cd','Í', $caractere);
	$caractere = str_replace('\u00cc','Ì', $caractere);
	$caractere = str_replace('\u00ce','Î', $caractere);
	$caractere = str_replace('\u00cf','Ï', $caractere);
	$caractere = str_replace('\u00f3','ó', $caractere);
	$caractere = str_replace('\u00f2','ò', $caractere);
	$caractere = str_replace('\u00f4','ô', $caractere);
	$caractere = str_replace('\u00f5','õ', $caractere);
	$caractere = str_replace('\u00f6','ö', $caractere);
	$caractere = str_replace('\u00d3','Ó', $caractere);
	$caractere = str_replace('\u00d2','Ò', $caractere);
	$caractere = str_replace('\u00d4','Ô', $caractere);
	$caractere = str_replace('\u00d5','Õ', $caractere);
	$caractere = str_replace('\u00d6','Ö', $caractere);
	$caractere = str_replace('\u00fa','ú', $caractere);
	$caractere = str_replace('\u00f9','ù', $caractere);
	$caractere = str_replace('\u00fb','û', $caractere);
	$caractere = str_replace('\u00fc','ü', $caractere);
	$caractere = str_replace('\u00da','Ú', $caractere);
	$caractere = str_replace('\u00d9','Ù', $caractere);
	$caractere = str_replace('\u00db','Û', $caractere);
	$caractere = str_replace('\u00e7','ç', $caractere);
	$caractere = str_replace('\u00c7','Ç', $caractere);
	$caractere = str_replace('\u00f1','ñ', $caractere);
	$caractere = str_replace('\u00d1','Ñ', $caractere);
	$caractere = str_replace('\u0026','&', $caractere);
	$caractere = str_replace('\u0027',"'", $caractere);
	return $caractere;
}
function modificaConteudo($texto){
	$texto = str_replace('\"','{bInvertida}{aDupla}', $texto);
	return $texto;
}

function retornoConteudo($texto){
	$texto = str_replace('{bInvertida}{aDupla}','"', $texto);
	return $texto;
}
//------------FUNÇÕES----------

$mensagemInscricao = $wpdb->get_results( "SELECT * FROM ead_zap_mensagens where tipo_mensagem='3'");
foreach($mensagemInscricao as $linhaMsgInscr){
	if($linhaMsgInscr->id_curso){
		//echo $linhaMsgInscr->id_curso.'<br>';
		
		$url = $linhaWs->host_ead.'/webservice/rest/server.php?wstoken='.$linhaWs->token.'&wsfunction=core_course_get_contents&moodlewsrestformat=json&courseid='.$linhaMsgInscr->id_curso;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url); 
		$result=curl_exec($ch);
		curl_close($ch);
		
		
		$result = str_replace('{\"displayoptions\"','displayoptions',$result);
		$result = str_replace('displayoptions:\"a:','displayoptions:a:',$result);
		$result = str_replace('\\\"printintro','printintro',$result);
		$result = str_replace('printintro\\\";i','printintro;i',$result);
		$result = str_replace('}\",\"display\"','},display',$result);
		$result = str_replace('\printintro\\','printintro',$result);
		$result = str_replace('printintro\\','printintro',$result);
		$result = str_replace('printintro\\','printintro',$result);
		$result = str_replace('\/','/',$result);
		$result = str_replace('"\"\""','""',$result);
		$result = str_replace('printintro";i','printintro;i',$result);		
		$result = modificaConteudo(unicodeParaAcento($result));
		
		$materialDoCurso = json_decode($result, true);
		
		
		unset($linhaEnvio);
		$controleEnvio = $wpdb->get_results("SELECT * FROM ead_zap_inscritos where id_curso = '".$linhaMsgInscr->id_curso."' AND perfil_no_curso<>'editingteacher' AND iduser NOT IN(SELECT id_user FROM ead_zap_controle_msg where id_curso = '".$linhaMsgInscr->id_curso."' AND id_zap_mensagens = '".$linhaMsgInscr->id."')");
		foreach($controleEnvio as $linhaEnvio){
			unset($campoCelular);
			//echo $linhaMsgInscr->id_curso.'<br>';exit();
			//echo $linhaEnvio->iduser.'<br>';
			//echo 
			$campoCelular = $linhaEnvio->telefone;
			
			if(@$campoCelular){
				
				$wpdb->query("
				INSERT INTO ead_zap_controle_msg SET
				id_curso             = '".$linhaMsgInscr->id_curso."',
				id_zap_mensagens     = '".$linhaMsgInscr->id."',
				id_user              = '".$linhaEnvio->iduser."',
				resposta_z_api       = '-',
				dt_disparo           = '".date('Y-m-d H:i:s')."'
				");
				
				//número do celular formatado
				$campoCelularFormat = '55'.str_replace('.','',str_replace('-','',str_replace(')','',str_replace('(','',str_replace(' ','',$campoCelular)))));
				foreach($materialDoCurso as $topicos){
					
					foreach($topicos['modules'] as $modules){
						//echo '<b>modules</b><br>';
						//echo 'Id: ' . $modules['id'] . '<br>';
						//echo 'Modname: ' . $modules['modname'] . '<br>';
						
						$wpdb->query("
						INSERT INTO ead_zap_realizar_curso SET
						modulo = 'ms',
						id_topico = '".$modules['id']."',
						id_user = '".$linhaEnvio->iduser."',
						id_curso = '".$linhaMsgInscr->id_curso."',
						resposta_json = '".addslashes('{}')."',
						dt_disparo  = '".date('Y-m-d H:i:s')."'
						");
						
						if($modules['modname']=="label"){
							$modules['description'] = str_replace('&nbsp;',' ',retornoConteudo($modules['description']));
							if(substr(strip_tags($modules['description'], '<img>'),0,4)=="<img"){								
								//echo '<span style="color:red">IMAGEM:</span><br>';
								//echo $modules['description'] . '<br>';
								$doc = DOMDocument::loadHTML($modules['description']);
								$img = $doc->getElementsByTagName('img');
								foreach ($img as $src) {
									$linkDaImagem = $src->getAttribute('src');
									//echo '<br>';
									$linkDaImagem = str_replace($linhaWs->host_ead,$linhaWs->host_ead.'/webservice',$linkDaImagem).'?token='.$linhaWs->token;
									$chSend = curl_init($url_z_api.'send-image');
									$dataSend = array(
										'phone' => $campoCelularFormat,
										"image" => $linkDaImagem
									);
									$bodySend = json_encode($dataSend);
									curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-image');
									curl_setopt($chSend, CURLOPT_VERBOSE, true);
									curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
									curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
									curl_setopt($chSend, CURLOPT_HEADER, 0);        
									curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
									curl_setopt($chSend, CURLOPT_POST,true);        
									curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
									curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend); 
									$resultSend = curl_exec($chSend);
									curl_close($chSend);
									$chSend     = '';
									$dataSend   = '';
									$bodySend   = '';
									$chSend     = '';
								}								
							}else if(substr(strip_tags('<p>'.$modules['description'].'</p>', '<video>'),0,6)=="<video"){
								//echo '<span style="color:blue">VÍDEO</span><br>';
								//echo $modules['description'] . '<br>';
								@$doc = DOMDocument::loadHTML($modules['description']);
								$video = $doc->getElementsByTagName('source');
								foreach ($video as $src) {
									$linkDoVideo = $src->getAttribute('src');
									//echo '<br>';
									$linkDoVideo = str_replace($linhaWs->host_ead,$linhaWs->host_ead.'/webservice',$linkDoVideo).'?token='.$linhaWs->token;
									$chSend = curl_init();
									$dataSend = array(
										'phone' => $campoCelularFormat,
										'video' => $linkDoVideo//,
										//'caption' => $linkDaImagem
									);
									$bodySend = json_encode($dataSend);
									curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-video');
									curl_setopt($chSend, CURLOPT_VERBOSE, true);
									curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
									curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
									curl_setopt($chSend, CURLOPT_HEADER, 0);        
									curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
									curl_setopt($chSend, CURLOPT_POST,true);        
									curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
									curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend); 
									$resultSend = curl_exec($chSend);
									curl_close($chSend);
									$chSend     = '';
									$dataSend   = '';
									$bodySend   = '';
									$chSend     = '';
								}

							}else{
								//echo '<span style="color:green">TEXTO</span><br>';
								$modules['description'] = str_replace('<br />','
<br />',str_replace('<br>','
<br>',str_replace('</p>','
</p>',$modules['description'])));
								$texto = strip_tags($modules['description']);
								//echo '<br>';
								if (@strpos($texto, '&lt;MENULISTA "') !== false) {
									$gurdaBotao = @end(explode('&lt;MENULISTA "',$texto));
									$texto = str_replace('&lt;MENULISTA "'.$gurdaBotao,'',$texto);
									
									$nomeDoBotao = str_replace('"&gt;','',str_replace('&lt;MENULISTA "','',$gurdaBotao));
									$nomeDoBotao = preg_replace('/\s/',' ',@$nomeDoBotao);
									for ($x = 0; $x <= 10; $x++) {
										if(substr($nomeDoBotao,-1)==" "){
											$nomeDoBotao = substr($nomeDoBotao,0,-1);
										}
									}
									$chButton = curl_init($url_z_api.'send-option-list');
									$bodyButton = 
									'
									{
									  "phone": "'.$campoCelularFormat.'",
									  "message": "'.$nomeDoBotao.':",
									  "optionList": {
										"title": "'.$nomeDoBotao.'",
										"buttonLabel": "Abrir lista de opções",
										"options": [
										  {
											"id": "ms|'.$modules['id'].'|'.$id_user.'|'.$id_curso.'",
											"description": "'.$nomeDoBotao.'",
											"title": "SIM"
										  },
										  {
											"id": "20000000",
											"description": "Deixar para mais tarde",
											"title": "Continuar Depois"
										  }
										]
									  }
									}';
									curl_setopt($chButton, CURLOPT_URL, $url_z_api.'send-button-list');
									curl_setopt($chButton, CURLOPT_VERBOSE, true);
									curl_setopt($chButton, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($chButton, CURLOPT_AUTOREFERER, false);
									curl_setopt($chButton, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
									curl_setopt($chButton, CURLOPT_HEADER, 0);        
									curl_setopt($chButton, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt($chButton, CURLOPT_SSL_VERIFYHOST, 0);        
									curl_setopt($chButton, CURLOPT_POST,true);        
									curl_setopt($chButton, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
									curl_setopt($chButton, CURLOPT_POSTFIELDS, $bodyButton);
									$resultButton = curl_exec($chButton);
									curl_close($chButton);
									$chButton     = '';
									$bodyButton   = '';
									$chButton     = '';
									exit();
								}else if (@strpos($texto, '&lt;BOTÃO "') !== false) {
									$gurdaBotao = @end(explode('&lt;BOTÃO "',$texto));
									$texto = str_replace('&lt;BOTÃO "'.$gurdaBotao,'',$texto);
									
									$nomeDoBotao = str_replace('"&gt;','',str_replace('&lt;BOTÃO "','',$gurdaBotao));
									$nomeDoBotao = preg_replace('/\s/',' ',@$nomeDoBotao);
									for ($x = 0; $x <= 10; $x++) {
										if(substr($nomeDoBotao,-1)==" "){
											$nomeDoBotao = substr($nomeDoBotao,0,-1);
										}
									}
									$chButton = curl_init($url_z_api.'send-button-actions');
									$bodyButton = 
										'{
											"phone": "'.$campoCelularFormat.'",
											"message": "'.$texto.'",
											"buttonActions": [
												{
													"id": "ms|'.$modules['id'].'|'.$linhaEnvio->iduser.'|'.$linhaMsgInscr->id_curso.'",
													"type": "REPLY",
													"label": " '.$nomeDoBotao.'"
												}
											]
										}';
									curl_setopt($chButton, CURLOPT_URL, $url_z_api.'send-button-list');
									curl_setopt($chButton, CURLOPT_VERBOSE, true);
									curl_setopt($chButton, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($chButton, CURLOPT_AUTOREFERER, false);
									curl_setopt($chButton, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
									curl_setopt($chButton, CURLOPT_HEADER, 0);        
									curl_setopt($chButton, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt($chButton, CURLOPT_SSL_VERIFYHOST, 0);        
									curl_setopt($chButton, CURLOPT_POST,true);        
									curl_setopt($chButton, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
									curl_setopt($chButton, CURLOPT_POSTFIELDS, $bodyButton);
									$resultButton = curl_exec($chButton);
									curl_close($chButton);
									$chButton     = '';
									$bodyButton   = '';
									$chButton     = '';
									exit();
								}else if (@strpos($texto, '&lt;CONTINUAÇÃO-EM-NUMEROS&gt;') !== false) {
									$texto = str_replace('&lt;CONTINUAÇÃO-EM-NUMEROS&gt;','',$texto);
									$chSend = curl_init($url_z_api.'send-text');
									$dataSend = array(
										'phone' => $campoCelularFormat,
										"message" => $texto
									);
									$bodySend = json_encode($dataSend);
									curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
									curl_setopt($chSend, CURLOPT_VERBOSE, true);
									curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
									curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
									curl_setopt($chSend, CURLOPT_HEADER, 0);        
									curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
									curl_setopt($chSend, CURLOPT_POST,true);        
									curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
									curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend); 
									$resultSend = curl_exec($chSend);
									curl_close($chSend);
									$chSend     = '';
									$dataSend   = '';
									$bodySend   = '';
									$chSend     = '';									
									exit();
								}else{

									$chSend = curl_init($url_z_api.'send-text');
									$dataSend = array(
										'phone' => $campoCelularFormat,
										"message" => $texto
									);
									$bodySend = json_encode($dataSend);
									curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
									curl_setopt($chSend, CURLOPT_VERBOSE, true);
									curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
									curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
									curl_setopt($chSend, CURLOPT_HEADER, 0);        
									curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
									curl_setopt($chSend, CURLOPT_POST,true);        
									curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
									curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend); 
									$resultSend = curl_exec($chSend);
									curl_close($chSend);
									$chSend     = '';
									$dataSend   = '';
									$bodySend   = '';
									$chSend     = '';
								}
							}
						}else if($modules['modname']=="forum"){
							//echo '<span style="color:violet">FORUM</span><br>';
							//echo strip_tags($modules['url']) . '<br>';
							$link = strip_tags($modules['url']);
							//echo '<br>';
							$chSend = curl_init($url_z_api.'send-link');
							$dataSend = array(
								'phone' => $campoCelularFormat,
								"message" => 'Acesse o fórum deste curso para interagir ou tirar duas dúvidas!',
								"image" => $modules['modicon'],
								"linkUrl" => $link,
								"title" => 'Fórum',
								"linkDescription" => $modules['modplural']							  
							); 
							$bodySend = json_encode($dataSend);
							curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-link');
							curl_setopt($chSend, CURLOPT_VERBOSE, true);
							curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
							curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
							curl_setopt($chSend, CURLOPT_HEADER, 0);        
							curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
							curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
							curl_setopt($chSend, CURLOPT_POST,true);        
							curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
							curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend); 
							$resultSend = curl_exec($chSend);
							curl_close($chSend);
							$chSend     = '';
							$dataSend   = '';
							$bodySend   = '';
							$chSend     = '';
						}else if($modules['modname']=="resource" or $modules['modname']=="folder"){
							//echo '<span style="color:pink">ARQUIVO</span><br>';
							$texto = strip_tags($modules['name']);
							//echo '<br>';
							$chSend = curl_init();
							$dataSend = array(
								'phone' => $campoCelularFormat,
								"message" => $texto
							);
							$bodySend = json_encode($dataSend);
							curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-text');
							curl_setopt($chSend, CURLOPT_VERBOSE, true);
							curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
							curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
							curl_setopt($chSend, CURLOPT_HEADER, 0);        
							curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
							curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
							curl_setopt($chSend, CURLOPT_POST,true);        
							curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
							curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend); 
							$resultSend = curl_exec($chSend);
							curl_close($chSend);
							$chSend     = '';
							$dataSend   = '';
							$bodySend   = '';
							$chSend     = '';
							foreach($modules['contents'] as $contents){
								$chSend = curl_init();
								//echo $contents['filename'] . '('.$contents['fileurl'].')<br>';								
								$dataSend = array(
									'phone' => $campoCelularFormat,
									"document" => $contents['fileurl'].'&token='.$linhaWs->token,
									"fileName" => $contents['filename']
								);							
								$bodySend = json_encode($dataSend);
								curl_setopt($chSend, CURLOPT_URL, $url_z_api.'send-document/'.@end(explode('.',$contents['filename'])));
								curl_setopt($chSend, CURLOPT_VERBOSE, true);
								curl_setopt($chSend, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($chSend, CURLOPT_AUTOREFERER, false);
								curl_setopt($chSend, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
								curl_setopt($chSend, CURLOPT_HEADER, 0);        
								curl_setopt($chSend, CURLOPT_SSL_VERIFYPEER, 0);
								curl_setopt($chSend, CURLOPT_SSL_VERIFYHOST, 0);        
								curl_setopt($chSend, CURLOPT_POST,true);        
								curl_setopt($chSend, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8')); 
								curl_setopt($chSend, CURLOPT_POSTFIELDS, $bodySend); 
								$resultSend = curl_exec($chSend);
								curl_close($chSend);
								$chSend     = '';
								$dataSend   = '';
								$bodySend   = '';
								$chSend     = '';
							}
						}else{
							//echo 'Sem description------(' . $modules['modname'] . ')-------<br>';
						}
					}
				}
			}else{
				$resultSend = 'não enviado, telefone não cadastrado!';
			}
		}
		$url = '';
		$ch = '';
		$result = '';
		$materialDoCurso = '';
	}
}

?>
