<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$total = $_POST['total_amount'];
?>

<h2>Select Payment Mode</h2>

<h3>Total Amount: ₹ <?php echo $total; ?></h3>

<form action="place_order.php" method="POST">

<input type="hidden" name="total_amount" value="<?php echo $total; ?>">

<label>
<input type="radio" name="payment_mode" value="Net Banking" required>
Net Banking
</label><br><br>

<label>
<input type="radio" name="payment_mode" value="QR Code">
QR Code
</label><br><br>

<!-- Sample QR Image -->
<img src="images/qr.png" width="200"><br><br>

<button type="submit">Place Order</button>

</form>