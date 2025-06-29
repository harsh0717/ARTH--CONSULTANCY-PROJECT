<nav class="side-bar">
            <div class="user-photo">
                <img src="user.png" alt="user-photo">
                <h4>@<?=$_SESSION['username']?></h4>
            </div>
            <div>
                <?php if ($_SESSION['role'] == 'employee') {?>
                  <!-- employeee -->
                    <ul id="navList">
                        <li>
                            <a href="index.php">
                                <i class="ri-computer-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="my_task.php">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                <span>My TASK</span>
                            </a>
                        </li>
                        <li>
                            <a href="profile.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="ri-logout-box-line"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                <?php } else { ?>
                      <!-- admin -->
                    <ul id="navList">
                        <li>
                            <a href="index.php">
                                <i class="ri-computer-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="user.php">
                                <i class="ri-group-line"></i>
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="create_task.php">
                                 <i class="ri-file-add-line"></i>
                                <span>Create task</span>
                            </a>
                        </li>
                        <li>
                            <a href="tasks.php">
                                <i class="ri-file-list-3-line"></i>
                                <span>All Tasks</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="ri-logout-box-line"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                <?php } ?>
            </div>

        </nav>