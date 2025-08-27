<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$username = $_SESSION['username'];
$current = $_POST['current_password'];
$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

// Validate new password
if ($new !== $confirm) {
    echo "<script>alert('❌ New passwords do not match.'); window.history.back();</script>";
    exit;
}

// Fetch current password from DB
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "<script>alert('❌ User not found.'); window.history.back();</script>";
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($current, $user['password'])) {
    echo "<script>alert('❌ Current password is incorrect.'); window.history.back();</script>";
    exit;
}

// Hash and update new password
$hashed = password_hash($new, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
stmt->bind_param("ss", $hashed, $username);
$stmt->execute();

echo "<script>alert('✅ Password changed successfully!'); window.location.href='dashboard.php';</script>";

$stmt->close();
$conn->close();
?>
