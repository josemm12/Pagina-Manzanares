<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra de Productos</title>
    <link rel="stylesheet" href="tienda.css">
</head>
<body>
    <h1>Selecciona un Producto</h1>
    <form action="procesar_pedido.php" method="post">
        <label for="producto">Producto:</label>
        <select name="producto" id="producto">
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?> - $<?php echo $row['precio']; ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>
        <h2>Información del Cliente</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
        <br><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required>
        <br><br>
        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <input type="submit" value="Realizar Pedido">
        <a href="index.html">Volver</a>
    </form>
</body>
</html>

<?php $conn->close(); ?>
