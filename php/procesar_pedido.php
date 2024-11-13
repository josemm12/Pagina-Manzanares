<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nagarakustore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$drescripciones = $_POST['descripciones'];
$precio = $_POST['precio'];
$categoria= $_POST['categoria'];
$imagen_url = $_POST['imagen_url'];

// Insertar cliente
$sql = "INSERT INTO clientes (id_productos, nombre, precio, categoria, imagen_url) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $direccion, $ciudad, $pais, $email);
$stmt->execute();
$cliente_id = $stmt->insert_id;
$stmt->close();

// Insertar pedido
$cantidad = 1; // Suponemos que la cantidad es 1
$sql = "INSERT INTO pedidos (cliente_id, producto_id, cantidad) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $cliente_id, $producto_id, $cantidad);
$stmt->execute();
$stmt->close();

echo "Pedido realizado con éxito.";
header("location:prueba.html");

$conn->close();
?>
