<?php
$servername = "localhost";  // Dirección del servidor MySQL
$username = "root";  // Nombre de usuario de MySQL
$password = "";  // Contraseña de MySQL (si usas XAMPP por defecto está vacía)
$dbname = "nagarakustore";  // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
