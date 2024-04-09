<?php
include("connect.php");

class UserManager
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function registerUser($fname, $lname, $phonenumber, $address, $email, $password)
  {
    if ($this->userExists($email)) {
      return false; // Retorna falso se o usuário já existe
    } else {
      // Insere o novo usuário no banco de dados
      $query = "INSERT INTO user_info (first_name, last_name, mobile, addr, email, pass) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param("ssssss", $fname, $lname, $phonenumber, $address, $email, $password);
      $stmt->execute();
      return true; // Retorna verdadeiro se o usuário foi inserido com sucesso
    }
  }

  private function userExists($email)
  {
    // Verifica se já existe um usuário com o email fornecido
    $query = "SELECT * FROM user_info WHERE email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
  }
}

$userManager = new UserManager($conn);
$userExists = false; // Inicializa a variável como falsa

if (isset($_POST['register'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phonenumber = $_POST['phonenumber'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!$userManager->registerUser($fname, $lname, $phonenumber, $address, $email, $password)) {
    $userExists = true; // Define a variável como verdadeira se o usuário já existir
  } else {
    header("Location: successful.html"); // Redireciona se o usuário for registrado com sucesso
    exit;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RessabiadosGaming - Cadastro</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="style/normalize.css" />
  <link rel="stylesheet" href="style/register.css" />
</head>

<body>
  <div class="login-page">
    <div class="left-side">
      <a href="index.php"><img src="imgs/header.png" alt="" /></a>
    </div>
    <p class="wrong" id="datawrong">
      <?php
      if ($userExists) { // Verifica se a variável é verdadeira
        echo 'User already exists!';
        echo '<script>
            setTimeout(() => {
                document.getElementById("datawrong").innerHTML = "";
            }, 3000);
        </script>';
      }
      ?>
    </p>

    <div class="login-form">
      <form action="register.php" method="post">
        <input class="input" type="text" id="fname" name="fname" placeholder="Nome" />
        <p class="wrong" id="wrongFname"></p>
        <input class="input" type="text" id="sname" name="lname" placeholder="Sobrenome" />
        <p class="wrong" id="wrongSname"></p>
        <input class="input" type="text" id="phone-number" name="phonenumber" placeholder="Número" />
        <p class="wrong" id="wrongPhone"></p>
        <input class="input" type="text" id="address" name="address" placeholder="Endereço" />
        <p class="wrong" id="wrongAddress"></p>
        <input class="input" type="text" id="email" name="email" placeholder="E-mail" />
        <p class="wrong" id="wrongEmail"></p>
        <input class="input" type="password" id="password" name="password" placeholder="Senha" />
        <p class="wrong" id="wrongPass"></p>
        <input class="input" type="password" id="conf-password" placeholder="Confirme sua Senha" />
        <p class="wrong" id="wrongPassConf"></p>
        <p class="wrong" id="datawrong">

        </p>
        <input type="submit" name="register" id="" value="Cadastrar" />
        <span class="sign-ups"><a href="login.php">
            <p>Você já tem um conta?</p>
            <p>Entre aqui.</p>
          </a></span>
      </form>
    </div>
  </div>
  <script src="js/register.js"></script>
</body>

</html>