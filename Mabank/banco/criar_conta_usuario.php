<?php	
	require_once('CRUD/create.php');
	
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
	$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
	// $saldo = filter_input(INPUT_POST, 'saldo', FILTER_SANITIZE_SPECIAL_CHARS);
	$saldo = 0.0;
	$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
	$plano_saude = filter_input(INPUT_POST, 'plano_saude', FILTER_SANITIZE_SPECIAL_CHARS);

	$r = inserirUsuario($nome, $email, $senha, $cpf, $saldo, $endereco, $plano_saude);
	
	if($r == null){
		echo "<p align=center><font color=white size='6pt'>SUCESSO!\n</font></p>";
		echo "<p align=center><font color=white size='6pt'>Você será redirecionado em 3 segundos...</font></p>";
		echo "<body style='background-color:#820ad1'>";
		header("refresh:3; url=../index.php" );
	} else{
		echo "<ul>";
		foreach($r as $e){
			echo "<li>{$e}</li>";
		}
		echo "</ul>";
	}
?>