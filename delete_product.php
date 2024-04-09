<?php
include("connect.php");

// Verifica se o ID do produto foi passado e é válido
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepara a consulta SQL para deletar o produto
    $query = "DELETE FROM products WHERE product_id = $product_id";

    // Executa a consulta
    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Produto excluído com sucesso!'); window.location.href = 'crud.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o produto.'); window.location.href = 'crud.php';</script>";
    }
} else {
    echo "<script>alert('ID do produto inválido.'); window.location.href = 'crud.php';</script>";
}
?>
