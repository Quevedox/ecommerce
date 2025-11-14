<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="/ecommerce/css/style.css">

<header class="navbar">
    <div class="nav-container">
        <a href="/ecommerce/index.php" class="nav-logo">Ecommerce</a>

        <nav class="nav-links">
            <a href="/ecommerce/index.php">Inicio</a>
            <a href="/ecommerce/cart.php">Carrito 
                <span class="cart-count">
                    <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                </span>
            </a>
        </nav>
    </div>
</header>
