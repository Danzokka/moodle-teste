<?php
include 'dao/conexao/conexao.php';
include 'dao/geralDAO.php';
$wpdb = new GeralDAO();
global $wpdb;
@date_default_timezone_set('America/Sao_Paulo');

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
	$texto = str_replace('&nbsp;',' ', $texto);
	return $texto;
}
//------------FUNÇÕES----------


$sqlWs = $wpdb->get_results("SELECT * FROM ead_zap_token_moodle WHERE id='1'");
foreach($sqlWs as $linhaWs);
$token_wordpress = $linhaWs->token_wordpress;
$url_z_api = $linhaWs->token_z_api;
if($_GET['token']==$token_wordpress){
	$method = $_SERVER['REQUEST_METHOD'];
	if($method == 'GET' or $method == 'POST'){
		$requestBody = file_get_contents('php://input');
		$lendo = json_decode($requestBody);
		if($lendo->listResponseMessage->selectedRowId!="" or $lendo->buttonReply->buttonId!="" or $lendo->text->message=="1" or $lendo->text->message=="2" or $lendo->text->message=="3" or $lendo->text->message=="4" or $lendo->text->message=="5" or $lendo->text->message=="6" or $lendo->text->message=="7"){
			$campoCelularFormat = $lendo->phone;
			if($lendo->listResponseMessage->selectedRowId){
				$buttonId = $lendo->listResponseMessage->selectedRowId;
				$buttonIdArray = explode("|", $buttonId);
			}else if($lendo->buttonReply->buttonId){
				$buttonId = $lendo->buttonReply->buttonId;
				$buttonIdArray = explode("|", $buttonId);
			}

			if($lendo->listResponseMessage->selectedRowId!="" or $lendo->buttonReply->buttonId!=""){
				//echo 'modulo: '.$buttonIdArray[0];
				$arrayInsert = " modulo='".$buttonIdArray[0]."',";
				$acaoRespondida = $buttonIdArray[0];
				if($buttonIdArray[0]=="questionario"){
					$respostaUser = $buttonIdArray[4];
				}
				
				//echo 'id_topico: '.$buttonIdArray[1];
				$arrayInsert .= " id_topico='".$buttonIdArray[1]."',";
				$idTpcoRespondido = $buttonIdArray[1];
				
				//echo 'id_user: '.$buttonIdArray[2];
				$arrayInsert .= " id_user='".$buttonIdArray[2]."',";
				$id_user = $buttonIdArray[2];
				
				//echo 'id_curso: '.$buttonIdArray[3];
				$arrayInsert .= " id_curso='".$buttonIdArray[3]."',";
				$id_curso = $buttonIdArray[3];
			}else{
				$arrayInsert = " modulo='respostapEmNum',";
				$arrayInsert .= " id_topico='0',";

				$userCursoFone = $wpdb->get_results("SELECT id_curso,iduser FROM ead_zap_inscritos WHERE (REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(telefone,' ',''),')',''),'(',''),'-',''),' ','')='".substr($lendo->phone,2)."' or REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(telefone,' ',''),')',''),'(',''),'-',''),' ','')='".substr($lendo->phone,2,2)."9".substr($lendo->phone,4)."') AND perfil_no_curso='student' ORDER BY id DESC LIMIT 1");
				foreach($userCursoFone as $linhaUserCursoFone);
				if(@$linhaUserCursoFone->iduser==""){ 
					exit(); 
				}
				$arrayInsert .= " id_user='".$linhaUserCursoFone->iduser."',";
				$id_user = $linhaUserCursoFone->iduser;
				
				$arrayInsert .= " id_curso='".$linhaUserCursoFone->id_curso."',";
				$id_curso = $linhaUserCursoFone->id_curso;
			}
			$ins = $wpdb->query("
			INSERT INTO ead_zap_realizar_curso SET
			".$arrayInsert."
			resposta_json    = '".addslashes($requestBody)."',
			dt_disparo  = '".date('Y-m-d H:i:s')."'
			");
			
			
			$sqlEnvios = $wpdb->get_results("SELECT * FROM ead_zap_realizar_curso WHERE id_user='".$id_user."' AND id_curso='".$id_curso."'");
			foreach($sqlEnvios as $linhaEnvios){
				$modulosEnviados[] = $linhaEnvios->modulo.$linhaEnvios->id_topico;
			}
			if($buttonId=="20000000"){
				exit();
			}
			$url = $linhaWs->host_ead.'/webservice/rest/server.php?wstoken='.$linhaWs->token.'&wsfunction=core_course_get_contents&moodlewsrestformat=json&courseid='.$id_curso;
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
			foreach($materialDoCurso as $topicos){
				
				
				foreach($topicos['modules'] as $modules){
					//echo '<b>modules</b><br>';
					//echo 'Id: ' . $modules['id'] . '<br>';
					//echo 'Modname: ' . $modules['modname'] . '<br>';
					
					$verificaEnvio = 'ms'.$modules['id'];
					if(in_array($verificaEnvio,$modulosEnviados, true)){
						//não enviar mensagem novamente ou conferir se foi enviado uma resposta de um questionário
						if($acaoRespondida=="questionario" and $modules['id']==$idTpcoRespondido){
							$modules['description'] = str_replace('&nbsp;',' ',retornoConteudo($modules['description']));
							$modules['description'] = str_replace('<br />','
<br />',str_replace('<br>','
<br>',str_replace('</p>','
</p>',$modules['description'])));
							$texto = strip_tags($modules['description']);
							
							$texto = str_replace('&lt;QUESTIONÁRIO&gt;','',$texto);
							$removeOpcoesErespostas = @end(explode('&lt;RESPOSTAS&gt;',$texto));
							$texto = str_replace('&lt;RESPOSTAS&gt;'.$removeOpcoesErespostas,'',$texto);
							
							$removeRespostas = @end(explode('&lt;OPÇÕES DE FEEDBACK&gt;',$removeOpcoesErespostas));
							$opcoesBotaoResp = str_replace('&lt;OPÇÕES DE FEEDBACK&gt;'.$removeRespostas,'',$removeOpcoesErespostas);
							
							$respostasQuest = explode('&lt;FEEDBACK OPÇÃO "',$removeRespostas);
							foreach($respostasQuest as $resposta){
								$removerTemp = @end(explode('"&gt;',$resposta));
								$retirarDaResposta = $removerTemp;
								$idDaRespostaQuestao = str_replace('"&gt;'.$removerTemp,'',$resposta);
								$idDaRespostaQuestao = preg_replace('/\s/','',str_replace('\r','',str_replace('\n','',str_replace('&nbsp;','',str_replace(' ','',$idDaRespostaQuestao)))));
								if($idDaRespostaQuestao==$respostaUser){
									$chSend = curl_init();
									$dataSend = array(
										'phone' => $campoCelularFormat,
										"message" => $retirarDaResposta
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
						}
					}else{
						if(@str_replace('&nbsp;','',str_replace(' ','',strip_tags(retornoConteudo($modules['description']))))=='&lt;STATUS"FINALIZADO"&gt;'){
							exit();
						}
						$wpdb->query("
						INSERT INTO ead_zap_realizar_curso SET
						modulo = 'ms',
						id_topico = '".$modules['id']."',
						id_user = '".$id_user."',
						id_curso = '".$id_curso."',
						resposta_json = '".addslashes(retornoConteudo($modules['description']))."',
						dt_disparo  = '".date('Y-m-d H:i:s')."'
						");
						
						if($modules['modname']=="label"){
							$modules['description'] = str_replace('&nbsp;',' ',retornoConteudo($modules['description']));
							if(substr(strip_tags($modules['description'], '<img>'),0,4)=="<img"){								
								//echo '<span style="color:red">IMAGEM:</span><br>';
								//echo $modules['description'] . '<br>';
								preg_match('/<img.*?src="([^"]+)".*?alt="([^"]*)".*?width="([^"]*)".*?height="([^"]*)".*?class="([^"]*)"/', $modules['description'], $matches);
								if (count($matches) > 0) {
									$linkDaImagem = $matches[1];//src
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
							}else if(substr(strip_tags('<p>'.$modules['description'].'</p>', '<iframe>'),0,7)=="<iframe"){
								//echo '<span style="color:blue">VÍDEO</span><br>';
								//echo $modules['description'] . '<br>';
								preg_match('/<iframe.*?src="(.*?)"/', $modules['description'], $matchesLink);
								preg_match('/<iframe.*?title="(.*?)"/', $modules['description'], $matchesTitle);
								$link = $matchesLink[1];
								$title = $matchesTitle[1];
								//echo '<br>';
								$chSend = curl_init($url_z_api.'send-link');
								$dataSend = array(
								'phone' => $campoCelularFormat,
								"message" => $title,
								"linkUrl" => $link,
								"title" => $title,
								"linkDescription" => 'Acesso link para visualizar o conteúdo!'
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
							}else if(substr(strip_tags('<p>'.$modules['description'].'</p>', '<video>'),0,6)=="<video"){
								//echo '<span style="color:blue">VÍDEO</span><br>';
								//echo $modules['description'] . '<br>';
								preg_match('/<source.*?src="(.*?)"/', $modules['description'], $matchesVideos);
								
								if (count($matchesVideos) > 0) {
									$linkDoVideo = $matchesVideos[1];//src
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
								if(str_replace('&nbsp;','',str_replace(' ','',$texto))=='&lt;STATUS"FINALIZADO"&gt;'){
									exit();
								}
								if(substr(str_replace('&nbsp;','',str_replace(' ','',$texto)),0,21)=='&lt;QUESTIONÁRIO&gt;'){
									$texto = str_replace('&lt;QUESTIONÁRIO&gt;','',$texto);
									$removeOpcoesErespostas = @end(explode('&lt;RESPOSTAS&gt;',$texto));
									$texto = str_replace('&lt;RESPOSTAS&gt;'.$removeOpcoesErespostas,'',$texto);
									
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
									
									$removeRespostas = @end(explode('&lt;OPÇÕES DE FEEDBACK&gt;',$removeOpcoesErespostas));
									$opcoesBotaoResp = str_replace('&lt;OPÇÕES DE FEEDBACK&gt;'.$removeRespostas,'',$removeOpcoesErespostas);
									$opcoesBotaoRespArray = explode('"&gt;',$opcoesBotaoResp);
									
									//echo $opcoesBotaoRespArray[0];
									foreach($opcoesBotaoRespArray as $opcaoResp){
										$opcaoMenuList = preg_replace('/\s/','',str_replace('\r','',str_replace('\n','',str_replace('&nbsp;','',str_replace(' ','',str_replace('&lt;MENULISTA OPÇÃO "','',$opcaoResp))))));
										if($opcaoMenuList){
											$opcaoMenuListArray .= 
											'
											{
												"id": "questionario|'.$modules['id'].'|'.$id_user.'|'.$id_curso.'|'.$opcaoMenuList.'",
												"description": "'.$opcaoMenuList.'",
												"title": "Opção"
											  },';
										}
										
										$opcaoBtn = preg_replace('/\s/','',str_replace('\r','',str_replace('\n','',str_replace('&nbsp;','',str_replace(' ','',str_replace('&lt;BOTÃO OPÇÃO "','',$opcaoResp))))));
										if($opcaoBtn){
											$opcaoBtnArray .= 
											'{
												"id": "questionario|'.$modules['id'].'|'.$id_user.'|'.$id_curso.'|'.$opcaoBtn.'",
												"type": "REPLY",
												"label": " Opção '.$opcaoBtn.'"
											},';
										}
										
									}
									if(substr($opcaoMenuListArray,0,-1)){
										$bodyButton = 
										'
										{
										"phone": "'.$campoCelularFormat.'",
										"message": "Respondendo questionário:",
										"optionList": {
											"title": "Escolha uma das opções",
											"buttonLabel": "Abrir lista de opções",
											"options": [
											'.substr($opcaoMenuListArray,0,-1).'
											]
										}
										}';
										$chButton = curl_init();
										curl_setopt($chButton, CURLOPT_URL, $url_z_api.'send-option-list');
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
									}
									if(substr($opcaoBtnArray,0,-1)){
										$bodyButton = 
										'{
											"phone": "'.$campoCelularFormat.'",
											"message": "Clique no botão abaixo 👇",
											"buttonActions": [
												'.substr($opcaoBtnArray,0,-1).'
											]
										}';
										$chButton = curl_init();
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
									}
								}else {
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
													"id": "ms|'.$modules['id'].'|'.$id_user.'|'.$id_curso.'",
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
			}
		}
	}
}
?>