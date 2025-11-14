<?php
require 'includes/db.php';

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
    <title><?= $product['name'] ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">

    <div class="product-page">

        <div class="product-img-box">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        </div>

        <div class="product-info-box">
            <h1><?= $product['name'] ?></h1>

            <p class="price">$<?= number_format($product['price'], 0, ',', '.') ?></p>

            <p class="description"><?= $product['description'] ?></p>

            <button class="btn-add" onclick="addToCart(<?= $product['id'] ?>)">
                🛒 Agregar al carrito
            </button>
        </div>

    </div>

</div>

<script>
function addToCart(id) {
    let formData = new FormData();
    formData.append("id", id);

    fetch("ajax/add_to_cart.php", {
        method: "POST",
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        alert(data.message);
    });
}
</script>

</body>
</html>
