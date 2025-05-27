<?php
session_start();
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $conn = new mysqli('localhost', 'root', '1234', 'taskflow');
  $email = $_POST['email'];
  $password = $_POST['password'];
  $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user;
    header("Location: dashboard.php");
  } else {
    $error = "Invalid credentials";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Employee Task Tracking System</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
    <div class="logo">TaskFlow</div>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="contact.html">Contact</a>
      <a href="login.php">Login</a>
    </nav>
  </header>
    
    <main>
        <h1>Login</h1>
  <form method="POST">
    Email: <input type="text" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
    <p style="color:red;"> <?php echo $error; ?> </p>
  </form>
    </main>

  <footer>
    <p>&copy; 2025 TaskFlow Inc.</p>
  </footer>
</body>
</html>