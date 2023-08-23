<?php
    $servidor = "localhost";
    $banco = "mabank";
    $usuario = "root";
    $senha = "";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if($conexao === false){
        die("Não foi possível conectar no banco " . mysqli_connect_error());
    }
?>