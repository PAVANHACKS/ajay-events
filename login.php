<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Secure prepared statement
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Store session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];

            // ✅ Redirect immediately to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ No user found with that username.";
    }

    $stmt->close();
    $conn->close();
} else {
    $error = "⚠️ Invalid Request Method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Ajay Events - Login</title>
  <link rel="stylesheet" href="style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
  <?php if (isset($error)) { ?>
      <div class="status-error"><?= $error ?></div>
      <a href="login.html">← Back to Login</a>
  <?php } ?>
</div>
</body>
</html>
