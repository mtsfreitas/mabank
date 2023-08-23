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
      
    <script type="text/javascript">
        function fMasc(objeto,mascara) {
            obj=objeto
            masc=mascara
            setTimeout("fMascEx()",1)
        }
        function fMascEx() {
            obj.value=masc(obj.value)
        }
        function maskCPF(cpf) {
            cpf=cpf.replace(/\D/g,"")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
            return cpf
        }
        function transformarMaiuscula(campo) {
            setTimeout(function() {
                campo.value = campo.value.toUpperCase();
            }, 1);
        }
        function validaSenha(campoSenha) {
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (regex.test(campoSenha) === false) {
                alert("Insira a senha corretamente: minímo de 8 caracteres, deve conter pelo menos: 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caractere especial.");
                return false
            } else {
                campo_senha  = document.getElementById("senha");
			    campo_confirmar_senha  = document.getElementById("campo_confirmar_senha");
		    	if(campo_senha.value !== campo_confirmar_senha.value){
			    	alert("A senha informada no campo de confirmação não corresponde à senha informada. Verifique-a novamente.");
				    return false;
		    	}
                return true;
            }
        }
        function validaNome(campoNome) {
            var regex = /^[a-zA-Z\s]*$/;
            if (regex.test(campoNome) === false) {
                alert("Insira o nome corretamente");
                return false
            }
        }
        function validaEmail(campoEmail) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (regex.test(campoEmail) == false) {
                alert("Insira o email corretamente. ex: matheus.f.martins@ufv.br");
                return false
            }
        }
        function validaCPF(campoCPF) {
            var regex = /[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}/;
            if (regex.test(campoCPF) == false) {
                alert("Insira o CPF corretamente.");
                return false
            }
        }
        function validaEndereco(campoEndereco) {
            if (campoEndereco.length > 255 || campoEndereco.length == 0) {
                alert("Insira um endereço com até 255 caracteres.");
                return false
            }
        }
        function exibeAlertaSucesso() {
            alert("Você preencheu o cadastro como esperávamos. Obrigado.");
        }

        
        function validarCadastro(frm) {
            if (validaNome(frm.nome.value) == false) {
                frm.nome.focus();
                return false;
            }
            if (validaEmail(frm.email.value) == false) {
                frm.email.focus();
                return false;
            }
            if (validaCPF(frm.cpf.value) == false) {
                frm.cpf.focus();
                return false;
            }
            if (validaEndereco(frm.endereco.value) == false) {
                frm.endereco.focus();
                return false;
            }
            if (validaSenha(frm.senha.value) == false) {
                frm.senha.focus();
                return false;
            }
            exibeAlertaSucesso();
            return true;
        }
    </script>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light mabanknavigation fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fonte-nav cor-especial-texto" href="index.php">
                    <img src="assets/images/MAbank_logo.png" alt="Mabank" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"        
                    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"           
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active inicio" aria-current="page" href="index.php">Início</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
  
    <section id="titulos" class="background-text">
        <h1 class="fonte-titulo text-center cor-especial-texto pt-3 pb-3 genericColor">Crie sua conta!</h1>
    </section>




	<div class="container">
        <form name="formulario" method="post" action="banco/criar_conta_usuario.php" onsubmit="return validarCadastro(this);">
                <fieldset class="border p-2 genericColor"><legend class="w-auto"><h5>Dados Pessoais</h5></legend>
                <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome completo" onkeydown="transformarMaiuscula(this)">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF" onkeydown="javascript: fMasc( this, maskCPF );">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite seu endereço">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="endereco">Qual plano de saúde deseja ganhar?</label><br>
                            <input type="radio" name="plano_saude" value="UNIMED" id="plano_saude_unimed" required>
                            <label for="plano_saude_unimed">UNIMED</label><br>
                            <input type="radio" name="plano_saude" value="AMIL" id="plano_saude_amil" checked="checked">
                            <label for="plano_saude_amil">Amil</label><br>
                            <input type="radio" name="plano_saude" value="ASPENG" id="plano_saude_aspeng">
                            <label for="plano_saude_aspeng">ASPENG</label><br>
                            <input type="radio" name="plano_saude" value="NENHUM" id="plano_saude_nenhum">
                            <label for="plano_saude_nenhum">Nenhum, já possuo</label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="senha_usuario">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="campo_confirmar_senha">Confirmar Senha</label>
                            <input type="password" class="form-control" id="campo_confirmar_senha" name="campo_confirmar_senha" placeholder="Digite novamente sua senha">
                        </div>
                </div>
                </fieldset>
                
            <div class="text-center">
                <button type="submit" class="btn botao-cor-especial m-4 btnCadastrar">Cadastrar</button>
            </div>
            
        </form>
	</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<footer style="position:fixed; bottom:0; text-align:center; height:auto; margin-top:40px;
            width:100%;">
        <p>Author: Matheus Freitas Martins <a href="mailto:matheus.f.martins@ufv.br">matheus.f.martins@ufv.br</a></p>
</footer>
</html>