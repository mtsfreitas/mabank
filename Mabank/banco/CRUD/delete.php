<?php
	require_once('conexao.php');	
	
	function deletarConta($idusuario){
		global $conexao;

		$sql = "DELETE FROM historico_transacao WHERE fk_idusuario = '{$idusuario}'";

		if(mysqli_query($conexao, $sql)){
			$sql = "DELETE FROM usuario WHERE idusuario = '{$idusuario}'";

			if(mysqli_query($conexao, $sql)){
				return true;
			} else{
				return false;
			}
		} else{
			return false;
		}
	}
	
?>