<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
header("Location: login.html");
exit();
}

$product = $_POST['product_name'];
$price = $_POST['price'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment</title>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  background: url('assets/img/background.avif') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
}

.overlay-card {
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(6px);
  border-radius: 12px;
  color: white;
}

.form-check-input {
  cursor: pointer;
}

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

<div class="container d-flex align-items-center justify-content-center" style="height:100vh;">
  <div class="col-md-5">
    <div class="card overlay-card shadow-lg p-4">

      <h3 class="text-center mb-3">Payment Details</h3>

      <h5>Product: <?php echo $product; ?></h5>
      <h5 class="mb-3">Total Price: ₹ <?php echo $price; ?></h5>

      <form action="checkout.php" method="POST">

        <input type="hidden" name="product_name" value="<?php echo $product; ?>">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="total_price" value="<?php echo $price; ?>">

        <h5 class="mt-3">Select Payment Mode</h5>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_mode" value="Net Banking" required>
          <label class="form-check-label">Net Banking</label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_mode" value="QR Code" required>
          <label class="form-check-label">QR Code</label>
        </div>

        <div id="qr" style="display:none;" class="text-center mt-3">
          <img src="assets/img/qr.png" width="200" class="rounded">
          <p class="mt-2">Scan to Pay</p>
        </div>

        <button class="btn btn-custom w-100 mt-4">Place Order</button>

      </form>

    </div>
  </div>
</div>

<script>
document.querySelectorAll("input[name='payment_mode']").forEach(radio => {
  radio.addEventListener("change", function() {
    if (this.value === "QR Code") {
      document.getElementById("qr").style.display = "block";
    } else {
      document.getElementById("qr").style.display = "none";
    }
  });
});
</script>

</body>
</html>