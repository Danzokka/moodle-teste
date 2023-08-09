<?php
include 'verifica-logado.php';
include 'topo.php';

?>


    <div class="container_turma">
        <div class="container_turma_int">
          

            <div class="area_info_curso">
                <div class="area_formulario">

					<?php
					if($_GET['confir']=="sim"){
						$ins = $wpdb->query("DELETE FROM ead_zap_mensagens WHERE id='".$_GET['id']."';");
						echo "<script>alert('Excluído com sucesso!')</script>";
						echo "<script>location.href='ead_zap-list-mensagens.php'</script>";
					}
					$admTpl .= '
					<h4>Deseja realmente excluir este registro?</h4>
					<a href="ead_zap-list-mensagens.php" class="btn btn-primary btn-xs">Não</a>
					<a href="ead_zap-del-mensagens.php?id='.$_GET['id'].'&confir=sim" class="btn btn-danger btn-xs">Sim</a>
					';

					$templateVars['{STATS}'] = $listas;
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