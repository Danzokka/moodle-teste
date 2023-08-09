<?php
@session_start();
if($_SESSION['id_user']==""){
	echo  "<script>top.location.href='login-ead-zap.php'</script>";exit();
}
?>