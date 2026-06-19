<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();
?>

<script>
// Remove login flag from browser
localStorage.removeItem("isLoggedIn");

// Redirect to login page
window.location.href = "login.html";
</script>