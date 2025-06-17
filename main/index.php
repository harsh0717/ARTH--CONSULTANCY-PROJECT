<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {
    include "DB_connection.php";
    include "app/model/Task.php";
    include "app/model/User.php";
    if ($_SESSION['role']=="admin") {
        $todaydue_task = count_tasks_due_today($conn);
        $overdue_task = count_tasks_overdue($conn);
        $no_deadline_task = count_tasks_NoDeadline($conn);
        $num_task = count_tasks($conn);
        $num_users = count_users($conn);
        $pending = count_pending_tasks($conn);
        $in_progress = count_in_progress_tasks($conn);
        $completed = count_completed_tasks($conn);
    }else {
        $num_my_task = count_my_tasks($conn, $_SESSION['id']);
        $overdue_task = count_my_tasks_overdue($conn,$_SESSION['id']);
        $nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
        $pending = count_my_pending_tasks($conn, $_SESSION['id']);
	    $in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
	    $completed = count_my_completed_tasks($conn, $_SESSION['id']);
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="style.css">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <?php include"inc/header.php"; ?>

    <div class="body">
        <?php include"inc/nav.php"; ?>
        <section class="section-1 ">
           <?php if ($_SESSION['role'] == "admin") { ?>
                <div class="dashboard"> 
                    <div class="dashboard-item">
                        <i class="fa fa-users"></i>
                        <span><?=$num_users?> Users</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-tasks"></i>
                        <span><?=$num_task?> All task</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-window-close-o"></i>
                        <span><?=$overdue_task?> Overdue</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-clock-o"></i>
                        <span><?=$no_deadline_task?> No Deadline</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-tasks"></i>
                        <span><?=$todaydue_task?> Due Today</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-bell"></i>
                        <span><?=$num_task?> Notifications</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-hourglass-half"></i>
                        <span><?=$pending?> Pending</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-spinner"></i>
                        <span><?=$in_progress?> In progress</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-check-square"></i>
                        <span><?=$completed?> Completed</span>
                    </div>
                </div>
           <?php }else{ ?>
                <div class="dashboard"> 
                    <div class="dashboard-item">
                        <i class="fa fa-tasks"></i>
                        <span><?=$num_my_task?> My task</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-window-close-o"></i>
                        <span><?=$overdue_task?> Overdue</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-clock-o"></i>
                        <span><?=$nodeadline_task?> No Deadline</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-hourglass-half"></i>
                        <span><?=$pending?> Pending</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-spinner"></i>
                        <span><?=$in_progress?> In progress</span>
                    </div>
                    <div class="dashboard-item">
                        <i class="fa fa-check-square"></i>
                        <span><?=$completed?> Completed</span>
          <?php } ?>
        </section>
    </div>
     <script>
        var active= document.querySelector("#navList li:nth-child(1)");
        active.classList.add("active");
    </script>
</body>
</html>
<?php } 
else{
    $em = "Login First";
    header("Location: login.php?error=" . urlencode($em));
    exit();
}
?>