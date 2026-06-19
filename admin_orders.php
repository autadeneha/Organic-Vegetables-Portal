<?php
include "db.php";

$sql = "SELECT users.name, orders.product_name, orders.quantity, 
               orders.total_price, orders.payment_mode, orders.order_date
        FROM orders
        JOIN users ON orders.user_id = users.id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Orders</title>
</head>
<body>

<h2>All Orders</h2>

<table border="1" cellpadding="10">
<tr>
  <th>User</th>
  <th>Product</th>
  <th>Quantity</th>
  <th>Total</th>
  <th>Payment</th>
  <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
  <td><?php echo $row['name']; ?></td>
  <td><?php echo $row['product_name']; ?></td>
  <td><?php echo $row['quantity']; ?></td>
  <td><?php echo $row['total_price']; ?></td>
  <td><?php echo $row['payment_mode']; ?></td>
  <td><?php echo $row['order_date']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>