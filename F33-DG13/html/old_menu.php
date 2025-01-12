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
				<li><a href="menu.php">Set Meal</a></li>
				<li><a href="burgers.php">Burgers</a></li>
				<li><a href="sides.php">Sides</a></li>
				<li><a href="drinks.php">Drinks</a></li>
			</ul>
		</aside>


        <section class = "menu">
            <div class="menu-item" data-name="Beef Burger Set" data-description="Description of Burger 1" data-price="11.99">
                <img src="pics/beefburger.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.cookist.com/beef-burger/ -->
                <p>Beef Burger Set</p>
            </div>
            <div class="menu-item" data-name="Chicken Burger Set" data-description="Description of Burger 2" data-price="9.99">
                <img src="pics/chickenburger.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.123rf.com/photo_45459502_crispy-chicken-burger-and-fries-on-wood.html -->
                <p>Chicken Burger Set</p>
            </div>
            <div class="menu-item" data-name="Lamb Burger Set" data-description="Description of Burger 3" data-price="12.99">
                <img src="pics/lambburger.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.georgeforeman.co.uk/recipes/burgers/welsh-lamb-burgers -->
                <p>Lamb Burger Set</p>
            </div>
            <div class="menu-item" data-name="Fish Burger Set" data-description="Description of Burger 4" data-price="10.99">
                <img src="pics/fishburger.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://airfryer.net/recipes/89 -->
                <p>Fish Burger Set</p>
            </div>
            <div class="menu-item" data-name="Croquette Burger Set" data-description="Description of Burger 5" data-price="8.99">
                <img src="pics/croquetteburger.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.mccainusafoodservice.com/menu-ideas/details/fajita-chicken-wrap/ -->
                <p>Croquette Burger Set</p>
            </div>
            <div class="menu-item" data-name="Hotdog Set" data-description="Description of Burger 6" data-price="7.99">
                <img src="pics/hotdog.jpg" alt="Menu Item Image" class="menu-image">
				<!--img from: https://www.freepik.com/free-photo/gourmet-grilled-all-beef-hot-dog-with-sides-chips-delicious-simple-hot-dogs-with-mustard-pepper-onion-nachos-hot-dogs-fully-loaded-with-assorted-toppings-paddle-board_14623942.htm -->
                <p>Hotdog Set</p>
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
