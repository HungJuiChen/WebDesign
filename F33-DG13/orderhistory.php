<?php
session_start();

include 'php/dbconn.php';

//navigate to admin page for admin account
if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@admin.com') {
	header('Location: admin.php');
}

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch order history
$query = "SELECT cart_id, GROUP_CONCAT(product_name) as product_names, 
                 GROUP_CONCAT(description) as descriptions, 
                 GROUP_CONCAT(price) as prices, 
                 GROUP_CONCAT(quantity) as quantities, 
                 GROUP_CONCAT(img_src) as img_srcs, 
                 MAX(order_date) as order_date
          FROM orders
          WHERE user_id = :user_id
          GROUP BY cart_id
          ORDER BY order_date ASC";
$stmt = $conn->prepare($query);
$stmt->execute([':user_id' => $user_id]);

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Henry's Burgers</title>
    <link rel="stylesheet" href="styles.css">
    <title>Order History</title>
</head>
<body>
	<header>
			<div class="logo-container">
				<img src="pics/logo.png" alt="Henry’s Burgers’ logo" class = "logo-image">
			</div>
			<div class="session-container">
				<div class="login-container">
					<?php if(isset($_SESSION['user_id'])): ?>
						<a href="logout.php">LOGOUT</a>	
					<?php else: ?>
						<a href="loginpage.php">LOGIN</a>
					<?php endif; ?>
				</div>
				<div class="user-name-container">
				<?php if(isset($_SESSION['user_name'])): ?>
					<?php echo '<p> Welcome, <a href="profile.php">'.htmlspecialchars($_SESSION['user_name']).'!</a></p>'; ?>
				<?php endif; ?>
				</div>
			</div>
	</header>
	<nav>
        <a href="home.php">HOME</a>
        <a href="menu.php">MENU</a>
        <a href="about.php">ABOUT</a>
        <a href="cart.php">CART</a>
    </nav>
	<div class="orderhistory-cart">
		<h2>Your Order History</h2>
		<table class="orderhistory-table">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Product Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Image</th>
					<th>Order Date</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($orders as $order): ?>
				<tr>
					<td><?php echo htmlspecialchars($order['cart_id']); ?></td>
					<td>
						<?php 
						$products = explode(',', $order['product_names']);
						foreach($products as $product) {
							echo htmlspecialchars($product) . '<br>';
						}
						?>
					</td>
					<td>
						<?php 
						$descriptions = explode(',', $order['descriptions']);
						foreach($descriptions as $description) {
							echo htmlspecialchars($description) . '<br>';
						}
						?>
					</td>
					<td>
						<?php 
						$prices = explode(',', $order['prices']);
						foreach($prices as $price) {
							echo htmlspecialchars($price) . '<br>';
						}
						?>
					</td>
					<td>
						<?php 
						$quantities = explode(',', $order['quantities']);
						foreach($quantities as $quantity) {
							echo htmlspecialchars($quantity) . '<br>';
						}
						?>
					</td>
					<td>
						<?php 
						$imgs = explode(',', $order['img_srcs']);
						foreach($imgs as $img) {
							echo '<img src="' . htmlspecialchars($img) . '" alt="Product Image" width="100"><br>';
						}
						?>
					</td>
					<td><?php echo htmlspecialchars($order['order_date']); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<a href="profile.php" class="home-button">Back to Profile</a>
	</div>
	<footer>
		<div class="footer-container">
			<div class="footer-section">
			  <h4>Menu</h4>
			  <ul>
				<li><a href="menu.php">Popular</a></li>
				<li><a href="menu.php?category=burgers">Burgers</a></li>
				<li><a href="menu.php?category=sides">Sides</a></li>
				<li><a href="menu.php?category=drinks">Drinks</a></li>
			  </ul>
			</div>
			<div></div>
			<div class="footer-section">
			  <h4>Contact Us</h4>
			  <ul>
				  <li><a href="mailto:henrys@burgers.com">More enquiries?<br> Drop us an email!<br> henrys@burgers.com</a></li>
				  <li><a href="about.php">About Us</a></li>
			  </ul>
			</div>
		</div>
		<br>Copyright &copy; 2023 Henry's Burgers<br>
	</footer>
</body>
</html>
