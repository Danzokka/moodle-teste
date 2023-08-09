<?php
include 'verifica-logado.php';
include 'topo.php';

if(@$_GET['id']!=""){
	$sql = $wpdb->get_results( "SELECT * FROM ead_zap_mensagens WHERE id='".$_GET['id']."'" );
	foreach($sql as $linha);
	$nomebotao = 'Alterar Mensagem';
	$valubotao = 'alterar';
	$insertOrUpdate = "UPDATE ";
	$whereIdAlterar = " WHERE id='".$_POST['id']."'";
}else{
	$nomebotao = 'Salvar Mensagem';
	$valubotao = 'salvar';
	$insertOrUpdate = "INSERT INTO ";
	$whereIdAlterar = "";
}
if(@$_POST['botao']=="alterar" or @$_POST['botao']=="salvar"){
	foreach($_POST as $nome_campo => $valor){
		$comando = "\$" . $nome_campo . "='" . $valor . "';"; 
		eval($comando); 
	}
	
	if(@$perfil==""){ $perfil = "0"; }
	if(@$id_curso==""){ $id_curso = "0"; }
	if(@$formato_mensagem==""){ $formato_mensagem = "0"; }
	if(@$dt_enviar==""){ $dt_enviar = "2023-01-01"; }
	if(@$hora_enviar==""){ $hora_enviar = "00:00"; }
	if(@$apos_inscricao_dias==""){ $apos_inscricao_dias = "-"; }
	if(@$texto_msg==""){ $texto_msg = "-"; }
	if(@$responder_pesquisa==""){ $responder_pesquisa = "-"; }
	if(@$emitir_certificado==""){ $emitir_certificado = "-"; }
	if(@$quantidade_modulos==""){ $quantidade_modulos = "-"; }
	$ins = $wpdb->query($insertOrUpdate.
	"ead_zap_mensagens SET 
	tipo_mensagem        = '".$tipo_mensagem."',
	nome_mensagem        = '".addslashes($nome_mensagem)."',
	perfil               = '".$perfil."',
	id_curso             = '".$id_curso."',
	formato_mensagem     = '".$formato_mensagem."',
	dt_enviar            = '".$dt_enviar."',
	apos_inscricao_dias  = '".$apos_inscricao_dias."',
	hora_enviar          = '".$hora_enviar.':00'."',
	texto_msg            = '".addslashes($texto_msg)."',
	responder_pesquisa   = '".addslashes($responder_pesquisa)."',
	emitir_certificado   = '".addslashes($emitir_certificado)."',
	quantidade_modulos   = '".addslashes($quantidade_modulos)."',
	dt_mensagem_criada   = '".date('Y-m-d H:i:s')."'
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

					<h3>Cadastrar nova mensagem</h3>
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="cadastro">
						<form method="post" enctype="multipart/form-data" target="acao_iframe">
							<?php if(@$_GET['id']!=""){ ?>
								<input name="id" type="hidden" value="<?php echo $linha->id; ?>">
							<?php } ?>
							
							<div class="row g-2">
								<div class="col-md">
									<label class="form-label">Cadastrar nova mensagem</label>
									<select class="form-select" name="tipo_mensagem" required>
										<option value=""></option>
										<option value="1"<?php if($linha->tipo_mensagem=="1"){ ?> selected<?php } ?>>Mensagens Curso</option>
										<option value="2"<?php if($linha->tipo_mensagem=="2"){ ?> selected<?php } ?>>Mensagens Usuários</option>	
										<option value="3"<?php if($linha->tipo_mensagem=="3"){ ?> selected<?php } ?>>Curso por Whatsapp</option>
									</select>
								</div>
								<div class="col-md">
								
								</div>

							</div>
							
							<div class="row g-2" id="nome_mensagem">
								
								<div class="col-md">
									<label class="form-label" id="nome_ou_cursso"><?php if($linha->tipo_mensagem!="3"){ ?>Nome da mensagem<?php }else{ ?>Nome do curso<?php } ?></label>
									<input class="form-control" type="text" name="nome_mensagem" value="<?php echo $linha->nome_mensagem; ?>" required>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>
							
							<div class="row g-2" id="perfil"<?php if($linha->tipo_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Perfil</label>
									<select class="form-select" name="perfil">
										<option value=""></option>
										<option value="1"<?php if($linha->perfil=="1"){ ?> selected<?php } ?>>Aluno</option>
										<option value="2"<?php if($linha->perfil=="2"){ ?> selected<?php } ?>>Professor</option>
									</select>
								</div>

								
								<div class="col-md">
								
								</div>
							</div>
							
							<div class="row g-2" id="id_curso"<?php if($linha->tipo_mensagem!="1" and $linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Id do curso</label>
									<input class="form-control" type="text" name="id_curso" value="<?php echo $linha->id_curso; ?>">
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2" id="formato_mensagem"<?php if($linha->tipo_mensagem!="1"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Formato da mensagem</label>
									<br>
									<label><input name="formato_mensagem" style="margin: 2px 7px 4px;" type="radio" value="1"<?php if($linha->formato_mensagem=="1"){ ?> checked<?php } ?>> Por data</label>
									<label><input name="formato_mensagem" style="margin: 2px 7px 4px;" type="radio" value="2"<?php if($linha->formato_mensagem=="2"){ ?> checked<?php } ?>> Após Inscrição</label>
								</div>

								<div class="col-md">
								</div>
							</div>							
							<div style="clear:both;"></div>
							<div class="row g-2" id="dt_enviar"<?php if($linha->tipo_mensagem!="2" and $linha->formato_mensagem!="1"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Data</label>
									<input class="form-control" type="date" name="dt_enviar" value="<?php echo $linha->dt_enviar; ?>">
								</div>

								<div class="col-md">
								</div>
							</div>
							<div class="row g-2" id="apos_inscricao_dias"<?php if($linha->formato_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Após a Incrição (quantos dias)</label>
									<input class="form-control" type="number" name="apos_inscricao_dias" value="<?php echo $linha->apos_inscricao_dias; ?>">
								</div>

								<div class="col-md">
								</div>
							</div>
							<div class="row g-2" id="hora_enviar"<?php if($linha->tipo_mensagem!="1" and $linha->tipo_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Hora</label>
									<input class="form-control" type="time" name="hora_enviar" value="<?php echo substr($linha->hora_enviar,0,5); ?>">
								</div>

								<div class="col-md">
								</div>
							</div>
							<div class="row g-2" id="texto_msg"<?php if($linha->tipo_mensagem!="1" and $linha->tipo_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Texto</label>
									<textarea class="form-control" name="texto_msg" style="min-height: 107px;"><?php echo $linha->texto_msg; ?></textarea>
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2 campos_cuso_por_zap" id="responder_pesquisa"<?php if($linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Responder Pesquisa</label>
									<select class="form-select selectwhats" name="responder_pesquisa">
										<option value=""></option>
										<option value="1"<?php if($linha->responder_pesquisa=="1"){ ?> selected<?php } ?>>Sim</option>
										<option value="2"<?php if($linha->responder_pesquisa=="2"){ ?> selected<?php } ?>>Não</option>
									</select>
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2 campos_cuso_por_zap" id="emitir_certificado"<?php if($linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Emitir Certificado</label>
									<select class="form-select selectwhats" name="emitir_certificado">
										<option value=""></option>
										<option value="1"<?php if($linha->emitir_certificado=="1"){ ?> selected<?php } ?>>Sim</option>
										<option value="2"<?php if($linha->emitir_certificado=="2"){ ?> selected<?php } ?>>Não</option>
									</select>
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2 campos_cuso_por_zap" <?php if($linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Quantidade módulos</label>
									<input class="form-control" type="number" name="quantidade_modulos" value="<?php echo $linha->quantidade_modulos; ?>">
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
