<?php
include("connect.php");

// Verifica se o ID do produto foi passado
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Busca os detalhes do produto
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    // Verifica se o produto existe
    if($row = mysqli_fetch_assoc($result)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <form action="update_product.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <div>
            <label for="product_name">Nome do Produto:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $row['product_name']; ?>">
        </div>
        <div>
            <label for="product_price">Preço:</label>
            <input type="number" id="product_price" name="product_price" value="<?php echo $row['product_price']; ?>">
        </div>
        <div>
            <label for="product_desc">Descrição:</label>
            <textarea id="product_desc" name="product_desc"><?php echo $row['product_desc']; ?></textarea>
        </div>
        <button type="submit">Atualizar Produto</button>
    </form>
</body>
</html>

<?php
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "ID do produto inválido.";
}
?>
