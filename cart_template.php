<!DOCTYPE html>
<html>
<head>
<title>Your Cart</title>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  background: url('assets/img/background.avif') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
}

/* Blur black card like login */
.overlay-card {
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(6px);
  border-radius: 15px;
  color: white;
  padding: 35px;
}

/* Table styling */
.table {
  color: white;
}

.table th, .table td {
  border-color: rgba(255,255,255,0.3);
}

/* Button style same as login */
.btn-custom {
  background-color: #28a745;
  color: white;
}

.btn-custom:hover {
  background-color: #218838;
}
</style>

</head>

<body>

<div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
  <div class="col-md-8">

    <div class="overlay-card shadow-lg">

      <h2 class="text-center mb-4">🛒 Your Cart</h2>

      <table class="table text-center">
        <tr>
          <th>Product</th>
          <th>Price (₹)</th>
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

                <!-- DELETE BUTTON -->
  <td>
    <form action="remove_from_cart.php" method="POST">
      <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
      <button class="btn btn-danger btn-sm">Delete</button>
    </form>
  </td>
        </tr>


        <?php } ?>

      </table>

      <div class="text-end mt-3">
        <h4>Total: ₹ <?php echo $total; ?></h4>

        <form action="payment.php" method="POST">
          <input type="hidden" name="price" value="<?php echo $total; ?>">
          <input type="hidden" name="product_name" value="Cart Items">
          <button class="btn btn-custom mt-2 w-100">Proceed to Payment</button>
        </form>
      </div>

    </div>

  </div>
</div>

</body>
</html>