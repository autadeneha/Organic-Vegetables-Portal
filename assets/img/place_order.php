<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$payment_mode = $_POST['payment_mode'];
$total_amount = $_POST['total_amount'];

$cart_query = mysqli_query($conn,
    "SELECT products.product_name, products.price, cart.quantity
     FROM cart
     JOIN products ON cart.product_id = products.id
     WHERE cart.user_id = '$user_id'"
);

while ($row = mysqli_fetch_assoc($cart_query)) {

    $product_name = $row['product_name'];
    $quantity = $row['quantity'];
    $subtotal = $row['price'] * $quantity;

    mysqli_query($conn,
        "INSERT INTO orders (user_id, product_name, quantity, total_price, payment_mode)
         VALUES ('$user_id', '$product_name', '$quantity', '$subtotal', '$payment_mode')"
    );
}

// ✅ Clear Cart After Order
mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");

echo "<h2>Order Placed Successfully 🎉</h2>";
echo "<a href='products.php'>Continue Shopping</a>";
?>