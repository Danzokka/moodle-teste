<?php
include 'verifica-logado.php';
include 'topo.php';

$sql = $wpdb->get_results( "SELECT * FROM ead_zap_token_moodle WHERE id='1'" );
foreach($sql as $linha);
if(@$linha->id!=""){
	$nomebotao = 'Alterar';
	$valubotao = 'alterar';
	$insertOrUpdate = "UPDATE ";
	$whereIdAlterar = " WHERE id='".$_POST['id']."'";
}else{
	$nomebotao = 'Salvar';
	$valubotao = 'salvar';
	$insertOrUpdate = "INSERT INTO ";
	$whereIdAlterar = "";
}
if(@$_POST['botao']=="alterar" or @$_POST['botao']=="salvar"){
	foreach($_POST as $nome_campo => $valor){
		$comando = "\$" . $nome_campo . "='" . $valor . "';"; 
		eval($comando); 
	}
	
	$ins = $wpdb->query($insertOrUpdate.
	"ead_zap_token_moodle SET 
	host_ead            = '".addslashes($host_ead)."',
	token               = '".addslashes($token)."',
	campo_celular       = '".addslashes($campo_celular)."',
	token_z_api         = '".addslashes($token_z_api)."',
	token_wordpress     = '".addslashes($token_wordpress)."',
	dt_mensagem_criada  = '".date('Y-m-d H:i:s')."'
	".$whereIdAlterar);
	echo "<script>
	alert('Ação realizada com sucesso');
	top.location.href='?".$_SERVER['QUERY_STRING']."';
	</script>";
	exit();
}
?>


    <div class="container_turma">
        <div class="container_turma_int">
          

            <div class="area_info_curso">
                <div class="area_formulario">

					<h3>Connfigurações de intergração Moodle/EadZap</h3>
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="cadastro">
						<form method="post" enctype="multipart/form-data" target="acao_iframe">
							<?php if(@$_GET['id']!=""){ ?>
								<input name="id" type="hidden" value="<?php echo $linha->id; ?>">
							<?php } ?>
							
							<div class="row g-2">
								<div class="col-md">
									<label class="form-label">Link do HOST da plataforma EAD (Ex: http://localhost/moodle)</label>
									<input class="form-control" type="text" name="host_ead" value="<?php echo $linha->host_ead; ?>" required>
								</div>
								<div class="col-md">
								
								</div>

							</div>
							
							<div class="row g-2">
								
								<div class="col-md">
									<label class="form-label">Token Webservice de integração moodle</label>
									<input class="form-control" type="text" name="token" value="<?php echo $linha->token; ?>" required>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>
							
							<div class="row g-2">
								
								<div class="col-md">
									<label class="form-label">Token Z-API (Instância)</label>
									<input class="form-control" type="text" name="token_z_api" value="<?php echo $linha->token_z_api; ?>" required>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>
							
							<div class="row g-2">
								
								<div class="col-md">
									<label class="form-label">Token EadZap para retorno moodle(webhook) e retorno z-api</label>
									<input class="form-control" type="text" name="token_wordpress" value="<?php echo $linha->token_wordpress; ?>" required>
									<span style="font-size: 10px; color: blue;">Retorno webhhok moodle: <br>http://{ENDEREÇO-DO-SISTEMA-EADZAP}/retorno_ead.php</span>
									<br>
									<span style="font-size: 10px; color: green;">Retorno webhhok z-api: <br>http://{ENDEREÇO-DO-SISTEMA-EADZAP}/curso-por-whatsapp.php?token=TOKEN-DEFINIDO-ACIMA</span>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>
							
							

							<hr style="border-top: 0px solid;">
							<button class="btn btn-success mb-3" name="botao" value="<?php echo $valubotao; ?>" type="submit"><?php echo $nomebotao; ?></button>
						</form>
                      </div>

				</div>
			</div>

        </div>
    </div>
	
<script>
$("select[name=tipo_mensagem]").change(function(){
	if($("select[name=tipo_mensagem]").val()=='1' || $("select[name=tipo_mensagem]").val()=='3'){
		$("#id_curso").show();
		$(".campos_cuso_por_zap").hide();
	}else{
		$("#id_curso").hide();		
	}
	if($("select[name=tipo_mensagem]").val()=='1'){
		$("#formato_mensagem").show();
		$("#hora_enviar").hide();
		$("#dt_enviar").hide();
		$("#perfil").hide();
		$("#nome_ou_cursso").html('Nome da mensagem');
		$("#texto_msg").show();
	}else{
		$("#formato_mensagem").hide();
		$("#apos_inscricao_dias").hide();
		if($("select[name=tipo_mensagem]").val()!='2'){
			$("#hora_enviar").hide();
			$("#dt_enviar").hide();
		}
		$("input[name='formato_mensagem']").removeAttr("checked");
	}
	if($("select[name=tipo_mensagem]").val()=='2'){
		$("#perfil").show();
		$("#hora_enviar").show();
		$("#dt_enviar").show();
		$("#apos_inscricao_dias").hide();
		$("#nome_ou_cursso").html('Nome da mensagem');
		$("#texto_msg").show();
		$(".campos_cuso_por_zap").hide();
	}else{
		$("#perfil").hide();
	}	
	if($("select[name=tipo_mensagem]").val()=='3'){
		$("#nome_ou_cursso").html('Nome do curso');
		$(".campos_cuso_por_zap").show();
		$("#texto_msg").hide();
	}
});

$("input[name='formato_mensagem']").click(function() {
    if ($(this).val() === '1') {
      $("#dt_enviar").show();
	  $("#apos_inscricao_dias").hide();	
    }
	if ($(this).val() === '2') {
	  $("#apos_inscricao_dias").show();
	  $("#dt_enviar").hide();	  
    }
	
	if($(this).val() === '1' || $(this).val() === '2'){
		$("#hora_enviar").show();
	}
});
</script>

<?php
include 'rodape.php';
?>