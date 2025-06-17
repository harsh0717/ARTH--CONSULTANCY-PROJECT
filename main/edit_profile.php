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
    <title>Edit Profile</title>
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
           <h4 class="title">Edit Profile &nbsp;&nbsp;&nbsp;<a href="change_password.php">Change password</a> &nbsp;&nbsp;&nbsp; <a href="profile.php">Profile</a></h4><br>
           <form class="form-1" method="post" action="app/update-profile.php">
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
                    <input type="text" name="full_name"  class="input-1" placeholder="Full Name" value="<?=$user["full_name"]?>"><br>
                </div>
                <div class="input-holder">
                    <label>DOB</label>
                    <input type="date" name="dob" value="<?=$user["dob"]?>" class="input-1" placeholder="DOB"><br>
                </div>
                <div class="input-holder">
                    <label>Email</label>
                    <input type="email" name="email" value="<?=$user["email"]?>" class="input-1" placeholder="Email"><br>
                </div>
                <div class="input-holder">
                    <label>Phone no.</label>
                    <input type="tel" name="phone" value="<?=$user["phone"]?>" class="input-1" placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10"><br>
                </div>
                <div class="input-holder">
                    <label>Address</label>
                    <textarea name="address" rows="4" class="input-1" ><?=$user["address"]?></textarea><br>
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