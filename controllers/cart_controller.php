<?php
session_start();
header("Content-Type: application/json");

$id = $_POST["id"] ?? null;

if (!$id) {
    echo json_encode(["status" => "error"]);
    exit;
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if (!isset($_SESSION["cart"][$id])) {
    $_SESSION["cart"][$id] = 0;
}

$_SESSION["cart"][$id]++;

echo json_encode([
    "status" => "ok",
    "cartCount" => array_sum($_SESSION["cart"])
]);

