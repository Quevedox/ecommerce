<?php
session_start();
require_once "./includes/db.php";

// Obtener productos del carrito
$cart = $_SESSION["cart"] ?? [];

$items = [];
$total = 0;

if (!empty($cart)) {
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $id = $row['id'];
        $row['qty'] = $cart[$id];
        $row['subtotal'] = $row['qty'] * $row['price'];
        $total += $row['subtotal'];
        $items[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/cart.js" defer></script>
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">MiTienda</a>
        <nav class="nav-links" id="navLinks">
            <a href="index.php">Home</a>
            <a href="cart.php">Carrito <span id="cartCount"><?= array_sum($cart) ?></span></a>
        </nav>
        <button class="nav-toggle" onclick="toggleMenu()">☰</button>
    </div>
</header>

<div class="container">
    <h2>Mi Carrito</h2>

    <?php if (empty($items)): ?>
        <p>No hay productos en el carrito.</p>

    <?php else: ?>
        <table class="cart-table">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cant.</th>
                <th>Subtotal</th>
                <th></th>
            </tr>

            <?php foreach ($items as $p): ?>
                <tr id="row-<?= $p['id'] ?>">
                    <td><?= $p['name'] ?></td>
                    <td>$<?= number_format($p['price'], 0) ?></td>

                    <td>
                        <button onclick="updateQty(<?= $p['id'] ?>, 'minus')">-</button>
                        <span id="qty-<?= $p['id'] ?>"><?= $p['qty'] ?></span>
                        <button onclick="updateQty(<?= $p['id'] ?>, 'plus')">+</button>
                    </td>

                    <td id="subtotal-<?= $p['id'] ?>">
                        $<?= number_format($p['subtotal'], 0) ?>
                    </td>

                    <td>
                        <button onclick="removeItem(<?= $p['id'] ?>)">❌</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Total: $<span id="total"><?= number_format($total, 0) ?></span></h3>

        <button class="checkout-btn">Ir a pagar</button>
    <?php endif; ?>
</div>

</body>
</html>

