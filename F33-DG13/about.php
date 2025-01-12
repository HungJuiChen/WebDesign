<?php
// Start the session
session_start();

//navigate to admin page for admin account
if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@admin.com') {
	header('Location: admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Henry's Burgers</title>
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
    <main class = "main-about">
        <div class="about-header">
			<div class="text-header">
				<h1>ABOUT US</h1>
				<h2>🍔 Henry's Burgers 🍔</h2>
			</div>
			<img src="pics/team_photo.png" alt="About Image" class="about-image">
		</div>
        <div class="about-home">
			<p class="about-text">
				<b>Where Legacy Meets Culinary Innovation</b>  <br><br>

<b>Our Origin Story:</b><br><br>
In the heart of Brooklyn in 1957, a passionate young chef named Henry envisioned a place where people could come together, not just to eat, but to connect over food that tells a story. Henry's wasn't just any diner; it was where time-honored recipes were cherished and new ones were born.
<br><br>
<b>The Journey to Nationwide Sensation:</b><br><br>
Henry's relentless pursuit of perfection and his flair for combining tradition with modernity turned one small diner into a household name across the nation. Each branch, while retaining the core essence of Henry's, brings with it a touch of local flavor, celebrating the diversity and unity of our great nation.
<br><br>
<b>Why Henry's Stands Out:</b><br><br>
Every burger at Henry's isn't just a meal; it's a narrative. Our ingredients are meticulously sourced, ensuring the freshest and most ethically-produced elements come together on your plate. Our signature blend of traditional and innovative flavors means every visit is both a walk down memory lane and a new culinary adventure.
<br><br>
<b>Our Commitment to the Future:</b><br><br>
While we take pride in our rich history, we're not just looking backward. At Henry's, we're committed to sustainability, ethical sourcing, and constantly evolving our menu to suit the dynamic tastes of our patrons.
<br><br>

🌟 #RelishTheLegacy at Henry's Burgers 🌟
            </p>
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
    <script src="scripts.js"></script>
</body>
</html>
