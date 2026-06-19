<?php
session_start();
include "db.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Check if product_id is received
if (isset($_GET['product_id'])) {

    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['product_id'];

    // Delete item from cart
    $delete = "DELETE FROM cart 
               WHERE user_id='$user_id' 
               AND product_id='$product_id'";

    mysqli_query($conn, $delete);
}

// Redirect back to cart page
header("Location: cart_page.php");
exit();
?>