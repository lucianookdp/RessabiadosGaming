<?php
session_start();
include("connect.php");

class OrderManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function finalizeOrder($userId) {
        // Transfere itens do carrinho para a lista de pedidos
        $query1 = "INSERT INTO order_list (user_id, product_id) SELECT user_id, product_id FROM cart WHERE user_id = ?";
        $stmt1 = $this->db->prepare($query1);
        $stmt1->bind_param("i", $userId);
        $stmt1->execute();

        // Limpa o carrinho do usuário
        $query2 = "DELETE FROM cart WHERE user_id = ?";
        $stmt2 = $this->db->prepare($query2);
        $stmt2->bind_param("i", $userId);
        $stmt2->execute();
    }
}

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $orderManager = new OrderManager($conn);

    $orderManager->finalizeOrder($user_id);

    header("location: products.php");
} else {
    // Trata o caso em que o usuário não está logado ou a sessão expirou
    echo "Please log in to finalize your order.";
    // Redireciona para a página de login ou outra página apropriada
    // header("location: login.php");
    // exit;
}
?>
