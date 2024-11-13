<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'carpi_shop';
$username = 'root'; // Cambia esto si tienes un usuario diferente
$password = ''; // Cambia esto si tienes una contraseña

try {
    // Crear conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Manejar la adición de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productCategory = $_POST['product_category'];

    // Procesar la imagen
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['product_image']['tmp_name'];
        $imageName = basename($_FILES['product_image']['name']);
        $imagePath = 'uploads/' . $imageName;

        if (!is_dir('uploads/')) {
            mkdir('uploads/', 0755, true);
        }

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Insertar el producto en la base de datos
            $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, imagen, categoria, categoria_id) VALUES (:nombre, :precio, :imagen, :categoria, :categoria_id)");
            $stmt->execute([
                ':nombre' => $productName,
                ':precio' => $productPrice,
                ':imagen' => $imagePath,
                ':categoria' => $productCategory,
                ':categoria_id' => strtolower($productCategory)
            ]);

            $message = "Producto añadido con éxito.";
        } else {
            $message = "Error al mover la imagen. Verifica los permisos de la carpeta.";
        }
    } else {
        $message = "Debe seleccionar una imagen válida.";
    }
}

// Manejar la eliminación de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $productId = $_POST['product_id'];

    // Eliminar el producto de la base de datos
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute([':id' => $productId]);

    $message = "Producto eliminado con éxito.";
}

// Verificar y descontar stock en inventario al añadir producto
if (isset($productName) && isset($productPrice) && isset($productCategory) && isset($imagePath)) {
    $stmt = $pdo->prepare("SELECT stock FROM inventario WHERE nombre = :nombre");
    $stmt->execute([':nombre' => $productName]);
    $inventario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($inventario && $inventario['stock'] > 0) {
        // Descontar una unidad del stock en inventario
        $stmt = $pdo->prepare("UPDATE inventario SET stock = stock - 1 WHERE nombre = :nombre");
        $stmt->execute([':nombre' => $productName]);
        echo "<p class='message'>Producto añadido y stock actualizado en inventario.</p>";
    } else {
        echo "<p class='message'>Stock insuficiente para el producto seleccionado.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="d.css">
</head>
<body>

    <div class="container">
        <h2>Panel de Administración</h2>

        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>

        <h3>Añadir Producto</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Nombre del Producto" required>
            <input type="number" name="product_price" placeholder="Precio del Producto" required>
            <input type="file" name="product_image" required>
            <input type="text" name="product_category" placeholder="Categoría del Producto" required>
            <button type="submit" name="add_product">Añadir Producto</button>
        </form>

        <h3>Lista de Productos</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
            <?php
            // Consultar productos en la base de datos
            $stmt = $pdo->query("SELECT * FROM productos");
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($productos as $producto) {
            ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" style="width: 50px;"></td>
                <td><?php echo $producto['categoria']; ?></td>
                <td>
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="product_id" value="<?php echo $producto['id']; ?>">
                        <button type="submit" name="delete_product" style="background-color: red; color: white; border: none; padding: 8px; border-radius: 5px; cursor: pointer;">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>

        <a href="t.php">Cerrar Sesión</a>
    </div>

</body>
</html>