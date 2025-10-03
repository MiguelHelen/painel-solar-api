
<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Porto Solar - História</title>
  <link rel="stylesheet" href="../css/historia.css" />
   <link rel="icon" href="../imagens/PortSol-removebg-preview (1) (1).png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <header>
    <div class="logo">
  
      <img src="../imagens/PortSol-removebg-preview (1) (1).png" alt="Logo Porto Solar" />
    </div>
    <div class="sessao">  
      <?php 
        if(isset($_SESSION['user'])){
          echo "<p>Bem vindo(a), ". $_SESSION['nome'] ."</p>"; 
        }
      ?>
    </div>
    <div class="titulo">
      <h1>História</h1>
      <br>
      <p>Saiba mais sobre a história e as informações <br> do Porto de Santos.</p>
       <div class="linha-titulo"></div>
    </div>
   
    <nav class="navbar">
      <ul>
        <li><a href="principal.php">Principal</a></li>
        <li><a href="#">História</a></li>
        <li><a href="infraestrutura.php">Infraestrutura</a></li>
        <li><a href="Tipos_De_Energia.php">Tipo de Energia</a></li>
      </ul>

       <form name="loginlogout" method="POST">
          <?php
            if(!isset($_SESSION['user'])){
              echo "<input type='submit' class='btn-login' name='login' value='Entrar'>";
            }
            else{
              echo "<input type='submit' class='btn-login' name='logout' value='Sair'>";
            }
          ?>
          <?php
            extract($_POST, EXTR_OVERWRITE);
            if(isset($login)){
              header('location:cadastro.php');
            }
            if(isset($logout)){
              session_destroy();
              header('location:cadastro.php');
            }
          ?>
        </form>
    </nav>

    <div class="linha-navbar"></div>
  </header>

    <section class="faixa-infra">
     <h2>História do Porto de Santos</h2>
    </section>

    <div class="text-1">
    <p>Podemos dizer que o Porto de Santos teve um certo início de suas atividades no século XVI. 
    Continuou operando com equipamentos pouco desenvolvidos até o final do século XIX. Após receber 
    determinados investimentos, a Companhia Docas de Santos (CDS) viabilizou sua construção.</p>
    </div>
    <br/>



    <div class="container">
      <div class="lado-Esq">
      <p class="dat1">Sua inauguração, Como estrutura organizada, foi no ano de:</p>
      <p class="dat2">02 de fevereiro de 1892</p>
      </div>

      <div class="lado-Dir">
       <figure class="img-box">
          <img src="../imagens/PinturaPorto.png" alt="Pintura do Porto de Santos" />
          <figcaption>Pintura representando o Porto de Santos no século XIX.</figcaption>
        </figure>
      </div>
      </div>
<br/>
<br/>
<br/>
    <section class="faixa-infra2">
      <br/>
      <div class="text-2">
      <p>Dessa forma, estabeleceu-se como um marco para o país, sendo o primeiro Porto Organizado 
      brasileiro. Ao longo das décadas, alcançou uma posição de destaque na economia nacional.</p>
      </div>

      <br/>
      <br/>

    
      <div class="container-2">
        <h2>Os principais fundadores do Porto de Santos, enquanto um porto organizado, foram: </h2>

        <figure class="img-box2">
          <p>Cândido Gaffrée</p>
          <img src="../imagens/Img_CândidoGaffrée.png" alt="Imagem de Cândido Gaffrée" />
        </figure>

        <figure class="img-box2">
          <p>Eduardo Guinle</p>
          <img src="../imagens/Img_EduardoGuinle.png" alt="Imagem de Eduardo Guinle" />
        </figure>

        <p class="text-3">Foram esses dois empresários que em 1888, receberam o direito 
          à construção e exploração do porto. Além de José Pinto de Oliveira, João Gomes 
          Ribeiro de Avellar, Alfredo Camilo Valdetaro, Benedicto Antônio da Silva e a firma Ribeiro, 
          Barros & Braga. </p>
      </div>
      <br>
      <br>
      <br/>
    </section>



      <br/>

      <div class="container-3">
      <h2>Impactos Ambientais</h2>

      <div class="linha-conteudo">
      <div class="linha-emparelhada"></div>

      <div class="conteudo">

        <h3>1892 – Fundação oficial:</h3>
        <p>
        O porto foi oficialmente inaugurado com estrutura moderna para a época, iniciando sua trajetória como principal escoadouro do café brasileiro.
        </p>
       

        <h3>1930 – Expansão e modernização:</h3>
        <p>
          Grandes obras ampliaram os cais e melhoraram a logística portuária com a introdução de guindastes e armazéns.
        </p>
      

        <h3>1970 – Integração ferroviária e novos terminais:</h3>
        <p>
          Conexões ferroviárias fortalecem o escoamento de cargas do interior do Brasil até o porto.
        </p>
       

        <h3>Atualidade:</h3>
        <p>
         Hoje, o Porto de Santos é o maior da América Latina, movimentando bilhões em exportações e importações 
         e servindo como um dos pilares logísticos do país.
        </p>

        <figure class="img-box3">
          <img src="../imagens/image 2.png" alt="Área do Porto" />
          <figcaption class="Fing">Panorama da ampla área do Porto.</figcaption>
        </figure>

        <figure class="img-box3">
          <img src="../imagens/image 3.png" alt="Embarcação com Guindastes" />
          <figcaption class="Fing">Embarcação portuária levando guindastes.</figcaption>
        </figure>
        </div>
        </div>
        </div>

        <br/>
       <br/>

        <div class="container-4">

      <div class="quad">
        <h3>Porto Antigo</h3>
        <p>De ponto colonial a escoadouro do café, o início da história.</p>
      </div>

      <div class="quad">
        <h3>Industrialização</h3>
        <p>Modernização da infraestrutura ao longo do século XX.</p>
      </div>

      <div class="quad">
        <h3>Conexão Global</h3>
        <p>Integração logística com o comércio mundial.</p>
      </div>

     
    </div>
 <br/>
       <br/>

        <footer>
    <div class="coluna">
      <h4>Menu</h4>
      <ul>
        <li><a href="principal.php">Principal</a></li>
        <li><a href="#">História</a></li>
        <li><a href="infraestrutura.php">Infraestrutura</a></li>
        <li><a href="Tipos_De_Energia.php">Tipo de Energia</a></li>
      </ul>
    </div>
    <div class="coluna">
      <h4>Social</h4>
      <ul>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">Facebook</a></li>
      </ul>
    </div>
    <div class="coluna">
      <h4>Suporte</h4>
      <ul>
        <li><a href="#">+11 97493-3487</a></li>
        <li><a href="mailto:portosolar@gmail.com">portosolar@gmail.com</a></li>
        <li><strong>Porto Solar</strong></li>
      </ul>
       <div class="logo">
  
      <img src="../imagens/PortSol-removebg-preview (1) (1).png" alt="Logo Porto Solar" />
    </div>
    </div>
  </footer>
</body>
</html>