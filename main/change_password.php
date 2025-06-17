<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role']=="employee" ) {
    include "DB_connection.php";
    include "app/model/User.php";
    $user = get_user_by_id($conn,$_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
           <h4 class="title">Profile&nbsp;&nbsp;&nbsp;<a href="profile.php">Profile</a> &nbsp;&nbsp;&nbsp; <a href="edit_profile.php">Edit Profile</a></h4><br>
            <form class="form-1" method="post" action="app/change_password.php">
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
                    <label>Old Password</label>
                    <input type="password" name="password" class="input-1" placeholder="Old Password"><br>
                </div>
                <div class="input-holder">
                    <label>New Password</label>
                    <input type="password" name="new_password"  class="input-1" placeholder="New Password"><br>
                </div>
                <div class="input-holder">
                    <label>conform Password</label>
                    <input type="password" name="conform_password"  class="input-1" placeholder="Conform Password"><br>
                </div>
                <input type="text" name="id" value="<?=$user["id"]?>" hidden>

                <button class="edit-btn">Update</button>
            </form>
        </section>
    </div>
    <script>
        var active= document.querySelector("#navList li:nth-child(3)");
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