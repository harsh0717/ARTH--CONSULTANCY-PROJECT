<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="style.css">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="logo">TASK <b>FLOW</b>
            <label for="checkbox">
                <i id="navbtn" class="ri-menu-line"></i>
            </label>
        </h2>
        <i class="ri-user-fill"></i>
    </header>

    <div class="body">

        <nav class="side-bar">
            <div class="user-photo">
                <img src="user.png" alt="user-photo">
                <h4>harsh</h4>
            </div>
            <div>
                <?php
                $user = "admin";

                if ($user == 'employee') {
                ?>
                  <!-- employee nav bar -->
                    <ul>
                        <li>
                            <a href="#">
                                <i class="ri-computer-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-message-fill"></i>
                                <span>My TASK</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-chat-1-line"></i>
                                <span>Notification</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-information-line"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-logout-box-line"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                <?php
                } else { ?>
                      <!-- admin nav bar -->
                    <ul>
                        <li>
                            <a href="#">
                                <i class="ri-computer-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-group-line"></i>
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                 <i class="ri-file-add-line"></i>
                                <span>Create task</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-file-list-3-line"></i>
                                <span>All Task</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-logout-box-line"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                <?php } ?>
            </div>

        </nav>
        
    </div>
</body>

</html>