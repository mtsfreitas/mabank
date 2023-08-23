<?php
	require_once('conexao.php');
	
	/* Retorna true se o valor informado já foi cadastrado para algum usuário. False caso contrário. */
	function checaValorCadastrado($nomeCampo, $valor){
		$r = getListaUsuarios("{$nomeCampo} = '{$valor}'");
		if($r and mysqli_num_rows($r) > 0){
			return true;
		}
		return false;
	}
	
	/*  Função responsável por verificar se as autenticações estão corretas.
		Retorna o resultado da consulta se o usuário com as credenciais foi encontrado. Caso contrário, retorna null.
	*/
	function verificarAutenticacao($email, $senha){
		$filtro = "senha = md5('{$senha}') and email = '{$email}'";
		$r = getListaUsuarios($filtro);
		if($r and mysqli_num_rows($r) > 0){		
			return $r;
		}
		return null;
	}
	
	/* Retorna resultado da consulta (mysqli_result) */
	function getListaUsuarios($filtro = null, $orderby = 'ORDER BY nome'){
		global $conexao;
		if($filtro != null and strlen($filtro) > 0){
			$sql_aux = " WHERE {$filtro}";
		} else{
			$sql_aux = "";
		}

		$sql = "SELECT idusuario, nome, email, senha, cpf, saldo, endereco, plano_saude from usuario {$sql_aux} {$orderby}";
		$r = mysqli_query($conexao, $sql);
		return $r;
	}

	/* Retorna resultado da consulta (mysqli_result) */
	function getListaHistoricoTransacoes($filtro = null, $orderby = 'ORDER BY tipo_transacao'){
		global $conexao;
		if($filtro != null and strlen($filtro) > 0){
			$sql_aux = " WHERE {$filtro}";
		} else{
			$sql_aux = "";
		}

		$sql = "SELECT tipo_transacao, valor, cpf_transacao, data_transacao from historico_transacao {$sql_aux} {$orderby}";
		$r = mysqli_query($conexao, $sql);
		return $r;
	}

?>