<?php
session_start();
include("connect.php");

class WishlistManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function removeFromWishlist($userId, $productId) {
        $query = "DELETE FROM `wishlist` WHERE user_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
    }
}

if (isset($_GET['prod_id']) && isset($_SESSION['user_id'])) {
    $prod_id = $_GET['prod_id'];
    $user_id = $_SESSION['user_id'];

    $wishlistManager = new WishlistManager($conn);
    $wishlistManager->removeFromWishlist($user_id, $prod_id);

    header("Location: wishlist.php");
} else {
    // Handle error, e.g., if user is not logged in or prod_id is not provided
    echo "Error: Operation not allowed.";
    // Optional: redirect to an error page or login page
    // header("Location: login.php");
    // exit;
}
?>
