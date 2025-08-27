<!-- forgot_password.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Forgot Password</h2>
  <form action="reset_password.php" method="POST" class="form-vertical">
    <label>Enter your username or email:</label>
    <input type="text" name="user_identifier" placeholder="Username or Email" required />
    <button type="submit">Submit</button>
  </form>
</body>
</html>
