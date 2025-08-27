<?php
// update_password.php
session_start();
include 'config.php';

if (!isset($_SESSION['reset_user'])) {
  echo "❌ Unauthorized access.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_SESSION['reset_user'];
  $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ? OR email = ?");
  $stmt->bind_param("sss", $new_password, $username, $username);

  if ($stmt->execute()) {
    session_destroy();
    header("Location: reset_success.html");
    exit;
  } else {
    echo "❌ Failed to update password.";
  }
}
?>
