<?php
session_start();
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
	
	$sql = "SELECT * FROM user_details WHERE email = ?";
	$stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user_details = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
		$_SESSION["user_name"] = $user_details["name"];
		$_SESSION["user_email"] = $user_details["email"];
        // Check if the logged-in user is an admin
		if ($email === 'admin@admin.com') {
			header('Location: ../admin.php');
		} else {
			header('Location: ../profile.php');
		}
		exit(); // Always exit after a redirect to stop further script execution.																		 
    } else {
		// Redirect back to the login page with an error message.
        header('Location: ../loginpage.php?error=Incorrect email or password!');
        exit(); // Always exit after a redirect to stop further script execution.							 
    }
}
?>
