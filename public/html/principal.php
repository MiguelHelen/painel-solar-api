<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Porto Solar - Tela Principal</title>
  <link rel="stylesheet" href="../css/principal.css" />
  <script defer src="../js/principal.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <header>
    <div class="logo">
  
      <img src="../imagens/PortSol-removebg-preview (1) (1).png" alt="Logo Porto Solar" />
    </div>
    <div class="titulo">
      <h1>Simulando hoje a energia do futuro<br>nos portos inteligentes de amanhã.</h1>
      <br>
      <p>Simule, analise e planeje o uso da energia solar em áreas portuárias</p>
       <div class="linha-titulo"></div>
    </div>
   
    <nav class="navbar">
      <ul>
        <li><a href="#">Principal</a></li>
        <li><a href="historia.php">História</a></li>
        <li><a href="#">Infraestrutura</a></li>
        <li><a href="#">Tipo de Energia</a></li>
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
      </form>
    </nav>
    <div class="linha-navbar"></div>
  </header>

  <main>
    <section class="recursos">
      <h2>Os recursos disponíveis para você</h2>
      <p>Estão todos reunidos aqui, prontos para facilitar o seu planejamento da forma mais eficiente possível.</p>

      <div class="carrossel-container">
        <div class="carrossel" id="carrossel">
          <div class="slide"><img src="../imagens/1.png" alt="Gráfico 1"></div>
          <div class="slide"><img src="../imagens/2.png" alt="Mapa 2"></div>
          <div class="slide"><img src="../imagens/1.png" alt="Outro gráfico"></div>
        </div>
        <div class="carrossel-controles">
          <button class="btn-anterior">&#10094;</button>
          <button class="btn-proximo">&#10095;</button>
        </div>
      </div>
    </section>

    <section class="explorar">
      <h2>O que você encontrará aqui</h2>
      <div class="cards">
        <div class="card">
          <i class="fas fa-book-open"></i>
          <h3>História</h3>
          <p>Conheça a história dos portos, energia solar e muito mais.</p>
        </div>
        <div class="card">
          <i class="fas fa-industry"></i>
          <h3>Infraestrutura</h3>
          <p>Descubra como os portos operam, sua organização e integração.</p>
        </div>
        <div class="card">
          <i class="fas fa-bolt"></i>
          <h3>Tipo de Energia</h3>
          <p>Saiba mais sobre os diversos tipos de energia que o Brasil utiliza.</p>
        </div>
      </div>
    </section>
  </main>


  <footer>
    <div class="coluna">
      <h4>Menu</h4>
      <ul>
        <li><a href="#">Principal</a></li>
        <li><a href="historia.php">História</a></li>
        <li><a href="#">Infraestrutura</a></li>
        <li><a href="#">Tipo de Energia</a></li>
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
</body>
</html>

