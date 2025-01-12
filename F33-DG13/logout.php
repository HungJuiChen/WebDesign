<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to homepage with a logged_out parameter
header('Location: home.php');
exit();
?>
