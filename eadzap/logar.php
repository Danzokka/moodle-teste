<?php
@session_start();
include 'dao/conexao/conexao.php';
include 'dao/geralDAO.php';
$wpdb = new GeralDAO();
if(@$_POST["entrar"]=="Entrar"){
	$date = date ("Y-m-d H:i");
	$login      = addslashes($_POST['usuario']);
	$senhacript = addslashes($_POST['sua_senha']);
	$senha      = md5($senhacript);

	if($login=="" or $senha==""){
		echo "<script>alert('Insira um usuário e uma senha para continuar!');</script>";
	}else{		
		$sql  = "SELECT * FROM usuarios where seu_email = '$login'";
		$rows = $wpdb->GeralContItens($sql);
		if($rows != 0) {
			@$rs   = $wpdb->get_results($sql);
			foreach ($rs as $linha);
			$senhaLinha      = $linha->sua_senha;
			if($senha == $senhaLinha) {				
				$id_user = $linha->id;
				$_SESSION['id_user'] = $id_user;				
				echo  "<script>top.location.href='ead_zap-list-mensagens.php'</script>";exit();
			} else echo "<script>alert('Senha invalida!');</script>"; exit();			
		} else echo "<script>alert('Usuário inválido!');</script>";exit();		
	}
    exit();
}
?>