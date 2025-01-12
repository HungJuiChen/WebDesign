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
	<main>
        <div class="registration-form">
			<h2>Account Registration</h2>
			<form action="php/register.php" method="post" onsubmit="return validateForm();">
                <!-- Name input -->
				<label for="name">Name :</label>
				<input type="text" id="name" name="name" required>
				<span id="nameError" class="error-text"></span>

				<!-- Email input -->
				<label for="email">Email Address :</label>
				<input type="email" id="email" name="email" required>
				<span id="emailError" class="error-text"></span>

				<!-- Password input -->
				<label for="password">Password :</label>
				<input type="password" id="password" name="password" required>
				<span id="passwordError" class="error-text"></span>
				
				<!-- Re-enter Password input -->
				<label for="confirm_password">Re-enter Password:</label>
				<input type="password" id="confirm_password" name="confirm_password" required>
				<span id="confirmPasswordError" class="error-text"></span>

				<!-- Contact input -->
				<label for="contact">Contact Number :</label>
				<input type="tel" id="contact" name="contact" required>
				<span id="contactError" class="error-text"></span>

				<!-- Address input -->
				<label for="address">Address :</label>
				<input type="text" id="address" name="address" required>
				<span id="addressError" class="error-text"></span>
				
				<div class="buttons">
					<button type="submit">Create</button>
					<a href="home.php" class="home-button">Home</a>
				</div>
			</form>
        </div>
    </main>
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
	<script src="js/registervalid.js"></script>
</body>
</html>
