<?php
// admin.php
session_start();

// Redirect users who are not admin.
/*if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] != 'admin@admin.com') {
    header('Location: loginpage.php');
    exit();
}*/

include 'php/dbconn.php';

$menuItems = [];

try {
    // Fetch all menu items
    $stmt = $conn->prepare("SELECT id, name, price, category FROM menu_items");
    $stmt->execute();
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
}

// Check if the modify price form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modify_price'])) {
    $newPrice = $_POST['new_price'];
    $productId = $_POST['product_id'];

    // Update the item's price in the database
    $updateQuery = "UPDATE menu_items SET price = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    if ($stmt->execute([$newPrice, $productId])) {
        echo "Price updated successfully!";
    } else {
        echo "Error updating price.";
    }
}

// Generate daily sales report
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['generate_report'])) {
    $selectedDate = $_POST['report_date']; // Fetch the date input from the form
    
    // Generate daily sales report
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['generate_report'])) {
    $selectedDate = $_POST['report_date']; // Fetch the date input from the form
    
    // Define your query to get the sales report for the selected date, grouped by product name and price
    $reportQuery = "
    SELECT product_name, price, SUM(quantity) AS total_quantity, (price * SUM(quantity)) AS total_price_per_item 
    FROM orders 
    WHERE DATE(order_date) = ?
    GROUP BY product_name, price";
    $stmt = $conn->prepare($reportQuery);
    $stmt->execute([$selectedDate]);
    $dailySalesReport = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate the grand total price
    $totalPriceQuery = "SELECT SUM(price * quantity) AS grand_total_price FROM orders WHERE DATE(order_date) = ?";
    $totalPriceStmt = $conn->prepare($totalPriceQuery);
    $totalPriceStmt->execute([$selectedDate]);
    $totalPriceResult = $totalPriceStmt->fetch(PDO::FETCH_ASSOC);
    $grandTotalPrice = $totalPriceResult['grand_total_price'] ?? 0; // Coalesce to 0 if null
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Henry's Burgers</title>
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
    <main class="main-cart">
		<h1>Welcome to Admin Page</h1>
        <section class="modify-price">
            <h2>Modify Item Price</h2>
			<form id="modify-price-form" action="admin.php" method="post">
				<label for="product_selector">Select Product:</label>
				<select id="product_selector" name="product_id" onchange="this.form.submit()" required>
					<option value="">Please select an item</option>
					<?php foreach ($menuItems as $item): ?>
						<option value="<?php echo htmlspecialchars($item['id']); ?>" <?php if (isset($_POST['product_id']) && $_POST['product_id'] == $item['id']) echo 'selected'; ?>>
							<?php echo htmlspecialchars($item['id']) . '-' . htmlspecialchars($item['name']); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</form>

			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
				// Fetch the item details from the database
				$itemId = $_POST['product_id'];
				$query = "SELECT * FROM menu_items WHERE id = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$itemId]);
				$itemDetails = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($itemDetails) {
					// Display the details in a table
					echo '<table class="modify-table">';
					echo '<tr><td>ID</td><td>' . htmlspecialchars($itemDetails['id']) . '</td></tr>';
					echo '<tr><td>Category</td><td>' . htmlspecialchars($itemDetails['category']) . '</td></tr>';
					echo '<tr><td>Name</td><td>' . htmlspecialchars($itemDetails['name']) . '</td></tr>';
					echo '<tr><td>Price</td><td>' . htmlspecialchars($itemDetails['price']) . '</td></tr>';
					// ... other details
					echo '</table>';

					// Display the form to update the price
					echo '<form action="admin.php" method="post">';
					echo '<input type="hidden" name="product_id"  value="'.htmlspecialchars($itemDetails['id']).'">';
					echo '<label for="new_price">New Price : </label>';
					echo '<input type="text" id="new_price" name="new_price" required>';
					echo '<button type="submit" name="modify_price">Update Price</button>';
					echo '</form>';
				}
			}
			?>
        </section>

        <section class="sales-report">
            <h2>Generate Daily Sales Report</h2>
            <form action="admin.php" method="post">
				<label for="report_date">Select Date:</label>
				<input type="date" id="report_date" name="report_date" value="<?php echo isset($_POST['report_date']) ? htmlspecialchars($_POST['report_date']) : ''; ?>" required>
				<button type="submit" name="generate_report">Generate Report</button>
			</form>
            
            <?php if (isset($dailySalesReport) && count($dailySalesReport) > 0): 
				echo '<table class="report-table">
					<tr>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>SubTotal</th>
					</tr>';
					$totalQuan = 0;
					foreach ($dailySalesReport as $reportItem):
						echo '<tr>';
							echo '<td>' .htmlspecialchars($reportItem['product_name']). '</td>';
							echo '<td>' .htmlspecialchars($reportItem['total_quantity']). '</td>';
							echo '<td>$' .htmlspecialchars($reportItem['price']). '</td>';
							echo '<td>$' .htmlspecialchars($reportItem['total_price_per_item']). '</td>';
						echo '</tr>';
					endforeach;
					echo '<tr>';
						echo '<td colspan="3" style="text-align: right;"><strong>Grand Total:</strong></td>';
						echo '<td><strong>$' .htmlspecialchars(number_format((float)$grandTotalPrice, 2, '.', '')).'</strong></td>';
						echo '</tr>';
				echo '</table>';
				else:
				echo '<p>No sales for selected date.</p>';
			endif; ?>
        </section>
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
</body>
</html>
