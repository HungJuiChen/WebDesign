<?php
// Start the session
session_start();


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
				<li><a href="burgers.php">Burgers</a></li>
				<li><a href="sides.php">Sides</a></li>
				<li><a href="drinks.php">Drinks</a></li>
			</ul>
		</aside>


        <section class = "menu">
            <div class="menu-item" data-name="French Fries" data-description="Freshly fried fries you will never forget" data-price="3.99">
                <img src="pics/fries.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.mosburger.com.sg/menu_category/sides/ -->
                <p>French Fries</p>
            </div>
			<div class="menu-item" data-name="Croquette Pie" data-description="Hot and crunchy croquette" data-price="3.99">
                <img src="pics/pie.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.mosburger.com.sg/menu_category/sides/ -->
                <p>Croquette Pie</p>
            </div>
            <div class="menu-item" data-name="Clam Chowder" data-description="Creamy goodness" data-price="4.99">
                <img src="pics/clamchowder.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.mosburger.com.sg/menu_category/sides/ -->
                <p>Clam Chowder</p>
            </div>
            <div class="menu-item" data-name="Green Salad" data-description="Going GREEN" data-price="2.99">
                <img src="pics/salad.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.mosburger.com.sg/menu_category/sides/ -->
                <p>Salad</p>
            </div>
            
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
            <input type="number" id="item-quantity" value="1" min="1">
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
