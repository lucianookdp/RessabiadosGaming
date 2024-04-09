<?php
include("../connect.php");

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