<?php
include("connect.php");
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style/normalize.css" />
    <link rel="stylesheet" href="style/crud.css" />
</head>

<body>
    <nav>
        <div class="logo">
            <p>RessabiadosGaming</p>
        </div>
        <ul class="links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
    </nav>

    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="product-item">
                <p><?php echo "{$row['product_name']} - {$row['product_price']} R$"; ?></p>
                <br>
                <a href="edit_product.php?id=<?php echo $row['product_id']; ?>">Editar</a> |
                <a href="delete_product.php?id=<?php echo $row['product_id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>