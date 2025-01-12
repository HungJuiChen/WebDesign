<?php
$host = 'localhost';
$db_name = 'henrys_burgers';
$username = 'root';   // MySQL username
$password = '';       // MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
