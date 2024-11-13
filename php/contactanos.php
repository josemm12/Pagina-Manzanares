<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";  // Cambia a tu nombre de usuario
$password = "";      // Cambia a tu contraseña
$dbname = "nagarakustore";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje']
// Insertar datos en la base de datos
$sql = "INSERT INTO payments (full_name, email, address, city, state, zip_code, total, card_name, card_number, exp_month, exp_year, cvv)
VALUES ('$full_name', '$email', $mensajes')";

if ($conn->query($sql) === TRUE) {
    echo "Payment processed successfully";
    header ("location:principal.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>