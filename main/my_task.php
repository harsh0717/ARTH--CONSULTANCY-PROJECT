<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {
    include "DB_connection.php";
    include "app/model/Task.php";
    include "app/model/User.php";
    $tasks = get_all_tasks_by_id($conn,$_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
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
           <h4 class="title">My Tasks</h4>
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
                <td><?=$task['status']?></td>
                <td>
                    <a href="edit-task-employee.php?id=<?=$task['id']?>" class="edit-btn">Edit</a>
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
	    var active = document.querySelector("#navList li:nth-child(2)");
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