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

// Obtener datos del formulario
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip'];
$total = $_POST['total'];
$card_name = $_POST['card_name'];
$card_number = $_POST['card_number'];
$exp_month = $_POST['exp_month'];
$exp_year = $_POST['exp_year'];
$cvv = $_POST['cvv'];

// Insertar datos en la base de datos
$sql = "INSERT INTO payments (full_name, email, address, city, state, zip_code, total, card_name, card_number, exp_month, exp_year, cvv)
VALUES ('$full_name', '$email', '$address', '$city', '$state', '$zip_code', '$total', '$card_name', '$card_number', '$exp_month', '$exp_year', '$cvv')";

if ($conn->query($sql) === TRUE) {
    echo "Payment processed successfully";
    header ("location:principal.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>