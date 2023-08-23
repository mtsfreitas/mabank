<html>
<head>
    <meta charset=" utf-8">
    <meta name="viewport" content="width=device-width, initial-scale =1">
    <title>Mabank</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sevillana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top mabanknavigation">
            <div class="container-fluid">
                <a class="navbar-brand fonte-nav cor-especial-texto" href="../index.php">
                    <img src="../assets/images/MAbank_logo.png" alt="Mabank" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"        
                    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"           
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <?php if(isset($_SESSION['idusuario'])) { ?>
                        <ul class="navbar-nav">
                            <li><a class="nav-link active" aria-current="page" href="banco/logout.php">Logout</a></li>
                        </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </nav>
</header>
<?php
    session_start();
    require_once('CRUD/read.php');

    $idusuario = $_SESSION['idusuario'];
    $resultado_consulta = getListaHistoricoTransacoes("fk_idusuario = ${idusuario}");
    $r = null;
    if($resultado_consulta !== false && $resultado_consulta->num_rows > 0){
?>
    <div>
        <table>
            <tr>
                <th>Tipo da Transação</th>
                <th>Valor</th>
                <th>CPF de destino</th>
                <th>Data da transação</th>
            </tr>

<?php
        
        while ($row = $resultado_consulta->fetch_array(MYSQLI_ASSOC)) {
?>
            <tr>
                <td><?= $row['tipo_transacao'] ?></td>
                <td>R$<?= number_format((float)$row['valor'], 2, ',', '') ?></td>
                <td><?= $row['cpf_transacao'] ?></td>
                <td><?= date_format(date_create($row['data_transacao']),"d/m/Y H:i:s") ?></td>
            </tr>
<?php
        }
?>
        </table>
    </div>
<?php
    } else{
        echo "<body style='background-color:#820ad1'>";
        $r[] = "<p align=center><font color=white size='6pt'>Não existe registros em seu histórico de transações.</font></p>";
    }
	
	if($r != null){
		echo "<ul>";
		foreach($r as $e){
			echo "<li>{$e}</li>";
		}
		echo "</ul>";
        echo "<body style='background-color:#820ad1'>";
        echo "\n<p align=center><font color=white size='6pt'>Você será redirecionado em 5 segundos...</font></p>";
        header("refresh:5; url=../index.php" );
	} else{
?>
        <button type="button" class="btn btn-primary btnVoltarPrincipal" onclick="window.location.href='../index.php'">Voltar à página principal</button>
<?php
    }
?>
</body>
<footer style="position:fixed; bottom:0; text-align:center; height:auto; margin-top:40px;
            width:100%;">
        <p>Author: Matheus Freitas Martins <a href="mailto:matheus.f.martins@ufv.br">matheus.f.martins@ufv.br</a></p>
    </footer>
</html>