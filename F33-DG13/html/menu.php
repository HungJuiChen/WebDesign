<?php
// Start the session
session_start();
include 'php/dbconn.php';

$popularItems = [];

try {
    // Create the query
    $stmt = $conn->prepare("SELECT product_name, description, price, img_src, SUM(quantity) as total_quantity FROM orders GROUP BY product_name, description, price, img_src ORDER BY total_quantity DESC LIMIT 3");

    // Execute the query
    $stmt->execute();

    // Set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $popularItems = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null; // Close the database connection

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
				<li><a href="menu1.php?category=burgers">Burgers</a></li>
				<li><a href="menu1.php?category=sides">Sides</a></li>
				<li><a href="menu1.php?category=drinks">Drinks</a></li>
			</ul>
		</aside>


        <section class="menu">
			<h2> Most Popular Items in Henry's Burgers</h2>
			<?php foreach ($popularItems as $item): ?>
				<div class="menu-item" data-name="<?php echo htmlspecialchars($item['product_name']); ?>" data-description="<?php echo htmlspecialchars($item['description']); ?>" data-price="<?php echo htmlspecialchars($item['price']); ?>">
					<img src="<?php echo htmlspecialchars($item['img_src']); ?>" alt="Menu Item Image" class="menu-image">
					<p><?php echo htmlspecialchars($item['product_name']); ?></p>
				</div>
			<?php endforeach; ?>
		</section>
		<div id="toast" class="toast">Item(s) added to cart!</div>
    </main>

    <footer>
        <!-- Footer content if any -->
    </footer>
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
            <input type="number" id="item-quantity" value="1" min="0">
        </div>
		<button class="add-to-cart">Add to Cart</button>
	  </div>
	</div>
	<script>
    <!--alert("JavaScript is working!"); //just to check if JS is being loaded -->
</script>

<script src="js/menu.js"></script>
</body>
</html>
