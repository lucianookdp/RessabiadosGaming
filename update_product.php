<?php
include("connect.php");

if(isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['product_desc'])) {
    // Sanitização e validação dos dados aqui
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];

    // Atualiza o produto no banco de dados
    $query = "UPDATE products SET product_name = '$product_name', product_price = $product_price, product_desc = '$product_desc' WHERE product_id = $product_id";
    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Produto atualizado com sucesso!'); window.location = 'crud.php';</script>";
    } else {
        echo "Erro ao atualizar o produto.";
    }
} else {
    echo "Todos os campos são obrigatórios.";
}
?>
