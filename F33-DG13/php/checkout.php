<?php
session_start();
include 'dbconn.php';

$user_id = $_SESSION['user_id'];

// Fetch items from cart
$stmt = $conn->prepare("SELECT * FROM carts WHERE user_id = ?");
$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll();

$cart_id = getNextCartID($user_id);

// Email header for HTML email content
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: f31ee@localhost' . "\r\n" .
            'Reply-To: f31ee@localhost' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

// Start with the email content
$emailContent = '<html><body>';
$emailContent .= '<h1>Order Confirmation - Cart ID: ' . htmlspecialchars($cart_id) . '</h1>';
$emailContent .= '<p>Thank you for your order! Here are the details:</p>';
$emailContent .= '<table border="1" style="width:100%; border-collapse: collapse;">';
$emailContent .= '<tr><th>Item</th><th>Quantity</th><th>Price</th></tr>';

$totalPrice = 0;
 
// Insert items into orders table and remove from cart
foreach($cartItems as $item) {
    $stmt = $conn->prepare("INSERT INTO orders ( user_id, cart_id, product_name, description, price, quantity, img_src) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $cart_id, $item['product_name'], $item['description'], $item['price'], $item['quantity'], $item['img_src']]);
    $stmt = $conn->prepare("DELETE FROM carts WHERE user_id = ? AND product_name = ?");
    $stmt->execute([$user_id, $item['product_name']]);
	
	//Email content
	$itemTotal = $item['price'] * $item['quantity'];
    $totalPrice += $itemTotal; // Add to the total price

    $emailContent .= '<tr>';
    $emailContent .= '<td>' . htmlspecialchars($item['product_name']) . '</td>';
    $emailContent .= '<td>' . htmlspecialchars($item['quantity']) . '</td>';
    $emailContent .= '<td>$' . number_format($itemTotal, 2) . '</td>';
    $emailContent .= '</tr>';
}

$emailContent .= '<tr><td colspan="2" style="text-align:right;">Total Price:</td>';
$emailContent .= '<td>$' . number_format($totalPrice, 2) . '</td></tr>';
$emailContent .= '</table>';
$emailContent .= '</body></html>';

function getNextCartID($user_id) {
    global $conn;  // Ensure the database connection is accessible within this function
    
    // Fetch the highest cart_id for this user
    $stmt = $conn->prepare("SELECT MAX(cart_id) as maxCartID FROM orders WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If no previous cart exists, return 1. Otherwise, return the next available cart_id.
    if ($row['maxCartID']) {
        return $row['maxCartID'] + 1;
    } else {
        return 1;
    }
}

$emailContent .= '<tr><td colspan="2" style="text-align:right;">Total Price:</td>';
$emailContent .= '<td>$' . number_format($totalPrice, 2) . '</td></tr>';
$emailContent .= '</table>';
$emailContent .= '</body></html>';

// Recipient email
$to = 'f32ee@localhost';
$subject = 'Order Confirmation';

// Send the email
if(mail($to, $subject, $emailContent, $headers)) {
    echo "Email sent successfully";
} else {
    echo "Email sending failed";
}


// Optionally, redirect to a confirmation page or the homepage after checkout
header("Location: ../home.php");
exit;
?>
