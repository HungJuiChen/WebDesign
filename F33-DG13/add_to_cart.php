<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in
    echo "Please log in to add items to the cart.";
    exit;  // End the script here
}

$host = 'localhost'; // Database host
$db   = 'henrys_burgers'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

// Assuming $_POST contains 'itemName', 'itemPrice', 'itemQuantity', 'itemDesc', and 'itemImgSrc' 
$itemName = $_POST['name'];
$itemPrice = $_POST['price'];
$itemQuantity = $_POST['quantity'];
$itemDesc = $_POST['desc'];
$itemImgSrc = $_POST['imgSrc'];
$user_id = $_SESSION['user_id'];

// Check if the item already exists in the cart for the user
$stmt = $pdo->prepare("SELECT * FROM carts WHERE user_id = ? AND product_name = ?");
$stmt->execute([$user_id, $itemName]);
$existingItem = $stmt->fetch();

if ($existingItem) {
    // Item already exists, so update the quantity and total
    /*$newQuantity = $existingItem['quantity'] + $itemQuantity;
    $newTotal = $newQuantity * $itemPrice;*/
    $newQuantity = $existingItem['quantity'] + $itemQuantity;
    $stmt = $pdo->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND product_name = ?");
    $stmt->execute([$newQuantity, $user_id, $itemName]);
} else {
    // Item doesn't exist, so insert a new row
    $total = $itemPrice * $itemQuantity;
    $stmt = $pdo->prepare("INSERT INTO carts (user_id, product_name, description, price, quantity, img_src) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $itemName, $itemDesc, $itemPrice, $itemQuantity, $itemImgSrc]);
}
echo "Item Added!!";
?>
