<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {
    include "DB_connection.php";
    include "app/model/User.php";
    $users = get_all_users($conn);
     
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
           <h4 class="title">Manage Users <a href="add-user.php">Add User</a></h4>
           <?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
		<?php } ?>
            <?php if ($users !=0) { ?>
           <table class="main-table">
            <tr>
                <th>#</th>
				<th>Full Name</th>
				<th>Username</th>
				<th>role</th>
				<th>Action</th>
            </tr>
            <?php 
            $i=0;
            foreach ($users as $user) { ?>
            
            <tr>
                <td><?=++$i?></td>
                <td><?=$user['full_name']?></td>
                <td><?=$user['username']?></td>
                <td><?=$user['role']?></td>
                
                <td>
                    <a href="edit-user.php?id=<?=$user['id']?>" class="edit-btn">Edit</a>
                    <a href="delete-user.php?id=<?=$user['id']?>" class="delete-btn">Delete</a>
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