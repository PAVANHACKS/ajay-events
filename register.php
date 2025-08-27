<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// ✅ Show navbar only if user is logged in
if (isset($_SESSION['user_id'])) {
  echo '
  <div class="navbar">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="view_events.php">📅 View Events</a>
    <a href="my_bookings.php">📋 My Bookings</a>
    <a href="logout.php">🚪 Logout</a>
  </div>';
}
?>

<?php
if (isset($_POST['send_otp'])) {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $mobile   = trim($_POST['mobile']);

    // ✅ Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='status-error'>❌ Invalid email format.</div>";
        exit;
    }

    // ✅ Password validation
    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[@$!%*?#&]/', $password)) {
        echo "<div class='status-error'>❌ Password must be at least 8 characters with uppercase, lowercase, number, and special character.</div>";
        exit;
    }

    // ✅ Mobile validation
    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        echo "<div class='status-error'>❌ Invalid mobile number. Must start with 6-9 and be 10 digits.</div>";
        exit;
    }

    // ✅ Check if username exists
    $checkUser = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $checkUser->store_result();

    if ($checkUser->num_rows > 0) {
        echo "<div class='status-error'>❌ Username already exists. Please choose another.</div>";
        exit;
    }
    $checkUser->close();

    // ✅ Generate OTP
    $otp = rand(100000, 999999);

    // ✅ Fast2SMS API Setup
    $fields = array(
        "sender_id" => "FSTSMS",
        "message" => "Your OTP for Ajay Events is $otp",
        "language" => "english",
        "route" => "p",
        "numbers" => $mobile,
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => array(
            "authorization: LykY3dnojRm7ZJUHlbGfuM4ShEQFC0qABXgiI8wxp2Kz9TNPaV3hWsz20IfkabJDBx1ZVG5RLul8jp7t",
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "<div class='status-error'>❌ OTP sending failed: $err</div>";
        exit;
    } else {
        // ✅ Save user details & OTP to session
        $_SESSION['otp'] = $otp;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['mobile'] = $mobile;

        echo "<div class='status-success'>✅ OTP sent successfully to <b>$mobile</b></div>";
        echo '<form method="POST" action="verify_otp.php" class="form-vertical" style="max-width:400px; margin:20px auto;">
                <label>Enter OTP</label>
                <input type="text" name="entered_otp" placeholder="Enter OTP" required />
                <button type="submit" name="verify_otp">Verify OTP</button>
              </form>';
    }
}
?>


</body>
</html>
