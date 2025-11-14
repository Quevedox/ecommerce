<?php 
include "includes/db.php"; 
$id = $_GET['id'];

$p = $db->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <script src="js/cart.js" defer></script>
</head>
<body>

<h1><?= $p['name'] ?></h1>

<img src="<?= $p['image'] ?>">
<p><?= $p['description'] ?></p>
<p><strong>USD <?= $p['price'] ?></strong></p>

<label>Cantidad:</label>
<input type="number" id="qty" value="1" min="1">

<button onclick="addToCart(<?= $p['id'] ?>)">Agregar al carrito</button>

<div id="msg"></div>

</body>
</html>
