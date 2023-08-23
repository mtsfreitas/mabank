<?php
	require_once('conexao.php');
	require_once('read.php');

	/* Essa função tem como objetivo inserir um usuário no banco de dados.
		Retorna null se a operação foi um sucesso. Caso contrário, retorna um array de erros.
		Exemplo de insert:
		
		INSERT INTO `usuario`(`idusuario`, `nome`, `email`, `senha`, `cpf`, `saldo`, `endereco`, `plano_saude`) 
		VALUES (null,'Jose da Silva', 'jose@gmail.com', md5('12345'), '1234567891011', 100.00, 'UFV Florestal', 'UNIMED')
	*/
	function inserirUsuario($nome, $email, $senha, $cpf, $saldo, $endereco, $plano_saude){
		global $conexao;
		if(strlen($nome) < 1){
			$erros[] = "Nome de usuário é obrigatório.";
		}
		if(strlen($email) < 1){
			$erros[] = "E-mail é obrigatório.";
		}
		if(strlen($senha) < 1){
			$erros[] = "Senha inválida! Precisa ter ao menos um caractere.";
		}
		if(strlen($cpf) < 1){
			$erros[] = "CPF é obrigatório.";
		}
		if(checaValorCadastrado('email', $email)){
			$erros[] = "<p align=center><font color=white size='6pt'>O e-mail informado já está cadastrado em nossos sistemas.</font></p>";
			echo "<body style='background-color:#820ad1'>";
            header("refresh:3; url=../cadastro.php" );
		}
		if(checaValorCadastrado('cpf', $cpf)){
			$erros[] = "<p align=center><font color=white size='6pt'>O cpf informado já está cadastrado em nossos sistemas.</font></p>";
			echo "<body style='background-color:#820ad1'>";
            header("refresh:3; url=../cadastro.php" );
		}
		if(empty($erros)){
			$sql = "INSERT INTO usuario (nome, email, senha, cpf, saldo, endereco, plano_saude) ";
			$sql .= " VALUES ('{$nome}', '{$email}', md5('{$senha}'), '{$cpf}', '{$saldo}', '{$endereco}', '{$plano_saude}')";

			if(!mysqli_query($conexao, $sql)){
				$erros[] = "<h1>Houve algum erro durante o seu cadastro em nossos sistemas.</h1>";
				$erros[] = mysqli_error($conexao);
				return $erros;
			}
			
			return null;
		}
		return $erros;
	}

	/* Essa função tem como objetivo inserir uma transação de um usuário no banco de dados.
		Retorna null se a operação foi um sucesso. Caso contrário, retorna um array de erros.
	*/
	function inserirHistoricoTransacao($fk_idusuario, $tipo_transacao, $valor, $cpf_transacao){
		global $conexao;
		if($valor <= 0){
			$erros[] = "O valor da operação precisa ser maior do que 0.";
		}
		if(empty($erros)){
			$sql = "INSERT INTO historico_transacao (fk_idusuario, tipo_transacao, valor, cpf_transacao) ";
			$sql .= " VALUES ({$fk_idusuario}, '{$tipo_transacao}', {$valor}, '{$cpf_transacao}')";

			if(!mysqli_query($conexao, $sql)){
				$erros[] = "<h1>Houve algum erro durante o seu cadastro em nossos sistemas.</h1>";
				$erros[] = mysqli_error($conexao);
				return $erros;
			}
			
			return null;
		}
		return $erros;
	}
	
?>