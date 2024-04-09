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
    <title>Categorias e Marcas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style/normalize.css" />
    <link rel="stylesheet" href="style/cat-brand.css" />
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
        <li><a href="index.php">Inicios</a></li>
        <li><a href="products.php">Produtos</a></li>
        <li><a href="../cat-brand.php">Categorias e Marcas</a></li>
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
    
    
    <div class="categories">
      <h1>CATEGORIAS</h1>
      <div class="container">
        <div class="cat-brand">
          
        <a href="prod_cat/accessories.php">
            <img src="imgs/accessories-cat.png" alt="" /><span>Accessórios</span></a
          >
          <a href="prod_cat/games.php">
            <img src="imgs/games-cat.png" alt="" /> <span>Jogos</span></a
          >
          <a href="prod_cat/computer-hardware.php">
            <img src="imgs/bundles-cat.png" alt="" /> <span>Hardware</span></a
          >
        </div>
      </div>
    </div>
    
    <div id="breaker"></div>
    
    <div class="brands">
      <h1>MARCAS</h1>
      <div class="container">
        <div class="cat-brand">
          
        <a href="prod_brand/microsoft.php">
            <img src="imgs/microsoft.png" alt="" /> <span>Microsoft</span></a
          >
          <a href="prod_brand/sony.php">
            <img src="imgs/sony.png" alt="" />
            <span>Sony</span></a
          >
         
          <a href="prod_brand/asus.php">
            <img src="imgs/asus.png" alt="" />
            <span>Asus</span></a
          >

        </div>
      </div>
    </div>

    

    <script src="js/products.js"></script>
  </body>
</html>
