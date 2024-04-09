<?php
include("connect.php");

class ProductManager
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function fetchProducts($category = null, $brand = null)
  {
    if ($category && $brand && $category != "0" && $brand != "0") {
      $query = "SELECT * FROM products WHERE product_cat = ? AND product_brand = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param("ii", $category, $brand);
    } else {
      $query = "SELECT * FROM products";
      $stmt = $this->db->prepare($query);
    }

    $stmt->execute();
    return $stmt->get_result();
  }
}

$productManager = new ProductManager($conn);
session_start();

$results = $productManager->fetchProducts();

if (isset($_POST['search'])) {
  $category = $_POST['category'];
  $brand = $_POST['brand'];
  $results = $productManager->fetchProducts($category, $brand);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Produtos</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="style/normalize.css" />
  <link rel="stylesheet" href="style/products.css" />
</head>

<body>
  <nav>
    <?php
    if (isset($_SESSION['f_name'])) {
      echo '<div><p>Bem Vindo, ' . ucfirst($_SESSION['f_name']) . ' ' . ucfirst($_SESSION['l_name']) . '</p></div>';
    } else echo '<div><p>Bem Vindo ao RessabiadosGaming</p></div>';
    ?>
    <div class="logo-user">
      <p></p>
    </div>
    <ul class="links">
      <li><a href="index.php">inicio</a></li>
      <li><a href="products.php">Produtos</a></li>
      <li><a href="cat-brand.php">Categorias e Produtos</a></li>
      <?php
      if (isset($_SESSION['f_name'])) {
        echo '<li><a href="purchase-history.php">Histórico de Compras</a></li>';
      }
      ?>
      <li>
        <div class="accs">
          <div id="acc-click">Conta</div>
          <ul id="acc-lists">
            <li><a href="login.php">Login</a></li>
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
  <h1>Produtos</h1>
  <form action="products.php" method="post">
    <h3>Selecionar por:</h3>
    <div>
      <label for="category">Categoria</label>
      <select name="category" id="category">
        <option value="0">---</option>
        <option value="1">Console</option>
        <option value="2">Laptops</option>
        <option value="3">Games</option>
        <option value="4">Computer Hardware</option>
        <option value="5">Accessories</option>
      </select>
      <label for="brand">Marca</label>
      <select name="brand" id="brand">
        <option value="0">---</option>
        <option value="1">Sony</option>
        <option value="2">Microsoft</option>
        <option value="3">MSI</option>
        <option value="4">Asus</option>
        <option value="5">Lenovo</option>
      </select>
    </div>
    <input type="submit" value="Buscar" name="search" />
  </form>
  <div class="container">
    <div class="prod-cards">
      <?php
      if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
          echo '
                <div class="card" id=' . $row['product_id'] . '>
                    <div class="up-img">
                        <img src="' . $row['product_image'] . '" alt="" />
                    </div>
                    <div class="content-text">
                        <h2>' . $row['product_name'] . '</h2>
                        <p class="desc">' . $row['product_desc'] . '</p>
                        <h2 class="price">' . $row['product_price'] . ' R$</h2>';
          if (isset($_SESSION['f_name'])) {
            echo '<div id="prod-links">
                            <a href="addtocart.php?prod_id=' . $row['product_id'] . '">Adicionar ao Carrinho</a>
                            <a href="addtowishlist.php?prod_id=' . $row['product_id'] . '">Adicionar a lista de Desejos</a>
                            </div>';
          }
          echo '</div></div>';
        }
      } else {
        echo "<h1>Nenhum produto encontrado</h1>";
      }
      ?>
    </div>
  </div>
  <?php
  if (isset($_SESSION['f_name'])) {
    echo '<div class="cart-logo"></div>
      <div>
      <div class="cart">
        <h2>CARRINHO</h2>
        <div id="items">
        </div>
        <a id="buy-in-cart" href="removecart.php">Comprar</a>
      </div>';
  }
  ?>
  <script src="js/products.js"></script>
</body>

</html>