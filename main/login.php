<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TaskMaster Pro - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
  font-family: 'Inter', sans-serif;
  background: 
    linear-gradient(135deg, #23242b 0%, #127b8e 50%, #1f1f2b 100%),
    radial-gradient(circle at 20% 30%, rgba(18, 123, 142, 0.3), transparent 60%),
    radial-gradient(circle at 80% 70%, rgba(31, 31, 43, 0.3), transparent 60%);
  background-color: #1f1f2b; /* fallback color */
  background-blend-mode: overlay;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 1rem;
  color: #333;
}


    .login-container {
      backdrop-filter: blur(10px) saturate(180%);
      -webkit-backdrop-filter: blur(10px) saturate(180%);
      background-color: rgba(255, 255, 255, 0.85);
      border-radius: 12px;
      border: 1px solid rgba(209, 213, 219, 0.3);
      width: 100%;
      max-width: 28rem;
      padding: 2rem;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .login-container > * + * {
      margin-top: 1.5rem;
    }

    .login-container .form-header + form {
      margin-top: 1.5rem;
    }

    .form-header {
      text-align: center;
    }

    .form-header svg {
      width: 4rem;
      height: 4rem;
      margin-left: auto;
      margin-right: auto;
      color: #008793;
    }

    .form-header h1 {
      font-size: 1.875rem;
      font-weight: 700;
      color: #1f2937;
      margin-top: 0.5rem;
    }

    .form-header p {
      color: #4b5563;
      font-size: 0.9rem;
    }

    #loginForm > div + div {
      margin-top: 1.5rem;
    }

    label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.25rem;
    }

    input[type="text"],
    input[type="password"] {
      margin-top: 0.25rem;
      display: block;
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #d1d5db;
      border-radius: 0.5rem;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      font-size: 0.875rem;
      line-height: 1.25rem;
    }

    input[type="text"]::placeholder,
    input[type="password"]::placeholder {
      color: #9ca3af;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      outline: none;
      border-color: #008793;
      box-shadow: 0 0 0 3px rgba(0, 135, 147, 0.3);
    }

    .form-options {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 0.875rem;
    }

    .remember-me {
      display: flex;
      align-items: center;
    }

    input[type="checkbox"] {
      height: 1rem;
      width: 1rem;
      border-radius: 0.25rem;
      border: 1px solid #d1d5db;
      color: #008793;
    }

    input[type="checkbox"]:focus {
      box-shadow: 0 0 0 3px rgba(0, 135, 147, 0.3);
    }

    .remember-me label {
      margin-left: 0.5rem;
      color: #111827;
      font-weight: normal;
      margin-bottom: 0;
    }

    .btn-primary {
      display: flex;
      justify-content: center;
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid transparent;
      border-radius: 0.5rem;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      font-size: 0.875rem;
      font-weight: 500;
      color: white;
      background-image: linear-gradient(to right, #008793, #00bf72);
      cursor: pointer;
      transition: background-image 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-primary:hover {
      background-image: linear-gradient(to right, #00bf72, #008793);
    }

    .btn-primary:focus {
      outline: none;
      box-shadow: 0 0 0 2px white, 0 0 0 4px #008793;
    }

    .footer-text {
      font-size: 0.75rem;
      text-align: center;
      color: #6b7280;
      margin-top: 1.5rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="form-header">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <h1>TASK FLOW</h1>
    </div>

    <form id="loginForm" method="POST" action="app/login.php">
      <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
      <?php } ?>

      <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success" role="alert">
          <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
      <?php } ?>

      <div>
        <label for="username">Username</label>
        <input type="text" name="user_name" id="username" required placeholder="Enter your username" />
      </div>

      <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required placeholder="Enter your password" />
      </div>

      <div class="form-options">
        <div class="remember-me">
          <input id="remember_me" name="remember_me" type="checkbox" />
          <label for="remember_me">Remember me</label>
        </div>
      </div>

      <div>
        <button type="submit" class="btn-primary">Sign in</button>
      </div>
    </form>

    <p class="footer-text">
      &copy; 2025 TaskMaster Pro. All rights reserved.
    </p>
  </div>
</body>
</html>
