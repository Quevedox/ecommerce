<?php
require_once __DIR__ . "/../includes/db.php";

function getFeaturedProducts() {
    global $conn;
    $sql = "SELECT * FROM products WHERE featured = 1";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}
