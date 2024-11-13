<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tienda.";

// Conexión a la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validación simple de usuario y contraseña
    if ($username === 'admin' && $password === '1234') {
        $_SESSION['loggedin'] = true;
        header("Location: p.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
     <link rel="stylesheet" href="d.css">
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { padding: 20px; background-color: #f4f4f4; border-radius: 5px; width: 300px; text-align: center; }
        input, button { width: 100%; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="login">Iniciar Sesión</button>
        </form>
    </div>

</body>
</html>