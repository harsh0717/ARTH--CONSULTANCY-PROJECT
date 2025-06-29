<nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="index.php" class="nav-link">Dashboard</a></li>
            <li class="nav-item d-none d-md-block"><a href="user.php" class="nav-link">Manage Users</a></li>
            <li class="nav-item d-none d-md-block"><a href="create_task.php" class="nav-link">Create Task</a></li>
            <li class="nav-item d-none d-md-block"><a href="tasks.php" class="nav-link">All Task</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            
            

            <!--begin::Theme Switcher Dropdown-->
            <li class="nav-item dropdown">
              <button
                class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                data-bs-display="static">
                <span class="theme-icon-active">
                  <i class="bi bi-circle-half my-1"></i>
                </span>
                <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
              </button>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="bd-theme-text"
                style="--bs-dropdown-min-width: 8rem;">
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="light">
                    <i class="bi bi-sun-fill me-2"></i>
                    Light
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="dark">
                    <i class="bi bi-moon-fill me-2"></i>
                    Dark
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center active"
                    data-bs-theme-value="auto">
                    <i class="bi bi-circle-half me-2"></i>
                    Auto
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
              </ul>
            </li>
            <!--end::Theme Switcher Dropdown-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="user.png"
                  class="user-image rounded-circle shadow"
                  alt="User Image" />
                <span class="d-none d-md-inline"><?=$_SESSION['username']?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header text-bg-primary">
                  <img
                    src="../../dist/assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image" />
                  <p>
                   <?=$_SESSION['username']?> - Web Developer
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <li class="user-body">
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                  </div>
                </li>
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="logout.php" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>

          <!--end::End Navbar Links-->

        </div>
        <!--end::Container-->
      </nav>