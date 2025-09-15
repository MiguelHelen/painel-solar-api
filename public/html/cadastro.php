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
            <form action="" method="POST">
                <div class="inputbox">
                    Seu Nome:<br>
                    <input type="text" name="txtnome" required><br>
                    <div class="conf" id ="conf">Email:<br>
                    <input type="text" name="txtemail" required><br>
                    </div>
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
                        $pro->setSenha($txtsenha);
                        echo "<p>" . $pro->salvar() . "</p>";
                    }
                    else{
                        echo "<p>Erro: Senhas inseridas não são iguais</p>";
                    }
                }
            ?>
        </div>
        <div class="logoside" id="translogo">
            <img src="..\imagens\logo.png">
            <h1 id="logotit">SEJA BEM VINDO(A)!</h1>
            <p class="logotxt">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum consequuntur voluptates corrupti porro. Corporis quis doloremque tempore, id libero excepturi? Fugit, cum. Natus aliquam perspiciatis corrupti tempore maiores! Veritatis, neque.</p>
        </div>    
    </main>
    <script src="../js/cadastro.js"></script>
</body>
</html>