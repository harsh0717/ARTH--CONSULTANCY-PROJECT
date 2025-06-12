<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {


if (isset($_POST["id"])&& isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["assigned_to"]) && $_SESSION['role'] == 'admin') {
    include "../DB_connection.php";
    include "app/model/User.php";
    $users = get_all_users($conn);

    function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $title = validate_input($_POST["title"]);
    $description = validate_input($_POST["description"]);
    $assigned_to = validate_input($_POST["assigned_to"]);
    $id = validate_input($_POST["id"]);

    if (empty($title)) {
        $em = "Title is required";
        header("Location: ../edit-task.php?error=" . urlencode($em). "&id=" . urlencode($id));
        exit();
    } elseif (empty($description)) {
        $em = "Description is required";
        header("Location: ../edit-task.php?error=" . urlencode($em). "&id=" . urlencode($id));
        exit();
    }elseif ($assigned_to == 0) {
        $em = "Select the Employee";
        header("Location: ../edit-task.php?error=" . urlencode($em). "&id=" . urlencode($id));
        exit();
    }else {
        
        include "model/Task.php";
        $data =array($title, $description, $assigned_to, $id);
        update_task($conn,$data);

        $em = "Task updated Successfully";
        header("Location: ../edit-task.php?success=" . urlencode($em). "&id=" . urlencode($id));
        exit();

    }
} else {
    $em = "Unknown error occurred";
    header("Location: ../edit-task.php?error=" . urlencode($em));
    exit();
}

} 
else{
    $em = "Login First";
    header("Location: ../login.php?error=" . urlencode($em));
    exit();
}
?>