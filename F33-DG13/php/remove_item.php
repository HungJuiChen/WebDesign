<?php
session_start();
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $item_id = $_POST['item_id'];

  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("DELETE FROM carts WHERE id = ? AND user_id = ?");
    $stmt->execute([$item_id, $user_id]);
  }

  header('Location: ../cart.php');
  exit();
}
?>
