<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Organic Vegetable Portal</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-4">
    <span class="navbar-brand mb-0 h1">🌿 Organic Vegetable Portal</span>
    <a href="view_cart.php" class="btn btn-warning">🛒 View Cart</a>
</nav>

<div class="container mt-4">
    <div class="row">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="col-md-3 mb-4">
        <div class="card shadow-sm">
            <img src="images/<?php echo $row['image']; ?>" 
                 class="card-img-top" height="200">

            <div class="card-body text-center">
                <h5 class="card-title">
                    <?php echo $row['product_name']; ?>
                </h5>

                <p class="text-success fw-bold">
                    ₹ <?php echo $row['price']; ?>
                </p>

                <form action="cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <button type="submit">Add to Cart</button>
</form>
            </div>
        </div>
    </div>

<?php } ?>

    </div>
</div>

</body>
</html>