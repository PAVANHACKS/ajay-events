<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$username = $_SESSION['username'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);

// Basic validation
if (empty($name) || empty($email)) {
    echo "<script>alert('❌ Name and Email cannot be empty!'); window.history.back();</script>";
    exit;
}

// Update in DB
$stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE username = ?");
$stmt->bind_param("sss", $name, $email, $username);

if ($stmt->execute()) {
    $_SESSION['name'] = $name; // Update session name
    echo "<script>alert('✅ Profile updated successfully!'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('❌ Failed to update profile. Try again.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
