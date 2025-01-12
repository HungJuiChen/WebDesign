<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $contact = $_POST["contact"];
    $address = $_POST["address"];

    // Check if email already exists
    $sql_email_check = "SELECT * FROM users WHERE email = ?";
    $stmt_email_check = $conn->prepare($sql_email_check);
    $stmt_email_check->execute([$email]);
    $email_exist = $stmt_email_check->fetchColumn();

    if ($email_exist) {
        // Email already exists in the database
        echo "<script>alert('Email already exists. Please use a different email.'); window.history.go(-1);</script>";
    } else {
        // Email doesn't exist, proceed with registration
        // Insert user credentials into users table
        $sql_users = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt_users = $conn->prepare($sql_users);
        $stmt_users->execute([$email, $password]);

        // Insert user details into user_details table
        $sql_details = "INSERT INTO user_details (email, name, contact, address) VALUES (?, ?, ?, ?)";
        $stmt_details = $conn->prepare($sql_details);
        $stmt_details->execute([$email, $name, $contact, $address]);

        // Redirect to login page with success message
        echo "<script>alert('Account created successfully!'); window.location.href='../loginpage.php';</script>";
        //header('Location: ../loginpage.php');
        exit();
    }
}
?>
