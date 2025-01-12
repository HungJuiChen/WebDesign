<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Henry's Burgers</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="pics/logo.png" alt="Henry’s Burgers’ logo" class = "logo-image">
        </div>
        <div class="login-container">
            <a href="loginpage.php">LOGIN</a>
        </div>
    </header>
    <nav>
        <a href="home.php">HOME</a>
        <a href="menu.php">MENU</a>
        <a href="about.php">ABOUT</a>
        <a href="cart.php">CART</a>
    </nav>
    <div class="login-page">
		<h2>LOGIN</h2>
		<form action="php/login.php" method="post">
			<label for="email">Email Address:</label>
			<input type="email" id="email" name="email" required>
			
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<!--Error message for login credentials being wrong-->
			<?php
			if (isset($_GET['error'])) {
				echo "<div class='error-message'>" . htmlspecialchars($_GET['error']) . "</div>";
			}
			?>
			<div class="buttons">
				<button type="submit">Login</button>
				<a href="home.html" class="home-button">Home</a>
			</div>
		</form>
		<a href="sign.php">New user ? Create your account here! </a>
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

    <script></script>
</body>
</html>
