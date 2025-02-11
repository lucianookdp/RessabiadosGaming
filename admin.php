<?php
include("connect.php");
if(isset($_POST['prod-add'])){
  $prod_category = $_POST['prod-category'];
  $prod_brand = $_POST['prod-brand'];
  $prod_name = $_POST['prod-name'];
  $prod_price = $_POST['prod-price'];
  $prod_desc = $_POST['prod-desc'];
  $prod_img = 'prod-imgs/'.$_POST['prod-img'].'.png';
  
  $query = "INSERT INTO products (product_cat, product_brand, product_name, product_price, product_desc, product_image)
                    VALUES ('$prod_category', '$prod_brand', '$prod_name', '$prod_price', '$prod_desc', '$prod_img');";
  mysqli_query($conn, $query);
  echo '
  <script>
    alert("Sucesso, Produto Adicionado!!!!");
  </script>
  ';
}
if(isset($_POST['cust-add'])){
  $fname = $_POST['cust-fname'];
  $lname = $_POST['cust-lname'];
  $phonenumber = $_POST['cust-phone'];
  $address = $_POST['cust-address'];
  $email = $_POST['cust-email'];
  $password = $_POST['cust-password'];
  
  $query = "INSERT INTO user_info (first_name, last_name, mobile, addr, email, pass) VALUES ('$fname', '$lname', '$phonenumber', '$address', '$email', '$password');";
  mysqli_query($conn, $query);
  echo '
  <script>
    alert("Customer added successfully!!!!");
  </script>
  ';
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style/normalize.css" />
    <link rel="stylesheet" href="style/admin.css" />
  </head>
  <body>
    <nav>
      <div class="logo"><p>RessabiadosGaming</p></div>
      <ul class="links">
        <li><a href="index.php">Inicio</a></li>
    </nav>
    <h1>ADMIN</h1>
    <div class="select-admin">
      <button class="selected btn-select-admin">Produtos</button>
      <button class="btn-select-admin">Cliente</button>
      <button class="btn-select-admin" onclick="window.location.href='crud.php';">CRUD</button>
    </div>
    <div class="admin-products">
      <form id="Products" action="admin.php" method="post">
        <div class="prod-name">
          <label for="prod-name">Entre Com o Nome do Produto:</label>
          <input id="prod-name" type="text" name="prod-name"/>
        </div>
        <p class="wrong" id="wrongName"></p>
        <div class="prod-desc">
          <label for="prod-desc">Entre com a Descrição do Produto</label>
          <textarea name="prod-desc" id="prod-desc" cols="30" rows="10"></textarea>
        </div>
        <p class="wrong" id="wrongDesc"></p>
        <div class="prod-img">
          <label for="prod-img">Entre com a Imagem do Produto:</label>
          <input type="text" name="prod-img" id="prod-img" />
        </div>
        <div class="prod-price">
          <label for="prod-price">Entre com o Preço do Produto:</label>
          <input id="prod-price" type="number" name="prod-price"/>
        </div>
        <p class="wrong" id="wrongPrice"></p>
        
        <div class="prod-category">
          <label for="prod-category">Selecione a Categoria:</label>
          <select name="prod-category" id="prod-category">
            <option value="1">Console</option>
            <option value="2">Laptops</option>
            <option value="3">Games</option>
            <option value="4">Hardware</option>
            <option value="5">Accessórios</option>
          </select>
        </div>
        <div class="prod-brand">
          <label for="prod-brand">Selecione a Marca:</label>
          <select name="prod-brand" id="prod-brand">
            <option value="1">Sony</option>
            <option value="2">Microsoft</option>
            <option value="3">MSI</option>
            <option value="4">Asus</option>
            <option value="5">Lenovo</option>
          </select>
        </div>
        <div>
          <input type="submit" name="prod-add" id="" value="Add product" />
        </div>
      </form>
      <!-- -------------------------------------------------------------------------------------------------- -->
      <form id="Customer" action="admin.php" method="post">
        <div class="cust-fname">
          <label for="cust-fname">Nome do Cliente:</label>
          <input id="cust-fname" type="text" name="cust-fname"/>
        </div>
        <p class="wrong" id="wrongFname"></p>
        <div class="cust-lname">
          <label for="cust-lname">Sobrenome do Cliente:</label>
          <input id="cust-lname" type="text" name="cust-lname"/>
        </div>
        <p class="wrong" id="wrongLname"></p>
        <div class="cust-phone">
          <label for="cust-phone">Número de Telefone:</label>
          <input id="cust-phone" type="tel" name="cust-phone"/>
        </div>
        <p class="wrong" id="wrongPhone"></p>
        <div class="cust-email">
          <label for="cust-email">E-mail:</label>
          <input id="cust-email" type="text" name="cust-email"/>
        </div>
        <p class="wrong" id="wrongEmail"></p>
        <div class="cust-address">
          <label for="cust-address">Endereço:</label>
          <input id="cust-address" type="text" name="cust-address"/>
        </div>
        <p class="wrong" id="wrongAddress"></p>
        <div class="cust-password">
          <label for="cust-password">Senha:</label>
          <input id="cust-password" type="text" name="cust-password" />
        </div>
        <p class="wrong" id="wrongPass"></p>
        <div>
          <input type="submit" id="" value="Add cliente" name="cust-add"/>
        </div>
      </form>
    </div>
    <script src="js/admin.js"></script>
  </body>
</html>
