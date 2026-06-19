<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$query = mysqli_query($conn, "
SELECT products.name, products.price, cart.quantity 
FROM cart 
JOIN products ON cart.product_id = products.id
WHERE cart.user_id='$user_id'
");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Summary</title>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  background: url('assets/img/background.avif') no-repeat center center fixed;
  background-size: cover;
}
.card-box {
  background: rgba(0,0,0,0.7);
  color: white;
  border-radius: 12px;
  padding: 20px;
}
</style>
</head>

<body>

<div class="container mt-5">
  <div class="card-box">

    <h3 class="text-center mb-4">🛒 Your Order Summary</h3>

    <?php if(mysqli_num_rows($query) > 0) { ?>

      <table class="table table-dark">
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Total</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($query)) { 
            $sub = $row['price'] * $row['quantity'];
            $total += $sub;
        ?>

        <tr>
          <td><?php echo $row['name']; ?></td>
          <td>₹ <?php echo $row['price']; ?></td>
          <td><?php echo $row['quantity']; ?></td>
          <td>₹ <?php echo $sub; ?></td>
        </tr>

        <?php } ?>

      </table>

      <h4 class="text-end">Total Amount: ₹ <?php echo $total; ?></h4>

    <?php } else { ?>

      <p class="text-center">Cart is empty</p>

    <?php } ?>

    <!-- PAYMENT BUTTON -->
    <form action="payment.php" method="POST">
      <input type="hidden" name="product_name" value="Multiple Items">
      <input type="hidden" name="price" value="<?php echo $total; ?>">

      <button class="btn btn-success w-100 mt-3">
        Proceed to Payment
      </button>
    </form>

  </div>
</div>

</body>
</html>