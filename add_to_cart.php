<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    // Add the product to the cart in the database
    // ...
}
?>
