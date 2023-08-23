<?php
	session_start();
	if(isset($_SESSION)){
	  session_destroy();
	  echo "<body style='background-color:#820ad1'>";
	  echo "<h4><p align=center><font color=white size='6pt'>Logout efetuado com sucesso...</h4></font></p>";
	} else{
	  echo "<h4><p align=center><font color=white size='6pt'>Sua sessão já estava encerrada!</h4></font></p>";
	}
	echo "<h5><p align=center><font color=white size='6pt'>Redirecionando para a tela inicial em 3 segundos...</h5></font></p>";
	header("refresh:3; url=../index.php" );
?>