<?php
// Inclui o arquivo de conexão com o banco de dados
include("connect.php");

// Define a classe Authenticator para gerenciar a autenticação do usuário
class Authenticator {
    private $db;

    // Construtor recebe a conexão do banco de dados
    public function __construct($db) {
        $this->db = $db;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Método para realizar o login
    public function login($email, $password) {
        // Verifica se é o admin
        if ($email == "admin" && $password == "admin") {
            session_destroy();
            header("Location: admin.php");
            exit;
        } else {
            // Prepara a query para buscar o usuário
            $stmt = $this->db->prepare("SELECT * FROM user_info WHERE email = ? AND pass = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Se encontrou o usuário, inicia a sessão
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row["user_id"];
                $_SESSION['f_name'] = $row["first_name"];
                $_SESSION['l_name'] = $row["last_name"];
                header("Location: index.php");
                exit;
            } else {
                // Se não encontrou, retorna falso
                return false;
            }
        }
    }
}

// Instancia o objeto Authenticator
$authenticator = new Authenticator($conn);

// Processa o formulário de login
if (isset($_POST['login'])) {
    $user_email = $_POST['email'];
    $password = $_POST['password'];
    $loginSuccessful = $authenticator->login($user_email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="login-page">
      <a href="index.php"><img src="imgs/header.png" alt="" /></a>
      <div class="login-form">
        <form action="login.php" method="post">
          <input class="input" type="text" name="email" id="email" placeholder="Email">
          <p class="wrong" id="wrongEmail"></p>
          <input class="input" type="password" name="password" id="password" placeholder="Senha">
          <p class="wrong" id="wrongPass"></p>
          <p class="wrong" id="datawrong">
          <?php
          if (isset($_POST['login']) && !$loginSuccessful) {
              echo 'Invalid email/password';
              echo '<script>setTimeout(() => {document.getElementById("datawrong").innerHTML = "";}, 3000);</script>';
          }
          ?>
          </p>
          <input type="submit" value="Login" name="login">
          <span style="margin-bottom: -20px" class="sign-ups">
            <a href="register.php">
              <p>Ainda não tem uma conta?</p>
              <p>Faça aqui seu registro.</p>
            </a>
          </span>
        </form>
      </div>
  
    </div>
    <script src="js/login.js"></script>
</body>
</html>
