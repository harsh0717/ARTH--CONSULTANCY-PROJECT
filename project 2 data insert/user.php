<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/model/User.php";
    $users = get_all_users($conn);
?>
    <!doctype html>
    <html lang="en">
    <!--begin::Head-->

    <head>
        <!-- inside <head> -->
        <link rel="icon" href="logo.png" type="image/png" sizes="32x32" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Task Flow | Manage Users</title>
        <!--begin::Primary Meta Tags-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="title" content="AdminLTE v4 | Dashboard" />
        <meta name="author" content="ColorlibHQ" />
        <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
        <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
        <!--end::Primary Meta Tags-->
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
        <!--end::Fonts-->
        <!--begin::Third Party Plugin(OverlayScrollbars)-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
        <!--end::Third Party Plugin(OverlayScrollbars)-->
        <!--begin::Third Party Plugin(Bootstrap Icons)-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
        <!--end::Third Party Plugin(Bootstrap Icons)-->
        <!--begin::Required Plugin(AdminLTE)-->
        <link rel="stylesheet" href="css/adminlte.css" />
        <!--end::Required Plugin(AdminLTE)-->
        <!-- apexcharts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
        <!-- jsvectormap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
        <!--begin::App Wrapper-->
        <div class="app-wrapper">
            <!--begin::Header-->
            <?php include "inc/nav.php"; ?>
            <!--end::Header-->
            <!--begin::Sidebar-->
            <?php include "inc/slider.php"; ?>
            <!--end::Sidebar-->
            <!--begin::App Main-->
            <main class="app-main">
                <!--begin::App Content Header-->
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6" style="display: flex;">
                                <h3 class="mb-0">Manage Users</h3>&nbsp;&nbsp;&nbsp;<a href="add-user.php" class="btn btn-secondary">Add User</a>
                            </div>
                            <?php if (isset($_GET['success'])) : ?>
                                <div id="successAlert" class="alert alert-success" role="alert">
                                    <?php echo stripcslashes($_GET['success']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!--end::App Content Header-->
                <!--begin::App Content-->
                <div class="card mb-4">
                    <div class="card-body p-0">
                        <?php if ($users != 0) { ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="align-middle">
                                        <th style="width: 10px">#</th>
                                        <th style="width:300px">Full Name</th>
                                        <th style="width: 50px">Username</th>
                                        <th style="width: 40px">role</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 0;
                                foreach ($users as $user) { ?>
                                    <tbody>
                                        <tr class="align-middle">
                                            <td><?= ++$i ?></td>
                                            <td><?= $user['full_name'] ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['role'] ?></td>
                                            <td>
                                                <span class="badge update-btn">
                                                    <a href="edit-user.php?id=<?= $user['id'] ?>" class="text-decoration-none btn btn-success">Edit</a>&nbsp;&nbsp;&nbsp;
                                                    <a href="delete-user.php?id=<?= $user['id'] ?>" class="text-decoration-none btn btn-danger delete-link">Delete</a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php  } ?>
                            </table>
                        <?php } else { ?>
                            <h3>Empty</h3>
                        <?php } ?>
                    </div>
                </div>
                <!--end::App Content-->
            </main>
            <!--end::App Main-->
            <!--begin::Footer-->
            <footer class="app-footer">
                <div class="float-end d-none d-sm-inline">Anything you want</div>
                <strong>
                    Copyright &copy; 2025&nbsp;
                    <a href="index.php" class="text-decoration-none">TASK FLOW</a>.
                </strong>
                All rights reserved.
            </footer>
            <!--end::Footer-->
        </div>
        <!--end::App Wrapper-->

        <!-- ========= Delete Confirmation Modal (no class changes) ========= -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Are you sure you want to delete this user?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="deleteConfirmBtn" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================= -->

        <!--begin::Script-->
        <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const delModal = new bootstrap.Modal('#confirmDeleteModal');
                const confirmBtn = document.getElementById('deleteConfirmBtn');

                document.querySelectorAll('.delete-link').forEach(link => {
                    link.addEventListener('click', e => {
                        e.preventDefault();
                        confirmBtn.href = e.currentTarget.href;
                        delModal.show();
                    });
                });

                const alert = document.getElementById("successAlert");
                if (alert) {
                    setTimeout(() => {
                        alert.remove();
                    }, 2000);
                }
            });
        </script>
    </body>
    </html>
<?php } else {
    $em = "Login First";
    header("Location: login.php?error=" . urlencode($em));
    exit();
} ?>
