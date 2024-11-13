<?php
$servername = "localhost";
$username = "root"; // Cambia esto si tu usuario de MySQL es diferente
$password = ""; // Cambia esto si tu contraseña de MySQL es diferente
$dbname = "nagaraku store";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname); /*campos de base de datos*/

// Comprobar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE nombre_completo = '$nombre'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Verificar contraseña
    $row = $result->fetch_assoc();
    if (password_verify($contrasena, $row['contrasena'])) {
        header("location:http://localhost/proyecto2/php/a%C3%B1adir_producto.php"); /*pagina donde se dirige el admi*/
        echo "Inicio de sesión exitoso. <a href='http://localhost/proyecto2/php/a%C3%B1adir_producto.php'>Ir al sitio</a>";
    } else {
        echo "Contraseña incorrecta. <a href='inicioadmi.html'>Intentar de nuevo</a>";
    }
} else {
    echo "Usuario no registrado. <a href='registro.html'>Registrarse</a>"; /*registro - hacer pagina de registro*/
}

$conn->close();
?>