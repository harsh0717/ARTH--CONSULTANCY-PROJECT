<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
  include "DB_connection.php";
  include "app/model/Task.php";
  include "app/model/User.php";
  if ($_SESSION['role'] == "admin") {
    $todaydue_task = count_tasks_due_today($conn);
    $overdue_task = count_tasks_overdue($conn);
    $no_deadline_task = count_tasks_NoDeadline($conn);
    $num_task = count_tasks($conn);
    $num_users = count_users($conn);
    $pending = count_pending_tasks($conn);
    $in_progress = count_in_progress_tasks($conn);
    $completed = count_completed_tasks($conn);
  } else {
    $num_my_task = count_my_tasks($conn, $_SESSION['id']);
    $overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
    $nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
    $pending = count_my_pending_tasks($conn, $_SESSION['id']);
    $in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
    $completed = count_my_completed_tasks($conn, $_SESSION['id']);
  }

?>
  <!doctype html>
  <html lang="en">
  <!--begin::Head-->

  <head>
    <!-- inside <head> -->
    <link rel="icon" href="logo.png" type="image/png" sizes="32x32">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Task Flow | Dashboard</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous" />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous" />
  </head>
  <!--end::Head-->
  <!--begin::Body-->

  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->



      <!-- this -->
      <?php include "inc/nav.php"; ?>
      <!--end::Header-->
      <!--begin::Sidebar-->


      <!-- THIS -->
      <?php include "inc/slider.php"; ?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->

            <!-- this -->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Dashboard</h3>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->

            <?php if ($_SESSION['role'] == "admin") { ?>
              <div class="row">
                <!--begin::Col-->
                <div class="col-lg-3 col-6">
                  <!--begin::Small Box Widget 1-->
                  <div class="small-box text-bg-primary">
                    <div class="inner">
                      <h3><?= $num_users ?></h3>
                      <p>Users</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 640 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z"></path>
                    </svg>

                  </div>
                  <div class="small-box text-bg-primary">
                    <div class="inner">
                      <h3><?= $todaydue_task ?></h3>
                      <p>Due Today</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M448 160l-128 0 0-32 128 0 0 32zM48 64C21.5 64 0 85.5 0 112l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 64zM448 352l0 32-256 0 0-32 256 0zM48 288c-26.5 0-48 21.5-48 48l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 288z"></path>
                    </svg>
                  </div>
                  <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                  <!--begin::Small Box Widget 2-->
                  <div class="small-box text-bg-success">
                    <div class="inner">
                      <h3><?= $num_task ?></h3>
                      <p>All task</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M448 160l-128 0 0-32 128 0 0 32zM48 64C21.5 64 0 85.5 0 112l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 64zM448 352l0 32-256 0 0-32 256 0zM48 288c-26.5 0-48 21.5-48 48l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 288z"></path>
                    </svg>
                  </div>
                  <div class="small-box text-bg-success">
                    <div class="inner">
                      <h3><?= $pending ?></h3>
                      <p>Pending</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 384 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64l0 11c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437l0 11c-17.7 0-32 14.3-32 32s14.3 32 32 32l32 0 256 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-11c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1l0-11c17.7 0 32-14.3 32-32s-14.3-32-32-32L320 0 64 0 32 0zM96 75l0-11 192 0 0 11c0 19-5.6 37.4-16 53L112 128c-10.3-15.6-16-34-16-53zm16 309c3.5-5.3 7.6-10.3 12.1-14.9L192 301.3l67.9 67.9c4.6 4.6 8.6 9.6 12.1 14.9L112 384z"></path>
                    </svg>
                  </div>
                  <!--end::Small Box Widget 2-->
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                  <!--begin::Small Box Widget 3-->
                  <div class="small-box text-bg-warning">
                    <div class="inner">
                      <h3><?= $overdue_task ?></h3>
                      <p>Overdue</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"></path>
                    </svg>
                  </div>
                  <div class="small-box text-bg-warning">
                    <div class="inner">
                      <h3><?= $in_progress ?></h3>
                      <p>In progress</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z"></path>
                    </svg>

                  </div>
                  <!--end::Small Box Widget 3-->
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                  <!--begin::Small Box Widget 4-->
                  <div class="small-box text-bg-danger">
                    <div class="inner">
                      <h3><?= $no_deadline_task ?></h3>
                      <p> No Deadline</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        clip-rule="evenodd"
                        fill-rule="evenodd"
                        d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"></path>
                    </svg>
                  </div>
                  <div class="small-box text-bg-danger">
                    <div class="inner">
                      <h3><?= $completed ?></h3>
                      <p>Completed</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 448 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"></path>
                    </svg>
                  </div>
                  <!--end::Small Box Widget 4-->
                </div>
                <!--end::Col-->
              </div>
            <?php } else { ?>
              <div class="row">
                <!--begin::Col-->
                <div class="col-lg-4 col-6">
                  <!--begin::Small Box Widget 1-->
                  <div class="small-box text-bg-primary">
                    <div class="inner">
                      <h3><?= $num_my_task ?></h3>
                      <p>My task</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M448 160l-128 0 0-32 128 0 0 32zM48 64C21.5 64 0 85.5 0 112l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 64zM448 352l0 32-256 0 0-32 256 0zM48 288c-26.5 0-48 21.5-48 48l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 288z"></path>
                    </svg>

                  </div>
                  <div class="small-box text-bg-primary">
                    <div class="inner">
                      <h3><?= $overdue_task ?></h3>
                      <p>Overdue</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"></path>
                    </svg>
                  </div>
                  <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
                <div class="col-lg-4 col-6">
                  <!--begin::Small Box Widget 2-->
                  <div class="small-box text-bg-success">
                    <div class="inner">
                      <h3><?= $nodeadline_task ?></h3>
                      <p>No Deadline</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"></path>
                    </svg>
                  </div>
                  <div class="small-box text-bg-success">
                    <div class="inner">
                      <h3><?= $pending ?></h3>
                      <p>Pending</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 384 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64l0 11c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437l0 11c-17.7 0-32 14.3-32 32s14.3 32 32 32l32 0 256 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-11c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1l0-11c17.7 0 32-14.3 32-32s-14.3-32-32-32L320 0 64 0 32 0zM96 75l0-11 192 0 0 11c0 19-5.6 37.4-16 53L112 128c-10.3-15.6-16-34-16-53zm16 309c3.5-5.3 7.6-10.3 12.1-14.9L192 301.3l67.9 67.9c4.6 4.6 8.6 9.6 12.1 14.9L112 384z"></path>
                    </svg>
                  </div>
                  <!--end::Small Box Widget 2-->
                </div>
                <!--end::Col-->
                <div class="col-lg-4 col-6">
                  <!--begin::Small Box Widget 3-->
                  <div class="small-box text-bg-warning">
                    <div class="inner">
                      <h3><?= $in_progress ?></h3>
                      <p>In progress</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z"></path>
                    </svg>
                  </div>
                  <div class="small-box text-bg-warning">
                    <div class="inner">
                      <h3><?= $completed ?></h3>
                      <p>Completed</p>
                    </div>
                    <svg
                      class="small-box-icon"
                      fill="currentColor"
                      viewBox="0 0 448 512"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true">
                      <path
                        d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"></path>
                    </svg>

                  </div>
                  <!--end::Small Box Widget 3-->
                </div>
                <!--end::Col-->

              </div>
            <?php } ?>
            <!--end::Row-->
            <!--begin::Row-->

            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2025&nbsp;
          <a href="index.php" class="text-decoration-none">TASK FLOW</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ="
      crossorigin="anonymous"></script>
    <!-- sortablejs -->
    <script>
      const connectedSortables = document.querySelectorAll('.connectedSortable');
      connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
          group: 'shared',
          handle: '.card-header',
        });
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      const sales_chart_options = {
        series: [{
            name: 'Digital Goods',
            data: [28, 48, 40, 19, 86, 27, 90],
          },
          {
            name: 'Electronics',
            data: [65, 59, 80, 81, 56, 55, 40],
          },
        ],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2023-01-01',
            '2023-02-01',
            '2023-03-01',
            '2023-04-01',
            '2023-05-01',
            '2023-06-01',
            '2023-07-01',
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
    <!-- jsvectormap -->
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
      integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
      crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
      integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
      crossorigin="anonymous"></script>
    <!-- jsvectormap -->
    <script>
      const visitorsData = {
        US: 398, // USA
        SA: 400, // Saudi Arabia
        CA: 1000, // Canada
        DE: 500, // Germany
        FR: 760, // France
        CN: 300, // China
        AU: 700, // Australia
        BR: 600, // Brazil
        IN: 800, // India
        GB: 320, // Great Britain
        RU: 3000, // Russia
      };

      // World map by jsVectorMap
      const map = new jsVectorMap({
        selector: '#world-map',
        map: 'world',
      });

      // Sparkline charts
      const option_sparkline1 = {
        series: [{
          data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
        }, ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
      sparkline1.render();

      const option_sparkline2 = {
        series: [{
          data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
        }, ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
      sparkline2.render();

      const option_sparkline3 = {
        series: [{
          data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
        }, ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
      sparkline3.render();
    </script>
    <script>
      (() => {
        const storedTheme = localStorage.getItem('theme');

        const getPreferredTheme = () => {
          if (storedTheme) {
            return storedTheme;
          }
          return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        const setTheme = function(theme) {
          if (theme === 'auto') {
            document.documentElement.removeAttribute('data-bs-theme');
          } else {
            document.documentElement.setAttribute('data-bs-theme', theme);
          }
        };

        setTheme(getPreferredTheme());

        window.addEventListener('DOMContentLoaded', () => {
          document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value');
              localStorage.setItem('theme', theme);
              setTheme(theme);

              document.querySelectorAll('[data-bs-theme-value]').forEach(el =>
                el.classList.remove('active')
              );
              toggle.classList.add('active');
            });
          });
        });
      })();
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!--end::Script-->
  </body>
  <!--end::Body-->

  </html>
<?php } else {
  header("Location: login.php");
  exit();
}
?>