<?php
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

                    <div class="tab-pane p-3 active preview" role="tabpanel" id="cadastro">
						<form method="post" action="logar.php" enctype="multipart/form-data" target="acao_iframe">
							<div class="row g-2">
								<div class="col-md">
								
								</div>
								<div class="col-md">
									<h3>Acesso ao Sistema</h3>
								</div>
								<div class="col-md">
								
								</div>

							</div>
							
							
							<div class="row g-2" id="nome_mensagem">
								<div class="col-md">
								
								</div>
								<div class="col-md">
									<label class="form-label">Login</label>
									<input class="form-control" type="text" name="usuario" required>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>
							<div class="row g-2" id="nome_mensagem">
								<div class="col-md">
								
								</div>
								<div class="col-md">
									<label class="form-label">Senha</label>
									<input class="form-control" type="password" name="sua_senha" required>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>
							
							<div class="row g-2" id="nome_mensagem">
								<div class="col-md">
								
								</div>
								<div class="col-md">
									<button class="btn btn-success mb-3" name="entrar" value="Entrar" type="submit">Entrar</button>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>

						</form>
                      </div>



        </div>
    </div>
        </div>
    </div>	

<?php
include 'rodape.php';
?>