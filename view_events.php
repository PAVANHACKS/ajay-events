



<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.html");
  exit;
}

include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Available Events</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="navbar">
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="view_events.php">📅 View Events</a>
  <a href="my_bookings.php">📋 My Bookings</a>
  <a href="logout.php">🚪 Logout</a>
</div>

  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
  <h3>Upcoming Events</h3>

  <?php
  $sql = "SELECT * FROM events ORDER BY event_date ASC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
      echo "<li>
              <strong>{$row['title']}</strong><br>
              Date: {$row['event_date']}<br>
              Location: {$row['location']}<br>
              Description: {$row['description']}<br>
              <form action='book_event.php' method='POST'>
                <input type='hidden' name='event_id' value='{$row['id']}'>
                <button type='submit'>Book Event</button>
              </form>
              <hr>
            </li>";
    }
    echo "</ul>";
  } else {
    echo "No events available.";
  }

  $conn->close();
  ?>

  <a href="dashboard.php">🏠 Dashboard</a> |
<a href="my_bookings.php">📋 My Bookings</a> |
<a href="logout.php">🚪 Logout</a>

</body>
</html>
