<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.html");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Cancel Booking</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ✅ Navbar -->
<div class="navbar">
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="view_events.php">📅 View Events</a>
  <a href="my_bookings.php">📋 My Bookings</a>
  <a href="logout.php">🚪 Logout</a>
</div>

<div class="container">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_SESSION['username'];
  $event_id = $_POST['event_id'];

  $stmt = $conn->prepare("DELETE FROM bookings WHERE username = ? AND event_id = ?");
  $stmt->bind_param("si", $username, $event_id);

  if ($stmt->execute()) {
    echo "<div class='status-success'>✅ Booking canceled successfully!</div>";
  } else {
    echo "<div class='status-error'>❌ Failed to cancel booking: " . $stmt->error . "</div>";
  }

  $stmt->close();
  $conn->close();
}
?>
  <a href="my_bookings.php">← Back to My Bookings</a>
</div>

</body>
</html>
