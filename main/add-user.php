<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role']=="admin" ) {
    
     
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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
           <h4 class="title">Add User <a href="user.php">Users</a></h4>
            <form class="form-1" method="post" action="app/add-user.php">
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
                    <label>Full Name</label>
                    <input type="text" name="full_name"  class="input-1" placeholder="Full Name"><br>
                </div>
                <div class="input-holder">
                    <label>User Name</label>
                    <input type="text" name="user_name" class="input-1" placeholder="User Name"><br>
                </div>
                <div class="input-holder">
                    <label>Password</label>
                    <input type="text" name="password" class="input-1" placeholder="Password"><br>
                </div>
                <button class="edit-btn">ADD</button>
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