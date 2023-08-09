<?php
include 'verifica-logado.php';
include 'topo.php';

?>


    <div class="container_turma">
        <div class="container_turma_int">
          

            <div class="area_info_curso">
                <div class="area_formulario">

					<?php
$admTpl .= '
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Mensagens Curso
			</div>
			<div class="panel-body">
				<div class="table-linhaponsive">
					<table class="table">
						<thead>
							<tr>
								<th>Curso</th>
								<th>Mensagem</th>
								<th>Disparo</th>
								<th>Hora</th>
								<th style="width: 120px;">#</th>
							</tr>
						</thead>
						<tbody>
						{mensagemCurso}
						</tbody>
					</table>                           
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Mensagens Usuários
			</div>
			<div class="panel-body">
				<div class="table-linhaponsive">
					<table class="table">
						<thead>
							<tr>
								<th>Mensagem</th>
								<th>Perfil</th>
								<th>Disparo</th>
								<th>Hora</th>
								<th style="width: 120px;">#</th>
							</tr>
						</thead>
						<tbody>
						{mensagemUsuario}
						</tbody>
					</table>                           
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Curso por Whatsapp
			</div>
			<div class="panel-body">
				<div class="table-linhaponsive">
					<table class="table">
						<thead>
							<tr>
								<th>Curso</th>
								<th>ID do Curso</th>
								<th>Tem Pesquisa</th>
								<th>Emitir Certificado</th>
								<th style="width: 120px;">#</th>
							</tr>
						</thead>
						<tbody>
						{cursoPorZap}
						</tbody>
					</table>                           
				</div>
			</div>
		</div>
		
		<a href="ead_zap-cad-mensagens.php" class="btn btn-success btn-xs">Nova Mensagem</a>
	</div>
 </div>				 
</div>';
		
$sql = $wpdb->get_results("SELECT * FROM `ead_zap_mensagens` WHERE tipo_mensagem='1' order by dt_mensagem_criada desc");
foreach($sql as $linha){
	if($linha->id_curso){
		$url = $linhaWs->host_ead.'/webservice/rest/server.php?wstoken='.$linhaWs->token.'&wsfunction=core_course_get_courses&moodlewsrestformat=json&options[ids][0]='.$linha->id_curso;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		$dadosDoCurso = json_decode($result);
		foreach($dadosDoCurso as $linhaCurso);
		unset($url);
		unset($ch);
		unset($result);
		unset($dadosDoCurso);
		$linhaCurso = $linhaCurso->fullname;
	}else{
		$linhaCurso = 'Todos';
	}
	if($linha->formato_mensagem=="1"){
		$disparo = substr($linha->dt_enviar,-2).'/'.substr($linha->dt_enviar,-5,2).'/'.substr($linha->dt_enviar,0,4);
	}else if($linha->formato_mensagem=="2"){
		if($linha->apos_inscricao_dias=="0"){
			$disparo = 'No dia da inscrição';
		}else{
			$disparo = $linha->apos_inscricao_dias.' dias após a inscrição';
		}
	}else{
		$disparo = '';
	}
	$mensagemCurso .= '<tr class="success_m2">';
	$mensagemCurso .= '<td>'.$linhaCurso."</td>";
	$mensagemCurso .= '<td>'.$linha->nome_mensagem."</td>";
	$mensagemCurso .= '<td>'.$disparo."</td>";
	$mensagemCurso .= '<td>'.substr($linha->hora_enviar,0,5)."</td>";
	$mensagemCurso .= '<td>
					<a href="ead_zap-detal-mensagens.php?id='.$linha->id.'" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
					<a href="ead_zap-cad-mensagens.php?id='.$linha->id.'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
					<a href="ead_zap-del-mensagens.php?id='.$linha->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
				</td>';
	$mensagemCurso .= '</tr>';
}

$templateVars['{mensagemCurso}'] = $mensagemCurso;
//Substituir variáveis no template

$sql = $wpdb->get_results("SELECT * FROM `ead_zap_mensagens` WHERE tipo_mensagem='2' order by dt_mensagem_criada desc");
foreach($sql as $linha){
	if($linha->perfil=="1"){
		$perfil = 'Aluno';
	}
	if($linha->perfil=="2"){
		$perfil = 'Professor';
	}
	
	
	$disparo = substr($linha->dt_enviar,-2).'/'.substr($linha->dt_enviar,-5,2).'/'.substr($linha->dt_enviar,0,4);
	
	$mensagemUsuario .= '<tr class="success_m2">';
	$mensagemUsuario .= '<td>'.$linha->nome_mensagem."</td>";
	$mensagemUsuario .= '<td>'.$perfil."</td>";
	$mensagemUsuario .= '<td>'.$disparo."</td>";
	$mensagemUsuario .= '<td>'.substr($linha->hora_enviar,0,5)."</td>";
	$mensagemUsuario .= '<td>
					<a href="ead_zap-detal-mensagens.php?id='.$linha->id.'" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
					<a href="ead_zap-cad-mensagens.php?id='.$linha->id.'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
					<a href="ead_zap-del-mensagens.php?id='.$linha->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
				</td>';
	$mensagemUsuario .= '</tr>';
}

$templateVars['{mensagemUsuario}'] = $mensagemUsuario;
//Substituir variáveis no template

$sql = $wpdb->get_results("SELECT * FROM `ead_zap_mensagens` WHERE tipo_mensagem='3' order by dt_mensagem_criada desc");
foreach($sql as $linha){
	if($linha->responder_pesquisa=="1"){
		$responder_pesquisa = 'Sim';
	}
	if($linha->responder_pesquisa=="2"){
		$responder_pesquisa = 'Não';
	}
	if($linha->emitir_certificado=="1"){
		$emitir_certificado = 'Sim';
	}
	if($linha->emitir_certificado=="2"){
		$emitir_certificado = 'Não';
	}
	
	
	$disparo = substr($linha->dt_enviar,-2).'/'.substr($linha->dt_enviar,-5,2).'/'.substr($linha->dt_enviar,0,4);
	
	$cursoPorZap .= '<tr class="success_m2">';
	$cursoPorZap .= '<td>'.$linha->nome_mensagem."</td>";
	$cursoPorZap .= '<td>'.$linha->id_curso."</td>";
	$cursoPorZap .= '<td>'.$responder_pesquisa."</td>";
	$cursoPorZap .= '<td>'.$emitir_certificado."</td>";
	$cursoPorZap .= '<td>
					<a href="ead_zap-detal-mensagens.php?id='.$linha->id.'" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
					<a href="ead_zap-cad-mensagens.php?id='.$linha->id.'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
					<a href="ead_zap-del-mensagens.php?id='.$linha->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
				</td>';
	$cursoPorZap .= '</tr>';
}

$templateVars['{cursoPorZap}'] = $cursoPorZap;
//Substituir variáveis no template

$admTpl = strtr($admTpl,$templateVars);
echo $admTpl;
?>


				</div>
			</div>
		</div>
	</div>
	

<?php
include 'rodape.php';
?>