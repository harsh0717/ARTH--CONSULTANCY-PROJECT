<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "DB_connection.php";
    include "app/model/User.php";
    $users = get_all_users($conn);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Task</title>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <input type="checkbox" id="checkbox">
        <?php include "inc/header.php"; ?>

        <div class="body">
            <?php include "inc/nav.php"; ?>

            <section class="section-1">
                <h4 class="title">Create Task <a href="tasks.php">All Tasks</a></h4>
                <form class="form-1" method="post" action="app/add-task.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="danger" role="alert">
                            <?php echo stripcslashes($_GET['error']); ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="success" role="alert">
                            <?php echo stripcslashes($_GET['success']); ?>
                        </div>
                    <?php } ?>
                    <div class="input-holder">
                        <label>Title</label>
                        <input type="text" name="title" class="input-1" placeholder="Enter Title of the Task"><br>
                    </div>
                    <div class="input-holder">
                        <label>Description</label>
                        <textarea type="text" name="description" class="input-1" placeholder="Description"></textarea><br>
                    </div>
                    <div class="input-holder">
                        <label>Assigned to</label>
                        <select name="assigned_to" class="input-1">
                            <option value="0">Select employee</option>
                            <?php if ($users !=0){ 
                            foreach ($users as $user) {
                            ?>
                            <option value="<?=$user['id']?>"><?=$user['full_name']?></option>
                            <?php } } ?>
                        </select><br>
                    </div>
                    <button class="edit-btn">Create Task</button>
                </form>
            </section>
        </div>
        <script type="text/javascript">
            var active = document.querySelector("#navList li:nth-child(3)");
            active.classList.add("active");
        </script>
    </body>

    </html>
<?php } else {
    $em = "Login First";
    header("Location: login.php?error=" . urlencode($em));
    exit();
}
?>