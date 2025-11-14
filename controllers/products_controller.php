<?php
require_once __DIR__ . "/../includes/db.php";

function getFeaturedProducts() {
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM products WHERE featured = 1");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
