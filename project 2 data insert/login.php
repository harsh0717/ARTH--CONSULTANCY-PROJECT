<?php
session_start();

// --- Retrieve flash messages & previously entered username -----------------
$flashError   = $_SESSION['flash_error']   ?? '';
$flashSuccess = $_SESSION['flash_success'] ?? '';
$oldUser      = $_SESSION['old_user_name'] ?? '';

unset($_SESSION['flash_error'], $_SESSION['flash_success'], $_SESSION['old_user_name']);
?>
<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
  <link rel="shortcut icon" href="logo.png" type="image/x-icon">
  <meta charset="utf-8" />
  <title>Task Flow | Login Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />

  <!-- Third-party plugins -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />

  <!-- AdminLTE core css -->
  <link rel="stylesheet" href="css/adminlte.css" />

  <!-- Full-screen loader style -->
  <style>
    #pageLoader {
      position: fixed;
      inset: 0;
      background: rgba(255,255,255,.8);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1055; /* above everything inc. bootstrap modals */
    }
  </style>
</head>
<!--end::Head-->

<!--begin::Body-->
<body class="login-page bg-body-secondary">
  <!-- full-page loader (initially hidden via d-none) -->
  

  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="login.php" class="link-dark link-offset-2 link-opacity-100 link-opacity-50-hover">
          <h1 class="mb-0"><b>TASK</b>FLOW</h1>
        </a>
      </div>

      <div class="card-body login-card-body">
        <p class="login-box-msg">Log in to start your session</p>

        <!-- Flash messages -->
        <?php if ($flashError): ?>
        <div class="alert alert-danger" role="alert">
          <?= htmlspecialchars($flashError) ?>
        </div>
        <?php endif; ?>

        <?php if ($flashSuccess): ?>
        <div class="alert alert-success" role="alert">
          <?= htmlspecialchars($flashSuccess) ?>
        </div>
        <?php endif; ?>

        <!-- Login form -->
        <form action="app/login.php" method="post" novalidate>
          <div class="input-group mb-1">
            <div class="form-floating flex-grow-1">
              <input id="loginUser" name="user_name" type="text" class="form-control" placeholder=" " value="<?= htmlspecialchars($oldUser) ?>" required>
              <label for="loginUser">User Name</label>
            </div>
            <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
          </div>

          <div class="input-group mb-1">
            <div class="form-floating flex-grow-1">
              <input id="loginPass" name="password" type="password" class="form-control" placeholder=" " required>
              <label for="loginPass">Password</label>
            </div>
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          </div>

          <div class="d-grid gap-2 mt-3 position-relative">
            <button id="loginButton" type="submit" class="btn btn-primary">
              <span id="loginSpinner" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
              <span id="loginButtonText">Login</span>
            </button>
          </div>
        </form>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="adminlte.js"></script>

  <!-- Optional: OverlayScrollbars init -->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const osDefault = { scrollbarTheme: 'os-theme-light', scrollbarAutoHide: 'leave', scrollbarClickScroll: true };
    document.addEventListener('DOMContentLoaded', () => {
      const target = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (target && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(target, { scrollbars: osDefault });
      }
    });
  </script>

  <!-- Spinner + full-page loader logic -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const form       = document.querySelector('form');
      const btn        = document.getElementById('loginButton');
      const spinnerBtn = document.getElementById('loginSpinner');
      const btnText    = document.getElementById('loginButtonText');
      const pageLoader = document.getElementById('pageLoader');

      form.addEventListener('submit', () => {
        // Button-level feedback
        btn.disabled = true;
        spinnerBtn.classList.remove('d-none');
        btnText.textContent = 'Logging in...';

        // Page-level overlay
        pageLoader.classList.remove('d-none');
      });
    });
  </script>
</body>
<!--end::Body-->
</html>