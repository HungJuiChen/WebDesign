<?php
session_start();

include 'php/dbconn.php';

//navigate to admin page for admin account
if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@admin.com') {
	header('Location: admin.php');
}

// Fetch user details using user ID
$user_id = $_SESSION['user_id'];

// Handle form submission to edit user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedName = $_POST['Name'];
    $updatedContact = $_POST['Contact'];
    $updatedAddress = $_POST['Address'];

    // Prepare SQL to update user details
    $sql = "UPDATE user_details SET name = :name, contact = :contact, address = :address WHERE id = :user_id";
    $stmt = $conn->prepare($sql);

    // Bind values
    $stmt->bindParam(':name', $updatedName);
    $stmt->bindParam(':contact', $updatedContact);
    $stmt->bindParam(':address', $updatedAddress);
    $stmt->bindParam(':user_id', $user_id);

    // Execute and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Details Updated Successfully!');</script>";
    } else {
        echo "<script>alert('Error updating details. Please try again later.');</script>";
    }
}

$query = "SELECT name, contact, address FROM user_details WHERE id = :user_id";
$stmt = $conn->prepare($query);

if (!$stmt->execute([':user_id' => $user_id])) {
    print_r($stmt->errorInfo());
    exit();
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if $user is an array and contains the necessary keys
$userName = isset($user['name']) ? $user['name'] : '';
$userContact = isset($user['contact']) ? $user['contact'] : '';
$userAddress = isset($user['address']) ? $user['address'] : '';

$_SESSION['user_name'] = $userName;
?>
<!-- Rest of the HTML remains the same till the header section -->

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
    <nav>
        <a href="home.php">HOME</a>
        <a href="menu.php">MENU</a>
        <a href="about.php">ABOUT</a>
        <a href="cart.php">CART</a>
    </nav>
    <div class="profile-container">
    <h2>USER'S DETAILS</h2>
		<form action="profile.php" method="post" onsubmit="return validateForm()" class="profile-form">
			<div class="input-group">
				<label for="Name">Name :</label>
				<input type="text" id="UserName" name="Name" value="<?php echo htmlspecialchars($userName); ?>" required readonly>
				<span id="nameError" class="error-text"></span>
			</div>

			<div class="input-group">
				<label for="Contact">Contact :</label>
				<input type="text" id="UserContact" name="Contact" value="<?php echo htmlspecialchars($userContact); ?>" required readonly>
				<span id="contactError" class="error-text"></span>
			</div>

			<div class="input-group">
				<label for="Address">Address :</label>
				<input type="text" id="UserAddress" name="Address" value="<?php echo htmlspecialchars($userAddress); ?>" required readonly>
				<span id="addressError" class="error-text"></span>
			</div>

			<div class="buttons">
				<button type="button" id="editButton">Edit</button>
				<button type="submit" id="submitButton" style="display:none;">Save Changes</button>
				<button type="button" id="cancelButton" style="display:none;">Cancel</button>
				<a href="orderhistory.php" class="order-history-button">Order History</a>
				<a href="home.php" class="home-button">Home</a>
			</div>
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

    <script src="js/profilevalid.js"></script>
	<script src="js/editprofile.js"></script>
</body>
</html>
