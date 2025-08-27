<?php
session_start();
include 'config.php';

if (isset($_POST['verify_otp'])) {
    $entered_otp = trim($_POST['entered_otp']);

    if ($entered_otp == $_SESSION['otp']) {
        // Fetch stored session data
        $name     = $_SESSION['name'];
        $email    = $_SESSION['email'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $mobile   = $_SESSION['mobile'];

        // Insert into database
        $sql = "INSERT INTO users (name, email, username, password, mobile) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $username, $password, $mobile);

        if ($stmt->execute()) {
            // ✅ Set username in session to use in dashboard
            $_SESSION['username'] = $username;

            // ✅ Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<div style='color:red; text-align:center;'>❌ Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
        $conn->close();

        // ❌ Don't destroy session here – we need it for dashboard.php
        // session_destroy(); // <- REMOVE THIS
    } else {
        echo "<div style='color:red; text-align:center; margin-top:50px; font-family:sans-serif;'>
                ❌ Incorrect OTP. Please go back and try again.
              </div>";
    }
} else {
    echo "<div style='color:red; text-align:center;'>❌ Unauthorized access.</div>";
}
?>
