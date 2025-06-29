<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {


if (isset($_POST["user_name"]) && isset($_POST["password"]) && isset($_POST["full_name"]) && $_SESSION['role'] == 'admin') {
    include "../DB_connection.php";

    function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_name = validate_input($_POST["user_name"]);
    $password = validate_input($_POST["password"]);
    $full_name = validate_input($_POST["full_name"]);

    if (empty($full_name)) {
        $em = "Full Name  is required";
        header("Location: ../add-user.php?error=" . urlencode($em));
        exit();
    } elseif (empty($user_name)) {
        $em = " User name  is required";
        header("Location: ../add-user.php?error=" . urlencode($em));
        exit();
    }elseif (empty($password)) {
        $em = "Password is required";
        header("Location: ../add-user.php?error=" . urlencode($em));
        exit();
    } else {
        
        include "model/User.php";
        $password=password_hash($password,PASSWORD_DEFAULT);
        $data =array($full_name, $user_name, $password, "employee");
        insert_user($conn,$data);

        $em = "User Created Successfully";
        header("Location: ../add-user.php?success=" . urlencode($em));
        exit();

    }
} else {
    $em = "Unknown error occurred";
    header("Location: ../add-user.php?error=" . urlencode($em));
    exit();
}

} 
else{
    $em = "Login First";
    header("Location: ../add-user.php?error=" . urlencode($em));
    exit();
}
?>