<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {


if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["assigned_to"])&& $_SESSION['role'] == 'admin' && isset($_POST['due_date']) ) {
    include "../DB_connection.php";

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
    $due_date = validate_input($_POST["due_date"]);

    if (empty($title)) {
        $em = "Title is required";
        header("Location: ../create_task.php?error=" . urlencode($em));
        exit();
    } elseif (empty($description)) {
        $em = "Description is required";
        header("Location: ../create_task.php?error=" . urlencode($em));
        exit();
    }elseif ($assigned_to == 0) {
        $em = "Select the Employee";
        header("Location: ../create_task.php?error=" . urlencode($em));
        exit();
    }else {
        
        include "model/Task.php";
        $data =array($title, $description, $assigned_to, $due_date);
        insert_task($conn,$data);

        $em = "Task Created Successfully";
        header("Location: ../create_task.php?success=" . urlencode($em));
        exit();

    }
} else {
    $em = "Unknown error occurred";
    header("Location: ../create_task.php?error=" . urlencode($em));
    exit();
}

} 
else{
    $em = "Login First";
    header("Location: ../create_task.php?error=" . urlencode($em));
    exit();
}
?>