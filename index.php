<?php
include("connect.php");

class SessionManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isUserLoggedIn() {
        return isset($_SESSION['f_name']);
    }

    public function getUserGreeting() {
        if ($this->isUserLoggedIn()) {
            return 'Bem Vindo, ' . ucfirst($_SESSION['f_name']) . ' ' . ucfirst($_SESSION['l_name']);
        } else {
            return 'Bem Vindo ao RessabiadosGaming';
        }
    }
}

$sessionManager = new SessionManager();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ressabiados</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style/normalize.css" />
    <link rel="stylesheet" href="style/home.css" />
</head>
<body>
<nav>
    <div><?php echo '<p>' . $sessionManager->getUserGreeting() . '</p>'; ?></div>
    <div class="logo-user"><p></p></div>
    <ul class="links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="products.php">Produtos</a></li>
        <li><a href="cat-brand.php">Categorias & Marcas</a></li>
        <?php if ($sessionManager->isUserLoggedIn()): ?>
            <li><a href="purchase-history.php">Histórico de Compras</a></li>
            <li><a href="wishlist.php">Lista de Desejos</a></li>
        <?php endif; ?>
        <li>
            <div class="accs">
                <div id="acc-click">Conta</div>
                <ul id="acc-lists">
                    <?php if ($sessionManager->isUserLoggedIn()): ?>
                        <li><a href="logout.php">Sair</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Registrar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>
        <li><a href="about.php">Sobre</a></li>
      </ul>
    </nav>
    <div class="landing">
      <div class="heading">
        <img src="imgs/header.png" alt="" />
        <h3>ALÉM DA SUA EXPERIÊNCIA DE JOGO</h3>
      </div>
    </div>
    <div class="intro">
      <div class="container">
        <h1>
          <span></span>&nbsp; <img src="imgs/header3.png" alt="" />
        </h1>
        <p class="intro-text">
          Somos uma loja de games, onde vendemos produtos, jogos e
          Acessórios. Cada cliente pode comprar quantos produtos quiser e
          adiciona-lo ao seu carrinho. Há uma grande variedade de itens, temos consoles, acessórios, jogos, peças de computador e muitos
          mais. Nosso foco principal é dar ao cliente gamer a oportunidade de
          comprar tudo o que ele precisa em sua configuração de jogo. Brilhe suas habilidades de jogo
          com estilo!
        </p>
      </div>
    </div>
    
    
    </div>
    <div class="products">
      <div class="container">
        <h3><a href="products.php">Ver todos os nossos produtos</a></h3>
        <div class="prod-cards">
          <div class="card">
            <div class="up-img">
              <img src="imgs/ps4.png" alt="" />
            </div>
            <div class="content-text">
              <h2>PS4</h2>
              <p class="desc">
              O DualSense também adiciona um conjunto de microfones integrado, que irá
                permitir que os jogadores facilmente
              </p>
              <h2 class="price">2200,00 R$</h2>
              <a href="products.php">Ver produto</a>
            </div>
          </div>
          
          <div class="card">
            <div class="up-img">
              <img class="below-pos" src="imgs/ps4-controller.png" alt="" />
            </div>
            <div class="content-text">
              <h2>Controle PS4</h2>
              <p class="desc">
              O DualSense também adiciona um conjunto de microfones integrado, que irá
                permitir que os jogadores facilmente
              </p>
              <h2 class="price">200,00 R$</h2>
              <a href="products.php">Ver Produto</a>
            </div>
          </div>
          
          <div class="card">
            <div class="up-img">
              <img src="imgs/ps5.png" alt="" />
            </div>
            <div class="content-text">
              <h2>PS5</h2>
              <p class="desc">
              O DualSense também adiciona um conjunto de microfones integrado, que irá
                permitir que os jogadores facilmente
              </p>
              <h2 class="price">4500,00 R$</h2>
              <a href="products.php">Ver produto</a>
            </div>
          </div>
          
          <div class="card">
            <div class="up-img">
              <img class="below-pos" src="imgs/ps5-controller.png" alt="" />
            </div>
            <div class="content-text">
              <h2>PS4</h2>
              <p class="desc">
              O DualSense também adiciona um conjunto de microfones integrado, que irá
                permitir que os jogadores facilmente
              </p>
              <h2 class="price">400,00 R$</h2>
              <a href="products.php">Ver Produto</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <footer>
      <img src="imgs/header2.png" alt="" />
      <div class="contacts">
      <li>Contato</li>
      </div>
    </footer>
    
    <script src="js/index.js"></script>
  </body>
</html>

