<?php
    session_start();
	require_once('CRUD/create.php');
    require_once('CRUD/read.php');
    require_once('CRUD/update.php');
	
	$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf_transacao = filter_input(INPUT_POST, 'cpf_transacao', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_transacao = 'PAGAMENTO';

    if($_SESSION['saldo'] - $valor > 0){

        $resultado_consulta = getListaUsuarios("cpf = '${cpf_transacao}'");
        if($resultado_consulta !== false && $resultado_consulta->num_rows > 0){
            $r = inserirHistoricoTransacao($_SESSION['idusuario'], $tipo_transacao, $valor, $cpf_transacao);
        } else{
            echo "<body style='background-color:#820ad1'>";
            $r[] = "<p align=center><font color=white size='6pt'>Este CPF não existe!</font></p>";
        }
    } else{
        $valor_convertido = number_format((float)$valor, 2, ',', '');
        $saldo_convertido = number_format((float)$_SESSION['saldo'], 2, ',', '');
        echo "<body style='background-color:#820ad1'>";
        $r[] = "<p align=center><font color=white size='6pt'>Saldo insuficiente! Você não pode pagar R$${valor_convertido} tendo apenas R$${saldo_convertido}</font></p>";
    }
	
	if($r == null){
        $r = alterarSaldo($_SESSION['idusuario'], "saldo - ${valor}");

        if($r){
            $destinatario = mysqli_fetch_assoc($resultado_consulta);
            $r = alterarSaldo($destinatario['idusuario'], "saldo + ${valor}");
            $_SESSION['saldo'] -= $valor;
            echo "<p align=center><font color=white size='6pt'>Valor depositado!\n</font></p>";
            echo "<body style='background-color:#820ad1'>";
            echo "<p align=center><font color=white size='6pt'>Você será redirecionado em 3 segundos...</font></p>";
            header("refresh:3; url=../index.php" );
        } else{
            echo "Erro ao depositar valor!\n";
        }
		
	} else{
		echo "<ul>";
		foreach($r as $e){
			echo "<li>{$e}</li>";
		}
		echo "</ul>";

        echo "\n<p align=center><font color=white size='6pt'>Você será redirecionado em 5 segundos...</font></p>";
        header("refresh:5; url=../index.php" );
	}
?>
