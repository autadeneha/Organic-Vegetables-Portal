<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.product_name, products.price, cart.quantity
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

$total = 0;
?>

<h2>Your Cart</h2>

<table border="1" cellpadding="10">
<tr>
  <th>Product</th>
  <th>Price</th>
  <th>Quantity</th>
  <th>Subtotal</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { 
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
?>
<tr>
  <td><?php echo $row['product_name']; ?></td>
  <td><?php echo $row['price']; ?></td>
  <td><?php echo $row['quantity']; ?></td>
  <td><?php echo $subtotal; ?></td>
</tr>
<?php } ?>

</table>

<h3>Total: ₹ <?php echo $total; ?></h3>

<form action="payment.php" method="POST">
    <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
    <button type="submit">Proceed to Payment</button>
</form>