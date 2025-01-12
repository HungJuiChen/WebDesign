<?php
session_start();
include 'dbconn.php';

// Check if the user is logged in
if(isset($_SESSION['user_id']) && isset($_POST['item_id'])) {
    $userId = $_SESSION['user_id'];
    $itemId = $_POST['item_id'];

    // Start a transaction
    $conn->beginTransaction();

    try {
        if(isset($_POST['increase'])) {
            $sql = "UPDATE carts SET quantity = quantity + 1 WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$itemId, $userId]);
        } elseif(isset($_POST['decrease'])) {
            // First, get the current quantity to check if it's 1
            $sql = "SELECT quantity FROM carts WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$itemId, $userId]);
            $currentQuantity = $stmt->fetchColumn();
            
            if ($currentQuantity <= 1) {
                // If the quantity is 1, delete the item
                $sql = "DELETE FROM carts WHERE id = ? AND user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$itemId, $userId]);
            } else {
                // If the quantity is more than 1, decrease it
                $sql = "UPDATE carts SET quantity = quantity - 1 WHERE id = ? AND user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$itemId, $userId]);
            }
        } else {
            // Redirect back with an error message if action is not defined
            header('Location: ../cart.php?error=invalid_action');
            exit;
        }

        // Commit the transaction
        $conn->commit();

        // Redirect back to the cart page after updating or deleting
        $itemIndex = $_POST['item_index'] ?? 'top'; // Fallback to 'top' if not set
		header('Location: ../cart.php');
		exit;
    } catch (Exception $e) {
        // An exception has been caught, rollback the transaction
        $conn->rollback();
        // Redirect with an error message
        header('Location: ../cart.php?error=exception');
        exit;
    }
} else {
    // Redirect back with an error message if user_id or item_id is not set
    header('Location: ../cart.php?error=invalid_request');
    exit;
}
?>