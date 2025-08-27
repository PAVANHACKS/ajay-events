<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
  echo "<script>window.location.href='login.html';</script>";
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>Book Event</title>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_SESSION['username'];
  $event_id = $_POST['event_id'];

  // Optional: Prevent duplicate booking
  $check = $conn->prepare("SELECT * FROM bookings WHERE username = ? AND event_id = ?");
  $check->bind_param("si", $username, $event_id);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    echo "<div class='status-error'>❌ You have already booked this event.</div>";
  } else {
    $stmt = $conn->prepare("INSERT INTO bookings (username, event_id) VALUES (?, ?)");
    $stmt->bind_param("si", $username, $event_id);

    if ($stmt->execute()) {
      echo "<div class='status-success'>✅ Event booked successfully!</div>";
    } else {
      echo "<div class='status-error'>❌ Booking failed: " . $stmt->error . "</div>";
    }

    $stmt->close();
  }

  $check->close();
  $conn->close();
}
?>

<br>
<a href="view_events.php">← Back to Events</a>

</body>
</html>
