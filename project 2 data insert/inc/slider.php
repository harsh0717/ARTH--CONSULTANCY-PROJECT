<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="logo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">TASK FLOW</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <?php if ($_SESSION['role'] == 'admin') { ?>
              <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                  <p>
                    <a href="index.php" class="nav-link active"><i class="nav-icon bi bi-speedometer"></i>Dashboard</a>
                  </p>
                </li>
                <li class="nav-item menu-open">
                  <p>
                    <a href="user.php" class="nav-link active"><i class="nav-icon bi bi-people"></i>Manage Users</a>
                  </p>
                </li>
                <li class="nav-item menu-open">
                  <p>
                    <a href="create_task.php" class="nav-link active"><i class="nav-icon bi bi-file-earmark-plus"></i></i>Create Task</a>
                  </p>
                </li>
                <li class="nav-item menu-open">
                  <p>
                    <a href="tasks.php" class="nav-link active"><i class="nav-icon bi bi-file-text"></i>All Task</a>
                  </p>
                </li>
                <li class="nav-item">
                  <a href="logout.php" class="nav-link">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <p>Logout</p>
                  </a>
                </li>
              </ul>
            <?php } else { ?>
              <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                  <p>
                    <a href="index.php" class="nav-link active"><i class="nav-icon bi bi-speedometer"></i>Dashboard</a>
                  </p>
                </li>
                <li class="nav-item menu-open">
                  <p>
                    <a href="index.php" class="nav-link active"><i class="nav-icon bi bi-card-checklist"></i>MY TASK</a>
                  </p>
                </li>
                <li class="nav-item menu-open">
                  <p>
                    <a href="index.php" class="nav-link active"><i class="nav-icon bi bi-person"></i></i>PROFILE</a>
                  </p>
                </li>
                <li class="nav-item menu-open">
                  <p>
                    <a href="logout.php" class="nav-link active"><i class="nav-icon bi bi-box-arrow-right"></i>LOGOUT</a>
                  </p>
                </li>
              </ul>
            <?php } ?>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>