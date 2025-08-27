<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.html");
  exit;
}

$username = $_SESSION['username'];

$sql = "SELECT b.booking_time, e.title, e.event_date, e.location, e.description, b.event_id
        FROM bookings b
        JOIN events e ON b.event_id = e.id
        WHERE b.username = ?
        ORDER BY b.booking_time DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>My Bookings</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="navbar">
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="view_events.php">📅 View Events</a>
  <a href="my_bookings.php">📋 My Bookings</a>
  <a href="logout.php">🚪 Logout</a>
</div>

  <h2>My Bookings (<?php echo htmlspecialchars($username); ?>)</h2>

  <?php
  if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
      echo "<li>
              <strong>{$row['title']}</strong><br>
              Date: {$row['event_date']}<br>
              Location: {$row['location']}<br>
              Description: {$row['description']}<br>
              Booked on: {$row['booking_time']}<br>
              <form action='cancel_booking.php' method='POST' onsubmit='return confirm(\"Are you sure you want to cancel this booking?\");'>
                <input type='hidden' name='event_id' value='{$row['event_id']}'>
                <button type='submit'>Cancel Booking</button>
              </form>
              <hr>
            </li>";
    }
    echo "</ul>";
  } else {
    echo "You haven’t booked any events yet.";
  }

  $stmt->close();
  $conn->close();
  ?>

  <a href="view_events.php">← View Events</a> |
  <a href="dashboard.php">Dashboard</a> |
  <a href="logout.php">Logout</a>
</body>
</html>
