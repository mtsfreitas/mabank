<?php
	require_once('CRUD/create.php');

	$erros = array();
	if(isset($_POST) and isset($_POST['email']) and isset($_POST['senha'])){
	  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	  $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

	  if(empty($email) or empty($senha)){
			echo "<body style='background-color:#820ad1'>";
			$erros[] = "<h1> <p align=center><font color=white size='6pt'margin-top:176px>Email ou senha ausentes!</h1></font></p>";
			header("refresh:3; url=../index.php" );
	  } else{
			$r = verificarAutenticacao($email, $senha);
			if($r != null){
				session_start();
				$dados = mysqli_fetch_array($r);
				$_SESSION['idusuario'] = $dados['idusuario'];
				$_SESSION['nome'] = $dados['nome'];
				$_SESSION['cpf'] = $dados['cpf'];
				$_SESSION['email'] = $dados['email'];
				$_SESSION['saldo'] = $dados['saldo'];
				header('Location: ../index.php');
			} else{
				echo "<body style='background-color:#820ad1'>";
				$erros[] = "<p align=center><font color=white size='6pt'>E-mail ou senha incorretos!</font></p>";
				header("refresh:3; url=../index.php" );
			}
	  }
	} else{
	  $erros[] = "<h1><p align=center><font color=white size='6pt'>Dados para login ausentes!</h1></font></p>";
	}

	echo "<ul>";
	foreach($erros as $e){
	  echo "<li>{$e}</li>";
	}
	echo "</ul>";
?>

