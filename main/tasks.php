<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])&& $_SESSION['role']=="admin") {
    include "DB_connection.php";
    include "app/model/Task.php";
    include "app/model/User.php";
    

    $text = "All Task";
    if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
        $text = "Due Today";
        $tasks = get_all_tasks_due_today($conn);
        $num_task = count_tasks_due_today($conn);
    }elseif(isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue"){
        $text = "Overdue";
        $tasks = get_all_tasks_overdue($conn);
        $num_task = count_tasks_overdue($conn);
        
    }elseif(isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline"){
        $text = "No Deadline";
        $tasks = get_all_tasks_NoDeadline($conn);
        $num_task = count_tasks_NoDeadline($conn);

    }else{
        $tasks = get_all_tasks($conn);
        $num_task = count_tasks($conn);
    }
    $users =get_all_users($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tasks</title>
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
        
        <section class="section-1">
           <h4 class="title"> 
                <a href="create_task.php" class="btn">Create Tasks</a>
                <span>
                    <a href="tasks.php">All task</a>
                    <a href="tasks.php?due_date=Due Today">Due Today</a>
                    <a href="tasks.php?due_date=Overdue">Overdue</a>
                    <a href="tasks.php?due_date=No Deadline">No Deadline</a>
                </span>
           </h4><br>
           <h4 class="title"><?=$text?> (<?=$num_task?>)</h4>
           <?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
		<?php } ?>
            <?php if ($tasks !=0) { ?>
           <table class="main-table">
            <tr>
                <th>#</th>
				<th>Title</th>
				<th>Description</th>
				<th>Assigned To</th>
                <th>Due Date</th>
				<th>Status</th>
				<th>Action</th>
            </tr>
            <?php 
            $i=0;
            foreach ($tasks as $task) { ?>
            
            <tr>
                <td><?=++$i?></td>
                <td><?=$task['title']?></td>
                <td><?=$task['description']?></td>
                <td>
                    <?php 
                    foreach ($users as $user) {
                    if($user['id'] == $task['assigned_to']){
                        echo $user['full_name'];
                    }} ?>
                </td>
                <td>
                    <?php if($task['due_date'] == "") echo "No Deadline";
	                      else echo $task['due_date'];
	               ?>
                </td>
                <td><?=$task['status']?></td>
                
                <td>
                    <a href="edit-task.php?id=<?=$task['id']?>" class="edit-btn">Edit</a>
                    <a href="delete-task.php?id=<?=$task['id']?>" class="delete-btn">Delete</a>
                </td>
            </tr>
            <?php  }?>
           </table>
           <?php }else { ?>
            <h3>Empty</h3>
            <?php }?>
        </section>
    </div>
    <script type="text/javascript">
	    var active = document.querySelector("#navList li:nth-child(4)");
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