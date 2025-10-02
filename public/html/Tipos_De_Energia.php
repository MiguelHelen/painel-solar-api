<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Porto Solar - Tipos de Energia</title>
  <link rel="stylesheet" href="../css/TiposEnergia.css" />
   <link rel="icon" href="../imagens/PortSol-removebg-preview (1) (1).png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <header>
    <div class="logo">
  
      <img src="../imagens/PortSol-removebg-preview (1) (1).png" alt="Logo Porto Solar" />
    </div>
    <div class="titulo">
      <h1>Tipos de Energia</h1>
      <br>
      <p>Saiba mais sobre o rumo que o Brasil está <br> tomando com a geração elétrica. </p>
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
     <h2>A Geração de Energia no Brasil</h2>
    </section>
  
    <div class="text-1">
    <p>O Brasil possui uma grande matriz diversificada de energias. A medida que o país foi se mordenizando, 
      esses setores começaram a ganhar desenvolvimento. </p>
    </div>
    
    <br/> 
    <br/>

     <div class="container-1">
      <h2>As fontes principais utilizadas no Brasil são: </h2>
      <div class="estrutura">
      <img src="../imagens/IconHidreletrica.png" alt="ícone de Hidrelétrica" />
      <p>A energia hidrelétrica é considerada a principal no Brasil, principalmente devido à abundância de rios, 
       um recurso natural que possibilitou o surgimento de várias usinas hidrelétricas no país.</p>
      </div>

      <div class="estrutura">
      <img src="../imagens/IconPetroleo.png" alt="ícone de Petróleo" />
      <p>Os combustíveis fósseis ainda têm grande destaque no Brasil, especialmente o petróleo. Apesar de não serem renováveis, 
      são usados por sua alta capacidade energética, tanto no transporte como na indústria.</p>
      </div>

      <div class="estrutura">
      <img src="../imagens/iconBiomassa.png" alt="ícone de Biomassa" />
      <p>A biomassa é uma fonte de energia renovável usada no Brasil, vinda de materiais orgânicos como cana-de-açúcar, madeira 
      ou outros resíduos naturais. É usada para fazer biocombustíveis, como o etanol.</p>
      </div>

      <div class="estrutura">
      <img src="../imagens/Icon_EnergiaEolica.png" alt="ícone de Energia Eólica" />
      <p>A energia eólica é gerada a partir da força dos ventos. No Brasil, tem crescido bastante nos últimos anos, principalmente 
      em regiões como o Nordeste, onde os ventos são fortes e constantes.</p>
      </div>
     </div>

     <br/>
     <br/>

      <section class="faixa-infra2">
        <h2>Claro que existem outros tipos além dessas, que vêm ganhando reconhecimento ao longo dos anos, tanto no Brasil quanto 
        no mundo:</h2>
      </section>
     <div class="container-2"> 
      

        <div class="coluna-esquerda">
        <p>Renováveis</p>

        <section class="quad">
        <h3>Solar</h3>
        <p>A energia é captada por painéis solares e vem crescendo por ser limpa e abundante.</p>
        </section>

        <section class="quad">
        <h3>Hidrogênio Verde</h3>
        <p> A energia é produzido através de fontes de energia renovável, como solar e eólica, utilizando a eletrólise da água.</p>
        </section>

        <section class="quad">
        <h3>Maremotriz</h3>
        <p>A energia vem das forças das ondas e marés. É valorizada por ser sustentável e previsível.</p>
        </section>
        </div>
       
        <div class="linha-separadora"></div>

        <div class="coluna-esquerda">
         <p>Não Renováveis</p>
       

         <section class="quad">
        <h3>Energia Nuclear</h3>
        <p> A energia nuclear vem da fissão de átomos, gerando muita eletricidade, mas precisa de cuidado com resíduos.</p>
        </section>

        <section class="quad">
        <h3>Carvão Mineral</h3>
        <p> O carvão mineral é um combustível fóssil que gera energia. É abudante, mas polui e agrava o efeito estufa.</p>
        </section>

        <section class="quad">
        <h3>Gás Natural</h3>
        <p>O gás natural é usado para gerar energia, com menos poluição que o carvão, mas ainda contribui para o efeito estufa.</p>
        </section>
        </div>
     </div>

     <br/>
     <br/>

      <section class="infra">
        <br>
      <div class="container-3">
      <h2>Impactos Ambientais</h2>

      <div class="linha-conteudo">
      <div class="linha-emparelhada"></div>

      <div class="conteudo">
        <p>
          Todas essas fontes de energia, de alguma forma, causam algum tipo de impacto ao meio ambiente.
          Alguns métodos podem afetar ecossistemas locais, enquanto outros podem influenciar climas inteiros.
          Por isso, é fundamental buscar um equilíbrio entre a geração de energia e a preservação ambiental,
          minimizando danos e promovendo práticas mais responsáveis.
        </p>

        <figure class="img-box">
          <img src="../imagens/Impacto-Hidrelétrica.png" alt="Alagamento por Hidrelétrica" />
          <figcaption>Alagamentos provocados pela implantação de usinas hidrelétricas em Rondônia.</figcaption>
        </figure>

        <figure class="img-box">
          <img src="../imagens/Impacto_Solar.jpg" alt="Descarte inadequado de Paíneis" />
          <figcaption>Descarte inadequado de painéis solares após o tempo de vida útil.</figcaption>
        </figure>
        </div>
        </div>
        </div>

        <br/>
       <br/>
        </section>

        <br>
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
