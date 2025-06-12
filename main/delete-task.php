<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "DB_connection.php";
    include "app/model/Task.php";

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
      $data = array($id);
      delete_tasks($conn, $data);
      $sm = "Deleted Successfully";
      header("Location: tasks.php?success=$sm");
      exit();
    
} else {
    $em = "Login First";
    header("Location: login.php?error=" . urlencode($em));
    exit();
}
