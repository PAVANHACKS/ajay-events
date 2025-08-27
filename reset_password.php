<?php
// reset_password.php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $identifier = $_POST['user_identifier'];

  // Check if user exists
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
  $stmt->bind_param("ss", $identifier, $identifier);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $_SESSION['reset_user'] = $identifier;
  } else {
    echo "<p style='color:red;'>❌ User not found.</p>";
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Reset Password</h2>
  <form action="update_password.php" method="POST" class="form-vertical">
    <label>New Password</label>
    <input type="password" name="new_password" required />
    <button type="submit">Update Password</button>
  </form>
</body>
</html>
