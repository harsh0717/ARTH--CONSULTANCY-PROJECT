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
    <title>Profile</title>
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
           <h4 class="title">Profile&nbsp;&nbsp;&nbsp;<a href="change_password.php">Change password</a> &nbsp;&nbsp;&nbsp; <a href="edit_profile.php">Edit Profile</a></h4><br>
            <table class="main-table" style="max-width: 700px;">
                <tr>
                    <td>Full Name</td>
                    <td><?=$user['full_name']?></td>
                </tr>
                <tr>
                    <td>Employee ID</td>
                    <td><?=$user['id']?></td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><?=$user['username']?></td>
                </tr>
                <tr>
                    <td>Joined AT </td>
                    <td><?=$user['created_at']?></td>
                </tr>
                <tr>
                    <td>DOB</td>
                    <td><?=$user['dob']?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?=$user['email']?></td>
                </tr>
                <tr>
                    <td>Phone no.</td>
                    <td><?=$user['phone']?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?=$user['address']?></td>
                </tr>
            </table>
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