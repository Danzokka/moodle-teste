<?php
include 'verifica-logado.php';
include 'topo.php';

$sql = $wpdb->get_results( "SELECT * FROM ead_zap_mensagens WHERE id='".$_GET['id']."'" );
foreach($sql as $linha);
?>


    <div class="container_turma">
        <div class="container_turma_int">
          

            <div class="area_info_curso">
                <div class="area_formulario">

					<h3>Cadastrar nova mensagem</h3>
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="cadastro">
						<form method="post" enctype="multipart/form-data" target="acao_iframe">
							
							<div class="row g-2">
								<div class="col-md">
									<label class="form-label">Formato da mensagem</label>
									<br>
									<?php if($linha->tipo_mensagem=="1"){ ?>Mensagens Curso<?php } ?>
									<?php if($linha->tipo_mensagem=="2"){ ?>Mensagens Usuários<?php } ?>
									<?php if($linha->tipo_mensagem=="3"){ ?>Curso por Whatsapp<?php } ?>
								</div>
								<div class="col-md">
								
								</div>

							</div>
							
							<div class="row g-2" id="nome_mensagem">
								
								<div class="col-md">
									<label class="form-label" id="nome_ou_cursso"><?php if($linha->tipo_mensagem!="3"){ ?>Nome da mensagem<?php }else{ ?>Nome do curso<?php } ?></label>
									<br>
									<?php echo $linha->nome_mensagem; ?>
								</div>
								
								<div class="col-md">
								
								</div>
							</div>
							
							<div class="row g-2" id="perfil"<?php if($linha->tipo_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Perfil</label>
									<br>
									<?php if($linha->perfil=="1"){ ?> Aluno<?php } ?>
									<?php if($linha->perfil=="2"){ ?> Professor<?php } ?>
								</div>

								
								<div class="col-md">
								
								</div>
							</div>
							
							<div class="row g-2" id="id_curso"<?php if($linha->tipo_mensagem!="1" and $linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Id do curso</label>
									<br><?php echo $linha->id_curso; ?> 
									<?php if($linha->tipo_mensagem!="3"){ ?>Periódo (<?php 
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
									echo date('d/m/Y',$linhaCurso->startdate).' - '.date('d/m/Y',$linhaCurso->enddate);
									?>)<?php } ?>
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2" id="formato_mensagem"<?php if($linha->tipo_mensagem!="1"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Formato da mensagem</label>
									<br>
									<?php if($linha->formato_mensagem=="1"){ ?> Por data<?php } ?>
									<?php if($linha->formato_mensagem=="2"){ ?> Após Inscrição<?php } ?>
								</div>

								<div class="col-md">
								</div>
							</div>							
							<div style="clear:both;"></div>
							<div class="row g-2" id="dt_enviar"<?php if($linha->tipo_mensagem!="2" and $linha->formato_mensagem!="1"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Data</label>
									<br><?php echo $linha->dt_enviar; ?>
								</div>

								<div class="col-md">
								</div>
							</div>
							<div class="row g-2" id="apos_inscricao_dias"<?php if($linha->formato_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Após a Incrição (quantos dias)</label>
									<br><?php echo $linha->apos_inscricao_dias; ?>
								</div>

								<div class="col-md">
								</div>
							</div>
							<div class="row g-2" id="hora_enviar"<?php if($linha->tipo_mensagem!="1" and $linha->tipo_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Hora</label>
									<br><?php echo substr($linha->hora_enviar,0,5); ?>
								</div>

								<div class="col-md">
								</div>
							</div>
							<div class="row g-2" id="texto_msg"<?php if($linha->tipo_mensagem!="1" and $linha->tipo_mensagem!="2"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Texto</label>
									<br>
									<pre><?php echo $linha->texto_msg; ?></pre>
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2 campos_cuso_por_zap" id="responder_pesquisa"<?php if($linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Responder Pesquisa</label>
									<br>
									<?php if($linha->responder_pesquisa=="1"){ ?> Sim<?php } ?>
									<?php if($linha->responder_pesquisa=="2"){ ?> Não<?php } ?>
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2 campos_cuso_por_zap" id="emitir_certificado"<?php if($linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Emitir Certificado</label>
									<br>
									<?php if($linha->emitir_certificado=="1"){ ?> Sim<?php } ?>
									<?php if($linha->emitir_certificado=="2"){ ?> Não<?php } ?>
								</div>

								<div class="col-md">
								</div>
							</div>
							
							<div class="row g-2 campos_cuso_por_zap" <?php if($linha->tipo_mensagem!="3"){ ?> style="display:none;"<?php } ?>>
								<div class="col-md">
									<label class="form-label">Quantidade módulos</label>
									<br><?php echo $linha->quantidade_modulos; ?>
								</div>

								<div class="col-md">
								</div>
							</div>

							<hr style="border-top: 0px solid;">
							<a href="ead_zap-list-mensagens.php" class="btn btn-warning btn-xs">Voltar</a>&nbsp;&nbsp;
							<a href="ead_zap-cad-mensagens.php?id=<?php echo $linha->id; ?>" class="btn btn-primary btn-xs">Alterar</a>
						</form>
                      </div>

				</div>
			</div>

        </div>
    </div>
<?php
include 'rodape.php';
?>