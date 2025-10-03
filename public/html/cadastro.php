<?php
    session_start();

if(isset($_SESSION['user'])){
    header("location:principal.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro-login</title>
    <link rel="stylesheet" type="text/css" href="..\css\cadastro.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
</head>
<body>
    
    <main class="transresp1" id="transresp">
        <div class="formside" id="transform">
            <img src="..\imagens\pfp.png">
            <h1 id="formtit">CRIAR CONTA</h1>
            <form method="POST">
                <div class="inputbox">
                    <div class="conf" id ="conf">
                        Seu Nome:<br>                    
                        <input type="text" name="txtnome" id="nome1" required><br>
                    </div>
                    Email:<br>
                    <input type="text" name="txtemail" required><br>                   
                    Senha:<br>
                    <input type="password" name="txtsenha" class="senha" id="most1" required><input type="button" class="mostrar" value="👁" onclick="mostrarsenha()"><br>
                    <div class="conf" id ="conf3">Confirmar Senha:<br>
                        <input type="password" name="txtconfirmar" class="senha" id="most2"><input type="button" class="mostrar" value="👁" onclick="mostrarconfirm()"></div>
                    </div>
                    <input type="submit" value="Cadastrar" class="botao" id="botaologincadastrar" name="btncadastrar">
            </form>
            <span id="linklogin">Já fez cadastro? </span><a onclick='slide()' id="linklogin2">Fazer Login</a>
            <?php
                extract($_POST, EXTR_OVERWRITE);
                if(isset($btncadastrar))
                {
                    if($txtsenha == $txtconfirmar){
                        include_once '../php/cadastrologin.php';
                        $pro=new Cadastro();
                        $pro->setNome($txtnome);
                        $pro->setEmail($txtemail);
                        $senha = password_hash($txtsenha, PASSWORD_DEFAULT);
                        $pro->setSenha($senha);
                        $pro->setAdmin(false);
                        echo "<p>" . $pro->salvar() . "</p>";
                    }
                    else{
                        echo "<p>Erro: Senhas inseridas não são iguais</p>";
                    }
                }
                if(isset($btnlogar)){
                    include_once '../php/cadastrologin.php';
                    $pro=new Cadastro();
                    $pro->setEmail($txtemail);
                    $pro->setSenha($txtsenha);
                    if($pro->login() == true){
                        header('location:principal.php');
                    }
                    else{
                        echo "<p>Erro: email e/ou senha incorretos</p>";
                    }
                }
            ?>
        </div>
        <div class="logoside" id="translogo">
            <img src="..\imagens\logo.png">
            <h1 id="logotit">SEJA BEM VINDO(A)!</h1>
            <p class="logotxt">Links:</p>
            <ul>
                <li><a href="principal.php">Principal</a></li>
                <li><a href="historia.php">Historia</a></li>
                <li><a href="infraestrutura.php">Infraestrutura</a></li>
                <li><a href="Tipos_De_Energia.php">Tipos De Energia</a></li>
            </ul>
        </div>    
    </main>
    <script src="../js/cadastro.js"></script>
</body>
</html>