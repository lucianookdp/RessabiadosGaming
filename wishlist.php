<?php
session_start();
include("connect.php");

class WishlistDisplayManager
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function displayWishlistItems($userId)
  {
    $output = '';
    $query = "SELECT wishlist.product_id, products.product_image, products.product_name, products.product_desc, products.product_price 
              FROM wishlist 
              JOIN products ON wishlist.product_id = products.product_id 
              WHERE wishlist.user_id = ?";

    if ($stmt = $this->db->prepare($query)) {
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $output .= '<div class="card" id="' . $row['product_id'] . '">
                        <div class="up-img">
                          <img src="' . $row['product_image'] . '" alt="" />
                        </div>
                        <div class="content-text">
                          <h2>' . $row['product_name'] . '</h2>
                          <p class="desc">' . $row['product_desc'] . '</p>
                          <h2 class="price">' . $row['product_price'] . 'R$</h2>
                          <div id="prod-links">
                            <a href="addtocart.php?prod_id=' . $row['product_id'] . '">Adicionar ao Carrinho</a>
                            <a href="removewishlist.php?prod_id=' . $row['product_id'] . '">Remover</a>
                          </div>
                        </div>
                      </div>';
        }
      } else {
        $output = "<h1>Sua lista de desejos está vazia.</h1>";
      }
      $stmt->close();
    }
    return $output;
  }
}

$wishlistHTML = "";
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $wishlistManager = new WishlistDisplayManager($conn);
  $wishlistHTML = $wishlistManager->displayWishlistItems($user_id);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wishlist</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="style/normalize.css" />
  <link rel="stylesheet" href="style/wishlist.css" />
</head>

<body>
  <nav>
    <?php
    if (isset($_SESSION['f_name'])) {
      echo '<div><p>Bem-vindo, ' . ucfirst($_SESSION['f_name']) . ' ' . ucfirst($_SESSION['l_name']) . '</p></div>';
    } else echo '<div><p>Bem-vindo ao RessabiadosGaming</p></div>';
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
        echo '<li><a href="purchase-history.php">Histórico de Compras</a></li>';
      }
      ?>
      <li>
        <div class="accs">
          <div id="acc-click">Conta</div>
          <ul id="acc-lists">
            <li><a href="login.php">Entrar</a></li>
            <li><a href="register.php">Registrar</a></li>
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
  <h1>Lista de Desejos</h1>
  <div class="container">
    <div class="prod-cards">
      <?php
      $user_id = $_SESSION['user_id'];
      $query1 = "SELECT * FROM wishlist WHERE user_id = '$user_id'";
      $output = '';

      $result1 = mysqli_query($conn, $query1);
      if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
          $prod_id = $row1['product_id'];
          $query2 = "SELECT * FROM products WHERE product_id = '$prod_id'";
          $result2 = mysqli_query($conn, $query2);
          $row2 = mysqli_fetch_assoc($result2);
          $output = $output . '<div class="card" id=' . $row2['product_id'] . '>
                                        <div class="up-img">
                                          <img src="' . $row2['product_image'] . '" alt="" />
                                        </div>
                                        <div class="content-text">
                                          <h2>' . $row2['product_name'] . '</h2>
                                          <p class="desc">' . $row2['product_desc'] . '</p>
                                          <h2 class="price">' . $row2['product_price'] . '$</h2>
                                          <div id="prod-links">
                                          <a href="addtocart.php?prod_id=' . $row2['product_id'] . '">Adicionar ao Carrinho</a>
                                          <a href="removewishlist.php?prod_id=' . $row2['product_id'] . '">Remover da Lista</a>
                                          </div>
                                        </div>
                                      </div>';
        }
      } else $output = "<h1>Sua Lista de Desejos Está Vazia.</h1>";
      echo $output;
      ?>
    </div>
  </div>
  <script src="js/wishlist.js"></script>
</body>

</html>