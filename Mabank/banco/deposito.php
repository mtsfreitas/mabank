<?php
    session_start();
	require_once('CRUD/create.php');
    require_once('CRUD/update.php');
	
	$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_transacao = 'DEPOSITO';
    $r = inserirHistoricoTransacao($_SESSION['idusuario'], $tipo_transacao, $valor, $_SESSION['cpf']);
	
	if($r == null){
        $r = alterarSaldo($_SESSION['idusuario'], "saldo + ${valor}");

        if($r){
            $_SESSION['saldo'] += $valor;
            echo "<p align=center><font color=white size='6pt'> Valor depositado!\n</font></p>";
            echo "<body style='background-color:#820ad1'>";
            echo "<p align=center><font color=white size='6pt'> Você será redirecionado em 3 segundos...</font></p>";
            header("refresh:3; url=../index.php" );
        } else{
            echo "<p align=center><font color=white size='6pt'>Erro ao depositar valor!\n</font></p>";
        }
		
	} else{
		echo "<ul>";
		foreach($r as $e){
			echo "<li>{$e}</li>";
		}
		echo "</ul>";
	}
?>
