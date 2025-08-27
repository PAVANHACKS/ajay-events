<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    $file = $_FILES['profile_image'];
    $targetDir = "uploads/";
    $fileName = basename($file["name"]);
    $targetFile = $targetDir . uniqid() . "_" . $fileName;

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate file type
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "<script>alert('❌ Only JPG, JPEG, PNG, and GIF files allowed.'); window.history.back();</script>";
        exit;
    }

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Save filename to DB
        $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE username = ?");
        $stmt->bind_param("ss", $targetFile, $username);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        echo "<script>alert('✅ Profile image updated successfully!'); window.location.href='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Failed to upload image.'); window.history.back();</script>";
    }
}
?>
