<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
header("Location: login.html");
exit();
}

$user_id = $_SESSION['user_id'];
$product = $_POST['product_name'];
$quantity = $_POST['quantity'];
$total = $_POST['total_price'];
$payment = $_POST['payment_mode'];

$sql = "INSERT INTO orders
(user_id, product_name, quantity, total_price, payment_mode)
VALUES
('$user_id', '$product', '$quantity', '$total', '$payment')";

if (mysqli_query($conn, $sql)) {
echo "<script>
alert('Order Placed Successfully!');
window.location='index.php';
</script>";
} else {
echo "Order Failed";
}
?>