<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.product_name, products.price, cart.quantity, cart.product_id
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

$total = 0;

// Send data to template
include "cart_template.php";
?>