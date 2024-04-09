<?php
session_start();
include("connect.php");

class CartManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCartItems($userId)
    {
        $output = '';
        $total = 0; // Inicializar o total
        $query = "SELECT products.product_image, products.product_name, products.product_price, cart.product_id 
                  FROM cart 
                  JOIN products ON cart.product_id = products.product_id 
                  WHERE cart.user_id = ?";
        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $output .= '<div class="item">
                                    <img src="' . $row['product_image'] . '" alt="" />
                                    <p>' . $row['product_name'] . '</p>
                                    <p>Preço: ' . $row['product_price'] . '</p>
                                </div>';
                    $total += $row['product_price']; // Somar ao total
                }
                // Após o loop, adicionar o total ao output
                $output .= '<p>Total: R$ ' . $total . '</p>';
            } else {
                $output = '<p>Seu carrinho está vazio.</p>';
            }
            $stmt->close();
        }
        return $output;
    }
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $cartManager = new CartManager($conn);
    $output = $cartManager->getCartItems($user_id);
    echo $output;
} else {
    echo "Faça o login para ver seu carrinho.";
}
