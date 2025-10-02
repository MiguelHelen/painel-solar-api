<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Porto Solar - Infraestrutura</title>
  <link rel="stylesheet" href="../css/infraestrutura.css" />
   <link rel="icon" href="../imagens/PortSol-removebg-preview (1) (1).png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <header>
    <div class="logo">
  
      <img src="../imagens/PortSol-removebg-preview (1) (1).png" alt="Logo Porto Solar" />
    </div>
    <div class="titulo">
      <h1>Infraestrutura</h1>
      <br>
      <p>Saiba mais sobre a Infraestrutura do maior <br> Porto da América Latina </p>
       <div class="linha-titulo"></div>
    </div>
   
    <nav class="navbar">
      <ul>
        <li><a href="#">Principal</a></li>
        <li><a href="#">História</a></li>
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

    <section class="faixa-infra">
     <h2>Infraestrutura do Porto de Santos</h2>
    </section>
  
    <div class="text-1">
    <p>O Porto de Santos é reconhecido pela sua estrutura moderna e estratégica, sendo um dos principais pontos logísticos do Brasil. 
      A infraestrutura é constantemente ampliada para atender à crescente demanda nacional e internacional.</p>
    </div>
    
    <br/> 
     <br/>

    <div class="container">
    <div class="coluna-esquerda">
    
    <section class="quad">
        <h3>Armazéns Modernos</h3>
        <p>Espaços amplos e equipados para armazenagem de cargas gerais, grãos, contêineres e cargas especiais.</p>
    </section>
       
    <section class="quad">
        <h3>Conexão Ferroviária</h3>
        <p>Linhas férreas permitem integração multimodal, otimizando o escoamento de produtos.</p>
    </section>

    </div>

    <div class="linha-separadora"></div>

    <div class="coluna-direita">
        
     <section class="quad">
        <h3>Acessos Rodoviários</h3>
        <p>Interligado por rodovias como a Anchieta e Imigrantes, garantindo agilidade no transporte de cargas.</p>
     </section>

     <section class="quad">
        <h3>Segurança e Controle</h3>
        <p>Sistemas avançados de vigilância e controle para garantir a proteção das cargas e das operações.</p>
     </section>

   
    </div>
    </div>

     <br/> 
     <br/>
     

    <section class="infra">
      
    <br/>
    <h2>Infraestrutura em Imagens</h2>
    

    <br/> 
    <br/>

    <div class="container-2">
     <div class="img-box">
      <img src="../imagens/img-Infra01.png" alt="Barcos atracados" />
     </div>
      <div class="img-box">
        <img src="../imagens/img-Infra02.png" alt="Guindastes" />
      </div>
      <div class="img-box">
       <img src="../imagens/img-Infra03.png" alt="Barco" />
     </div>
    </div>

    <br/> 
    <br/>
    </section>

    <section class="faixa-infra2">
      <h2>Dados da Estrutura</h2>
    </section>
    <br/> 
    <br/>
    <br/>

    <div class="container-3">

      <div class="quad2">
        <h3>66</h3>
        <p>Berços de Atracação</p>
      </div>

      <div class="quad2">
        <h3>15 Km</h3>
        <p>Interligado por rodovias como a Anchieta e Imigrantes, garantindo agilidade no transporte de cargas.</p>
      </div>

      <div class="quad2">
        <h3>130M t</h3>
        <p>Capacidade de Carga/ano</p>
      </div>

      <div class="quad2">
        <h3>3.000 +</h3>
        <p>Navios por Ano</p>
      </div>

     
    </div>
    <br/> 
    <br/>
   

    <footer>
    <div class="coluna">
      <h4>Menu</h4>
      <ul>
        <li><a href="#">Principal</a></li>
        <li><a href="#">História</a></li>
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

</body>
</html>
