<?php
// Start the session
session_start();
include 'php/dbconn.php';

//navigate to admin page for admin account
if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@admin.com') {
	header('Location: admin.php');
}

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to see the cart'); window.location.href='loginpage.php';</script>";
    exit; // End the execution of the script
}
$totalPrice = 0;
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM carts WHERE user_id = ?");
$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Henry's Burgers</title>
    <link rel="stylesheet" href="styles.css">
	<style>
        
    </style>
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
    <div class="main-cart">
        <table class ="cart-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
					<th></th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($cartItems as $item): ?>
					<tr > <!-- Add an ID to the row -->
						<td class="product-desc">
							<img src="<?php echo htmlspecialchars($item['img_src']); ?>" alt="Product Image" class="product-image">
							<?php 
							echo htmlspecialchars($item['product_name']) . "<br><br>" . 
								 htmlspecialchars($item['description']);
							?>
						</td>
						<td>
							<form method="POST" action="php/update_quantity.php">
								<input type="hidden" name="item_id" value="<?php echo $item['id']; ?>" />
								<input type="submit" name="decrease" value="−" onclick="return confirmDecrease(this.form, this);" />
								<span><?php echo htmlspecialchars($item['quantity']); ?></span>
								<input type="submit" name="increase" value="+" onclick="return confirmIncrease(this.form, this);" />
							</form>
						</td>
						<td>
							<?php 
								$itemTotal = $item['price'] * $item['quantity'];
								echo "$" . number_format($itemTotal, 2); 
								$totalPrice += $itemTotal;  // Add to the total price
							?>
						</td>
						<td>
						  <form method="POST" action="php/remove_item.php">
							<input type="hidden" name="item_id" value="<?php echo $item['id']; ?>" />
							<input type="submit" name="remove" value="Remove" class = "remove-button" onclick="return confirm('Are you sure you want to remove this item?');" />
						  </form>
						</td>
					</tr>
				<?php endforeach; ?>
            </tbody>
			<tfoot>
				<tr>
					<td colspan="2" style="text-align: right;">Total Price : </td>
					<td>$<?php echo number_format($totalPrice, 2); ?></td>
				</tr>
			</tfoot>
        </table>
        <form action="php/checkout.php" method="post">
			<button type="submit" class="checkout-button">CHECKOUT</button>
		</form>
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
    <script src="js/cart.js"></script>
</body>
</html>
