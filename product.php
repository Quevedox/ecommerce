<?php
require_once "includes/db.php";
include __DIR__ . '/includes/navbar.php';


if (!isset($_GET['id'])) {
    die("Producto no encontrado");
}

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Producto no encontrado");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/cart.js" defer></script>
</head>
<body>



<div class="container">

    <div class="product-page">

        <div class="product-img-box">
            <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        </div>

        <div class="product-info-box">
            <h1><?= htmlspecialchars($product['name']) ?></h1>

            <p class="price">
                $<?= number_format($product['price'], 0, ',', '.') ?>
            </p>

            <p class="description">
                <?= nl2br(htmlspecialchars($product['description'])) ?>
            </p>

            <!-- Botón agregar al carrito -->
            <button class="btn-add" onclick="addToCart(<?= $product['id'] ?>)">
                🛒 Agregar al carrito
            </button>
        </div>

    </div>

</div>

</body>
</html>
