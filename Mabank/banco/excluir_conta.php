<?php
    session_start();
	require_once('CRUD/delete.php');
	
    $r = deletarConta($_SESSION['idusuario']);
	
	if($r == true){
        if($r){
            session_destroy();
            echo "<body style='background-color:#820ad1'>";
            echo "<p align=center><font color=white size='6pt'>Conta excluída com sucesso!\n</font></p>";
            echo "<p align=center><font color=white size='6pt'>Você será redirecionado em 3 segundos...</font></p>";
            header("refresh:3; url=../index.php" );
        } else{
            echo "<body style='background-color:#820ad1'>";
            echo "<p align=center><font color=white size='6pt'>Erro ao excluir a conta!\n</font></p>";
        }
		
	} else{
		echo "<ul>";
		foreach($r as $e){
			echo "<li>{$e}</li>";
		}
		echo "</ul>";
	}
?>
