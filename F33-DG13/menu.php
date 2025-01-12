<?php
// Start the session
session_start();
include 'php/dbconn.php';

//navigate to admin page for admin account
if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@admin.com') {
	header('Location: admin.php');
}

// Get the category from the URL parameter
$category = isset($_GET['category']) ? $_GET['category'] : null;

// Fetch the items from the database based on the category
$items = [];
if ($conn) {
    if ($category) {
        // If a category is specified, fetch items from that category
        $stmt = $conn->prepare("SELECT * FROM menu_items WHERE category = :category");
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    } else {
        // If no category is specified, fetch popular items
        //$stmt = $conn->prepare("SELECT product_name, description, price, img_src, SUM(quantity) as total_quantity FROM orders GROUP BY product_name, description, price, img_src ORDER BY total_quantity DESC LIMIT 3");
		$stmt = $conn->prepare("SELECT o.product_name, o.description, mi.price, o.img_src, SUM(o.quantity) as total_quantity FROM orders o INNER JOIN menu_items mi ON o.product_name = mi.name GROUP BY o.product_name, o.description, mi.price, o.img_src ORDER BY total_quantity DESC LIMIT 3");
	}
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the results
    if ($category) {
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $popularItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
} else {
    // Handle the error if the connection failed
    die("Connection failed: " . $conn->errorInfo());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Henry’s Burgers</title>
    <link rel="stylesheet" href="styles.css">
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

    <main class="menu-content">
        <aside>
			<ul>
				<li><a href="menu.php">Popular</a></li>
				<li><a href="menu.php?category=burgers">Burgers</a></li>
				<li><a href="menu.php?category=sides">Sides</a></li>
				<li><a href="menu.php?category=drinks">Drinks</a></li>
			</ul>
		</aside>


        <section class="menu">
			<?php if ($category): ?>
				<?php foreach($items as $item): ?>
				<div class="menu-item" data-name="<?php echo htmlspecialchars($item['name']); ?>" data-description="<?php echo htmlspecialchars($item['description']); ?>" data-price="<?php echo htmlspecialchars($item['price']); ?>">
					<img src="pics/<?php echo htmlspecialchars($item['image']); ?>" alt="Menu Item Image" class="menu-image">
					<p><?php echo htmlspecialchars($item['name']); ?></p>
				</div>
				<?php endforeach; ?>
			<?php else: ?>
				<h2>Most Popular Items at Henry's Burgers</h2>
				<?php foreach ($popularItems as $item): ?>
				<div class="menu-item" data-name="<?php echo htmlspecialchars($item['product_name']); ?>" data-description="<?php echo htmlspecialchars($item['description']); ?>" data-price="<?php echo htmlspecialchars($item['price']); ?>">
					<img src="<?php echo htmlspecialchars($item['img_src']); ?>" alt="Menu Item Image" class="menu-image">
					<p><?php echo htmlspecialchars($item['product_name']); ?></p>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</section>
		<div id="toast" class="toast">Item(s) added to cart!</div>
    </main>

	<!-- The Modal -->
	<div id="myModal" class="modal">
	  <div class="modal-content">
		<span class="close">&times;</span>
		<img id="modal-image" src="" alt="Menu Item Image">
		<h2>Menu Item Name</h2>
		<p>Description of the item...</p>
		<p id=priceText>Price: $xx.xx</p>
		<!-- Quantity Input Field -->
		<div class="quantity-input">
            <label for="item-quantity">Quantity:</label>
            <input type="number" id="item-quantity" value="1" min="1">
        </div>
		<button class="add-to-cart">Add to Cart</button>
	  </div>
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

<script src="js/menu.js"></script>
</body>
</html>
