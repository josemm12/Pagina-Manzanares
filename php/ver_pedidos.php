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

// Consultar pedidos con información del cliente y producto
$sql = "
    SELECT 
        pedidos.id AS pedido_id,
        clientes.nombre AS cliente_nombre,
        productos.nombre AS producto_nombre,
        pedidos.cantidad,
        pedidos.fecha
    FROM pedidos
    JOIN clientes ON pedidos.cliente_id = clientes.id
    JOIN productos ON pedidos.producto_id = productos.id
    ORDER BY pedidos.fecha DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Pedidos</title>
    <link rel="stylesheet" href="pedidos.css">
</head>
<body>
    <h1>Listado de Pedidos</h1>
    <table>
        <thead>
            <tr>
                <th>ID del Pedido</th>
                <th>Nombre del Cliente</th>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['pedido_id']; ?></td>
                        <td><?php echo $row['cliente_nombre']; ?></td>
                        <td><?php echo $row['producto_nombre']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay pedidos para mostrar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php $conn->close(); ?>
    <a href="index.html">Volver</a>
</body>
</html>