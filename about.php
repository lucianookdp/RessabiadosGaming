<?php
include("connect.php");
session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sobre</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style/normalize.css" />
    <link rel="stylesheet" href="style/about.css" />
  </head>
  <body>
  <nav>
      <?php
      if(isset($_SESSION['f_name'])){
        echo '<div><p>Bem-vindo, '.ucfirst($_SESSION['f_name']).' '.ucfirst($_SESSION['l_name']).'</p></div>';
      }else echo '<div><p>Bem-vindo ao RessabiadosGaming</p></div>';
      ?>
      <div class="logo-user"><p></p></div>
      <ul class="links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="products.php">Produtos</a></li>
        <li><a href="cat-brand.php">Categorias e Marcas</a></li>
        <?php
        if(isset($_SESSION['f_name'])){
        echo'<li><a href="purchase-history.php">Histórico de Compra</a></li>';
        }
        ?>
        <li>
          <div class="accs">
            <div id="acc-click">Conta</div>
            <ul id="acc-lists">
              <li><a href="login.php">Entrar</a></li>
              <li><a href="register.php">Registro</a></li>
              <?php
              if(isset($_SESSION['f_name'])){
                echo'<li><a href="logout.php">Sair</a></li>';
              }
              ?>
            </ul>
          </div>
        </li>
        <?php
        if(isset($_SESSION['f_name'])){
        echo'<li><a href="wishlist.php">Lista de Desejos</a></li>';
        }
        ?>
        <li><a href="about.php">Sobre</a></li>
      </ul>
    </nav>
    <div class="devs-us">
      <div class="container">
        <h1>Sobre Nós</h1>
        <div class="testimonials">
          <div class="box">
            <img src="imgs/avatar-01.jpeg" alt="" />
            <h3>Luciano K. Dal Pai</h3>
            <span class="title">DEV Ressabiado</span>
            <div class="contact-me">
              <a href="">Contato</a>
              <a href="mailto: engs-lucianopai@camporeal.edu.br">Email</a>
            </div>
            <p>
              ESTUDANTE <br />
              Engenharia De Software <br />
            </p>         
        </div>
        <div class="box">
            <img src="imgs/avatar-02.jpeg" alt="" />
            <h3>Henrique Padilha Duda</h3>
            <span class="title">DEV Ressabiado</span>
            <div class="contact-me">
              <a href="">Contato</a>
              <a href="mailto: engs-henriqueduda@camporeal.edu.br">Email</a>
            </div>
            <p>
              ESTUDANTE <br />
              Engenharia De Software <br />
            </p>         
        </div>
        <div class="box">
            <img src="imgs/avatar-03.jpeg" alt="" />
            <h3>Jhonnatan C. Matheus</h3>
            <span class="title">DEV Ressabiado</span>
            <div class="contact-me">
              <a href="">Contato</a>
              <a href="mailto: engs-jhonnatancora@camporeal.edu.br">Email</a>
            </div>
            <p>
              ESTUDANTE <br />
              Engenharia De Software <br />
            </p>         
        </div>
      </div>
    </div>
    
    <div class="contact-us">
      <div class="container">
        <h1>Contato</h1>
        <div class="contacts">
          <div class="card">
            <img src="imgs/address-logo.png" alt="" />
            <h4>Endereço</h4>
            <p>R. Comendador Norberto, 1299</p>
          </div>
          <div class="card">
            <img src="imgs/phone-logo.png" alt="" />
            <h4>Telefone</h4>
            <p>42 3621-5200</p>
          </div>
          <div class="card">
            <img src="imgs/mail-logo.png" alt="" />
            <h4>Email</h4>
            <p>camporeal@gmail.com</p>
          </div>
        </div>
      </div>
    </div>
    
    <footer>
      <img src="imgs/header3.png" alt="" />
      <div class="social-links">

      <a href="https://www.facebook.com/fcamporeal/?locale=pt_BR" target="_blank">
        <img src="imgs/Facebook.png" alt="" />
      </a>

      <img src="imgs/whats.png" alt="" />
        
      <a href="https://www.instagram.com/campo.real/" target="_blank">
        <img src="imgs/insta.png" alt="Campo Real Instagram" />
      </a>
        
      <a href="https://www.youtube.com/channel/UC_MH_DFnAacla1GJkbGg7Yw" target="_blank">
      <img src="imgs/youtube.png" alt="" />
      </a>

      </div>
    </footer>

    <script src="js/about.js"></script>
  </body>
</html>
