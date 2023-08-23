<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=" utf-8">
    <meta name="viewport" content="width=device-width, initial-scale =1">
    <title>Mabank</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sevillana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script>
        var flagMostrarOpcoesAvancadas = false;
        function mostrarOpcoesAvancadas(){
            flagMostrarOpcoesAvancadas = !flagMostrarOpcoesAvancadas;
            if(flagMostrarOpcoesAvancadas){
                opcoes_avancadas.style = "display:visible";
                textoOpcoesAvancadas.innerHTML = "\\/ Esconder opções avançadas";
            } else{
                opcoes_avancadas.style = "display:none";
                textoOpcoesAvancadas.innerHTML = "> Mostrar opções avançadas";
            }
        }
    </script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top mabanknavigation">
            <div class="container-fluid">
                <a class="navbar-brand fonte-nav cor-especial-texto" href="#">
                    <img src="assets/images/MAbank_logo.png" alt="Mabank" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"        
                    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"           
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <?php if(isset($_SESSION['idusuario'])) { ?>
                        <ul class="navbar-nav">
                            <li><a class="nav-link active logout" aria-current="page" href="banco/logout.php">Logout</a></li>
                        </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php
            if(!isset($_SESSION['idusuario'])){ // se não estiver logado, mostra tela de login / cadastro
        ?>
            <div>
                <header class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Faça seu Login</h5>
                </header>
                <form name="formulario" method="post" action="banco/login.php">
                    <main class="modal-body">
                            
                        <div class="form-group">
                                <label for="endereco_email" id="emailText">Endereço de e-mail</label>
                                <input type="email" class="form-control" id="endereco_email" name="email" placeholder="nome@exemplo.com">
                        </div>

                        <div class="form-group">
                                <label for="exampleDropdownFormPassword1" id="senhaText">Senha</label>
                                <input type="password" class="form-control" id="exampleDropdownFormPassword1" name="senha" placeholder="xxxxx">
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="submit" class="btn btn-primary btnEntrar">Entrar</button><br>
                        <button type="button" class="btn btn-primary btnCadastro" data-dismiss="modal" onclick="window.location.href='cadastro.php'">Cadastre-se</button>
                    </footer>
                </form>
            </div>
        <?php
            } else { // se estiver logado, mostra a página do usuário
        ?>
            <h2>Olá, <?= $_SESSION['nome'] ?>!</h2>
            
            <h2>Saldo atual: R$<?= number_format((float)$_SESSION['saldo'], 2, ',', ''); ?>!</h2>

            <fieldset class="border p-2 genericColor"><legend class="w-auto"><h5>Depósito</h5></legend>
                <div class="form-row">
                    
                        <div class="form-group col-md-6 genericColor">
                            <form name="formulario_deposito" method="post" action="banco/deposito.php">
                                <label for="valor">Valor para depósito:</label>
                                <input type="number" min="1" step="any" class="form-control" id="valor" name="valor" placeholder="Valor para depósito" required>
                                <br><button type="submit" class="btn btn-primary">Efetuar depósito</button>
                            </form>
                        </div>
                    
                </div>
            </fieldset>

            <fieldset class="border p-2 genericColor"><legend class="w-auto"><h5>Pagamento</h5></legend>
                <div class="form-row">
                    
                        <div class="form-group col-md-6 genericColor">
                            <form name="formulario_deposito" method="post" action="banco/pagamento.php">
                                <label for="valor">Valor para pagamento:</label>
                                <input type="number" min="1" step="any" class="form-control" id="valor" name="valor" placeholder="Valor para depósito" required>
                                <label for="cpf_transacao">Você deseja pagar para quem? (CPF)</label>
                                <input type="text" class="form-control" id="cpf_transacao" name="cpf_transacao" placeholder="Entre com um CPF para quem você deseja pagar">
                                <br><button type="submit" class="btn btn-primary">Efetuar pagamento</button>
                            </form>
                        </div>
                    
                </div>
            </fieldset>
            
            <br>
            <p id="textoOpcoesAvancadas" onclick="mostrarOpcoesAvancadas();">> Mostrar opções avançadas</p>

            <div id="opcoes_avancadas" style="display:none">
                <fieldset class="border p-2"><legend class="w-auto"><h5>Opções Avançadas</h5></legend>
                    <div class="form-row">
                        
                            <div class="form-group col-md-3">
                                <form name="formulario_deposito" method="post" action="banco/listar_historico_transacoes.php">
                                    <br><button type="submit" class="btn btn-primary">Carregar histórico de transações</button>
                                </form>
                            </div>

                            <div class="form-group col-md-3">
                                <form name="formulario_deposito" method="post" action="banco/excluir_conta.php" onsubmit="return confirm('Deseja realmente excluir sua conta?');">
                                    <br><button type="submit" class="btn btn-danger">Excluir minha conta</button>
                                </form>
                            </div>
                    </div>
                </fieldset>
            </div>
        <?php
            }
        ?>
    </main>
    <footer style="position:fixed; bottom:0; text-align:center; height:auto; margin-top:40px;
            width:100%;">
        <p>Author: Matheus Freitas Martins <a href="mailto:matheus.f.martins@ufv.br">matheus.f.martins@ufv.br</a></p>
    </footer>
</body>
</html>