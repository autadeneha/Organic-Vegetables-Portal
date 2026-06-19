<?php
session_start();
include("db.php");

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check user in database
$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
    // ✅ FETCH DATA (YOU MISSED THIS)
    $row = mysqli_fetch_assoc($result);

    // ✅ STORE SESSION
    $_SESSION['user_id'] = $row['id'];   // make sure 'id' column exists
    $_SESSION['user_name'] = $row['name'];

    // ✅ REDIRECT (USE PHP REDIRECT, NOT JS)
    header("Location: index.php");
    exit();
}
else
{
    echo "<script>alert('Invalid login'); window.location.href='login.html';</script>";
}
?>