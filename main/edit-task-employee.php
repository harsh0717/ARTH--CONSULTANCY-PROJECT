<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role']=="employee" ) {
    include "DB_connection.php";
    include "app/model/Task.php";
    include "app/model/User.php";

    if (!isset($_GET['id'])) {
        header("Location: tasks.php");
        exit(); 
    }
    $id = $_GET['id'];
    $task = get_task_by_id($conn, $id);

      if ($task == 0) {
        header("Location: tasks.php");
        exit(); 
    }
    $users = get_all_users($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
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
           <h4 class="title">Edit Task <a href="my_task.php">Task</a></h4><br>
            <form class="form-1" method="post" action="app/update-task-employee.php">
                <?php if (isset($_GET['error'])) {?>
      	  	<div class="danger" role="alert">
			  <?php echo stripcslashes($_GET['error']); ?>
			</div>
      	  <?php } ?>
      	  <?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
      	  <?php }?>
                <div class="input-holder">
                    <p><b>Title:</b><?=$task["title"]?></p>
                </div><br>
                <div class="input-holder">
                    <p><b>Description:</b><?=$task["description"]?></p>
                </div><br>
            
                 <div class="input-holder">
                        <label>Status</label>
                        <select name="assigned_to" class="input-1">
                            <option <?php if( $task['status'] == "pending") echo"selected";?>>Pending</option>
                            <option <?php if( $task['status'] == "in_progress") echo"selected";?>>In Progress</option>
                            <option <?php if( $task['status'] == "compelete") echo"selected";?>>Completed</option>
                        </select><br>
                    </div>
                
                <input type="text" name="id" value="<?=$task["id"]?>" hidden>

                <button class="edit-btn">Update</button>
            </form>
        </section>
    </div>
    <script>
        var active= document.querySelector("#navList li:nth-child(2)");
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