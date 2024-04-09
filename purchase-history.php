<?php
include("connect.php");

class PurchaseHistoryManager
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function getPurchaseHistory($userId)
  {
    $query = "SELECT products.product_image, products.product_name, products.product_price 
                  FROM order_list 
                  JOIN products ON order_list.product_id = products.product_id 
                  WHERE order_list.user_id = ?";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $output = '';
      while ($row = $result->fetch_assoc()) {
        $output .= '<div class="item">
                                <div class="purchase">
                                    <img src="' . $row['product_image'] . '" alt="" />
                                    <p>' . $row['product_name'] . '</p>
                                    <p>Preço: R$ ' . $row['product_price'] . '</p>
                                </div><br>';
      }
      return $output;
    } else {
      return '<h1>Nada Comprado Ainda</h1>';
    }
  }
}

$purchaseHistoryManager = new PurchaseHistoryManager($conn);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>History</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="style/normalize.css" />
  <link rel="stylesheet" href="style/purchase-history.css" />
</head>

<body>
  <nav>
    <?php
    if (isset($_SESSION['f_name'])) {
      echo '<div><p>Welcome, ' . ucfirst($_SESSION['f_name']) . ' ' . ucfirst($_SESSION['l_name']) . '</p></div>';
    } else echo '<div><p>Welcome to GameTopia</p></div>';
    ?>
    <div class="logo-user">
      <p></p>
    </div>
    <ul class="links">
      <li><a href="index.php">Inicio</a></li>
      <li><a href="products.php">Produtos</a></li>
      <li><a href="cat-brand.php">Categorias e Marcas</a></li>
      <?php
      if (isset($_SESSION['f_name'])) {
        echo '<li><a href="purchase-history.php">Histórico de Compra</a></li>';
      }
      ?>
      <li>
        <div class="accs">
          <div id="acc-click">Conta</div>
          <ul id="acc-lists">
            <li><a href="login.php">Entrar</a></li>
            <li><a href="register.php">Registro</a></li>
            <?php
            if (isset($_SESSION['f_name'])) {
              echo '<li><a href="logout.php">Sair</a></li>';
            }
            ?>
          </ul>
        </div>
      </li>
      <?php
      if (isset($_SESSION['f_name'])) {
        echo '<li><a href="wishlist.php">Lista de Desejos</a></li>';
      }
      ?>
      <li><a href="about.php">Sobre</a></li>
    </ul>
  </nav>

  <h1>HISTÓRICO DE COMPRAS</h1>
  <div class="container">
    <div class="history">
      <?php
      if (isset($_SESSION['user_id'])) {
        echo $purchaseHistoryManager->getPurchaseHistory($_SESSION['user_id']);
      } else {
        echo "<h1>Por Favor, Entre Para Ver Seu Histórico de Compras.</h1>";
      }
      ?>
    </div>
  </div>

  <script src="js/purchase-history.js"></script>
</body>

</html>