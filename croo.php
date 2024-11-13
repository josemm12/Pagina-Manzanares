<?php
session_start();
?>
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
<form action="add_to_cart.php" method="POST">
    <input type="hidden" name="product_id" value="1">
    <input type="hidden" name="product_name" value="Producto Ejemplo">
    <input type="hidden" name="product_price" value="10.00">
    <button type="submit">Agregar al Carrito</button>
</form>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $item = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    ];

    // Verificar si el producto ya está en el carrito
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $product_id) {
            $cart_item['quantity']++;
            $found = true;
            break;
        }
    }

    // Si no se encontró el producto, agregarlo al carrito
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
}

// Redirigir de vuelta a la página principal o a la página del carrito
header("Location: index.php");
exit();
?>
 <?php
session_start();
?>

<h1>Productos en el carrito</h1>

<table>
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
    </tr>

    <?php if (empty($_SESSION['cart'])): ?>
        <tr>
            <td colspan="3">El carrito está vacío.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>