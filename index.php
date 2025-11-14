<?php
require_once "controllers/products_controller.php";
$featured = getFeaturedProducts();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ecommerce - Home</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/cart.js" defer></script>
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">Ecommerce</a>

        <nav class="nav-links" id="navLinks">
            <a href="index.php">Home</a>
            <a href="cart.php">Carrito <span id="cartCount">0</span></a>
            <a href="#">Contacto</a>
        </nav>

        <button class="nav-toggle" onclick="toggleMenu()">☰</button>
    </div>
</header>

<div class="container">
    <h2>Productos Destacados</h2>

    <div class="product-grid">
        <?php foreach ($featured as $p): ?>
            <a href="product.php?id=<?= $p['id'] ?>" class="product-link">

            <div class="product-card">
                
                <!-- Botón agregar -->
                <button class="add-cart-btn" onclick="addToCart(<?= $p['id'] ?>)">
                    <svg width="20" height="20" viewBox="0 0 24 24">
                        <path d="M7 4h-2l-3 7v2h2l3-7h11l2 4h2l-3-6h-12zm0 13c-1.104 0-2 .897-2 2 0 
                        1.104.896 2 2 2s2-.896 2-2c0-1.103-.896-2-2-2zm10 
                        0c-1.104 0-2 .897-2 2 0 1.104.896 2 2 2s2-.896 
                        2-2c0-1.103-.896-2-2-2z"/>
                    </svg>
                </button>

                <img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>">
                <h3><?= $p['name'] ?></h3>
                <p class="price">$<?= number_format($p['price'], 0) ?></p>

            </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
