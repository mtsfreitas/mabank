<?php
	require_once('conexao.php');	

	function alterarSaldo($idusuario, $novoSaldo){
		global $conexao;
		
		$sql = "UPDATE usuario SET saldo={$novoSaldo} WHERE idusuario={$idusuario}";

		if(mysqli_query($conexao, $sql)){
			return true;
		} else{
			return false;
		}
	}
	
?>